<?php
/*
 * Plugin Name: Vikinguard
 * Plugin URI: https://www.vikinguard.com
 * Description: it checks your site uptime and real user experience. This module provides all the infomation about your site\'s perfomance.
 * Author: Vikinguard. This is not just a software company.
 * Version: 3.1.2
 * Author URI: https://www.vikinguard.com
 */



function wpb_adding_heimdal_scripts() {

	wp_register_script('heimdal', plugins_url ( 'heimdal.js', __FILE__ ));
	wp_enqueue_script('heimdal');


}





// Make sure we don't expose any info if called directly
if (! function_exists ( 'add_action' )) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit ();
}

// For backwards compatibility, esc_attr_e was added in 2.8 and attribute_escape is from 2.8 marked as deprecated.
if (! function_exists ( 'esc_attr_e' )) {
	function esc_attr_e($text) {
		return attribute_escape ( $text );
	}
}

// The html code that goes in to the header
function add_Vikinguard_header() {
	$customer = ( string ) get_option ( 'HEIMDALAPM_CUSTOMER' );
	$shop = ( string ) get_option ( 'HEIMDALAPM_SHOP' );
	
	if (! is_admin () && strlen ( $customer ) > 0 && strlen ( $shop ) > 0) {
		?>
		
<script type="text/javascript">
var heimdalparam={};

var configCallBack = function(){
	BOOMR.init({
			beacon_url: "//eum.vikinguard.com"
	});
	BOOMR.addVar("customer","<?php echo $customer; ?>");
	BOOMR.addVar("shop","<?php echo $shop; ?>");
	BOOMR.addVar("version","WC3.1.2");
    info();
};


var info =function(){
	 for (key in heimdalparam){
    	BOOMR.addVar(key,heimdalparam[key]);
    
    }
};


var heimdaladdVar=function(key,value){
	heimdalparam[key]=value;
};


loadScript("//cdn.vikinguard.com/vikinguard.js", configCallBack);

function loadScript(u, c){
    var h = document.getElementsByTagName('head')[0];
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.src = u;
    s.onreadystatechange = c;
    s.onload = c;
    h.appendChild(s);
   
}
</script>

<?php
	}
}
function print_Vikinguard_console() {
	wp_enqueue_style ( "heimdalapm", plugins_url ( 'heimdal.css', __FILE__ ) );
	wp_enqueue_style ( "fill", plugins_url ( 'heimdal.css', __FILE__ ) );
	?>

    	<div class="row">
   				<div class="heimdal col-md-4">
        			<img src="<?php echo plugins_url( 'heimdalfullbody.jpg', __FILE__ );?>"  alt=""></img>
   				</div>
    		<div class="steps col-md-8">
				<div class="row"><?php esc_attr_e('to access, clik on:' , 'Vikinguard');?></div>
				<div class="row buttonheimdal">
					<h2><a href="https://vikinguard.com/heimdal/index.html?auto=true&email=<?php  echo urlencode(get_option( 'HEIMDALAPM_EMAIL' ));?>&password=<?php  echo urlencode(get_option( 'HEIMDALAPM_PASSWORD' ));?>&version=WC3.1.2" target="_blank">
 						Vikinguard Console</a>
					 </div></h2>
				</div>
				
			</div>
		</div>
		
	


	
	<?php
}

// Prints the admin menu where it is possible to add the tracking code
function print_Vikinguard_management() {
	if (! current_user_can ( 'manage_options' )) {
		wp_die ( __ ( 'You do not have sufficient permissions to manage options for this blog.' ) );
	}
	
	wp_enqueue_style ( "heimdalapm", plugins_url ( 'heimdal.css', __FILE__ ) );
	
	// If we try to update the settings
	
	$configurationEmail = get_option ( 'HEIMDALAPM_EMAIL' );
	$configurationPassword = get_option ( 'HEIMDALAPM_PASSWORD' );
	$customerid = ( string ) get_option ( 'HEIMDALAPM_CUSTOMER' );
	$shopid = ( string ) get_option ( 'HEIMDALAPM_SHOP' );
	$action = $_GET ['action'];
	
	if ($action == "reconfigured") {
		
		return mail_Vikinguard_Render ();
	}
	
	if ($action == "signup") {
		update_option ( 'HEIMDALAPM_EMAIL_TMP', sanitize_email ( $_GET ['heimdalapm_email'] ) );
		return signup_Vikinguard_Render ();
	}
	if ($action == "configuration") {
		update_option ( 'HEIMDALAPM_EMAIL_TMP', sanitize_email ( $_GET ['heimdalapm_email'] ) );
		return configuration_Vikinguard_Render ();
	}
	if ($action == "multishop"){
//		update_option ( 'HEIMDALAPM_EMAIL_TMP', sanitize_email ( $_GET ['heimdalapm_email'] ) );
		update_option ( 'HEIMDALAPM_EMAIL', sanitize_email ( $_GET ['heimdalapm_email'] ) );
		update_option ( 'HEIMDALAPM_PASSWORD', $_GET ['heimdalapm_password'] );
		update_option ( 'HEIMDALAPM_CUSTOMER', $_GET ['heimdalapm_customer'] );
		return multishop_render();
	}
	
	if ($action == "configured" || ($configurationEmail != null || $configurationEmail != "") && ($configurationPassword != null || $configurationPassword != "") && ($customerid != null || vg_customerid != "") && ($shopid != null || $shopid != "")) {
		if ($action == "configured") {
			if (function_exists ( 'wp_cache_clear_cache' )) {
				wp_cache_clear_cache ();
			}
			
			if (is_email ( $_GET ['heimdalapm_email'] ) && is_numeric ( $_GET ['heimdalapm_customer'] ) && strlen ( $_GET ['heimdalapm_customer'] ) == 32 &&
				 is_numeric ( $_GET ['heimdalapm_shop'] ) && strlen ( $_GET ['heimdalapm_shop'] ) == 32 /*&& strlen ( $_GET ['heimdalapm_password'] ) > 5*/) {
//				update_option ( 'HEIMDALAPM_EMAIL', sanitize_email ( $_GET ['heimdalapm_email'] ) );
//				update_option ( 'HEIMDALAPM_PASSWORD', $_GET ['heimdalapm_password'] );
				update_option ( 'HEIMDALAPM_CUSTOMER', $_GET ['heimdalapm_customer'] );
				update_option ( 'HEIMDALAPM_SHOP', $_GET ['heimdalapm_shop'] );
			} else {
				
				return mail_Vikinguard_Render ();
			}
		}
		
		return configured_Vikinguard_Render ();
	}
	
	return mail_Vikinguard_Render ();
	?>
	
<?php
}
function multishop_render() {
	
	$customer_info = stripcslashes($_GET ['heimdalapm_customer_info']);
	$customer_info_decoded = json_decode($customer_info);
	$rights=$customer_info_decoded->rights;
	?>
<div class="wrap">
	<img src="<?php echo plugins_url( 'heimdal.png', __FILE__ ); ?>"
		alt="Heimdal logo" width="300px" />
	<h2>VIKINGUARD</h2>
	<hr />
	
		<?php
			if($rights=="CUSTOMER_ADMIN"||$rights=="SHOP_ADMIN"){
	
	?>
	<div id="register" class="form-signin">
		<span class="heimdal-inp-hed"><?php esc_attr_e('Mail', 'Vikinguard' );?></span>
		<span id="signupEmail"><?php echo get_option( 'HEIMDALAPM_EMAIL_TMP' );?></span>
		<br>
		<input type="checkbox" id="signupTerms"
			data-error="<?php esc_attr_e('you must accept Vikinguard\'s terms', 'Vikinguard' );?>"
			required name="agree" class="heimdal-inp-hed" checked="checked"><?php esc_attr_e('I agree to the ', 'Vikinguard' );?> <a
			href="https://vikinguard.com/heimdal/EULA.html"> <?php esc_attr_e('Terms of Service.', 'Vikinguard' );?></a>
			</input>
		<div class="heimdal-form-pereira">
		<h3 class="form-signin-heading"><?php esc_attr_e('Select an existing web ...', 'Vikinguard' );?></h3>
				<select id="multishop_selector" name="shop" class="heimdal--input">
		        <?php
					        
				
				foreach ($customer_info_decoded->shops as $element) {
					$desc = $element->shopName;
					$desc .= " (";
					$desc .= $element->shopURL;
					$desc .= ")";
				    echo '<option value="'.$element->shopId.'">'.$desc.'</option>';
				}
		        
		        ?>
		        </select>
		        <input type="submit" class="heimdal--button" value="<?php esc_attr_e('Use this web' , 'Vikinguard' );?>"
		        	onclick='shopSelected("<?php echo get_option ( 'HEIMDALAPM_CUSTOMER' );?>","<?php esc_attr_e('You must accept the terms\n', 'Vikinguard' );?>");'>   
		        <br><br><br>
		</div>
		<?php
			if($rights=="CUSTOMER_ADMIN"){
	
		?>
		<div class="heimdal-form-pereira">
			<h3 class="form-signin-heading"><?php esc_attr_e('... or add a new one', 'Vikinguard' );?></h3>
			<ul>
				<li><span class="heimdal-inp-hed"
					title="<?php esc_attr_e('This is just a name to refer to your web.', 'Vikinguard' );?>"><?php esc_attr_e('Your New Web Name', 'Vikinguard' );?></span>
					<input type="text" id="addShopShopName" class="heimdal-inp"
					placeholder="<?php esc_attr_e('Web name', 'Vikinguard' );?>"
					required autofocus data-error="Customer" required name="customer"
					value="<?php echo bloginfo( 'name' ); ?>"> </input></li>
				<li><span class="heimdal-inp-hed"
					title="<?php esc_attr_e('Vikinguard is going to use this address to monitor the uptime of your web. Please, check the http and https is correct configured. Do not use private or localhost address, use your public ip or domain to allow Vikinguard to access to your web.', 'Vikinguard' );?>">
						<?php esc_attr_e('Your new web address', 'Vikinguard' );?></span> 
					<input type="url" id="addShopUrl" class="heimdal-inp"
					placeholder="<?php esc_attr_e('Web URL', 'Vikinguard' );?>"
					required autofocus data-error="Customer" required name="customer"
					value="<?php echo bloginfo( 'url' ); ?>"> </input></li>
				<li><input id="enviar" class="heimdal--button"
					onclick='addShop("<?php echo get_option( 'HEIMDALAPM_EMAIL_TMP' );?>","<?php echo get_option ( 'HEIMDALAPM_CUSTOMER' );?>","<?php echo get_option ( 'HEIMDALAPM_PASSWORD' );?>","<?php esc_attr_e('Web Name too short' , 'Vikinguard');?>\n","<?php esc_attr_e('Short url must start by http:// or https://', 'Vikinguard' );?>\n","<?php esc_attr_e('We have noticed that you configured Vikinguard to monitor a demo/test environment (localhost or 127.0.0.1). Please note that without real traffic and no public URL, you will not be able to monitor neither uptime neither real user experience and you will lose some important functionalities of our tool', 'Vikinguard' );?>","<?php esc_attr_e('You must accept the terms\n', 'Vikinguard' );?>","<?php esc_attr_e('Communication problem. Please try again later.', 'Vikinguard' );?>");'
					type="submit" value="<?php esc_attr_e('Add it!','Vikinguard' ) ?>"></input>
					
				</li>
				<br><br>
			</ul>
		</div>
		
			
		<?php
				
			}
		}
	
	?>
		<?php
				if($rights=="NO_ADMIN"){
					
		?>
					<div class="heimdal-form-pereira">
					
						<h3>
							<?php esc_attr_e('You do not have enough rights to configure this web.', 'Vikinguard' );?></span>
							</h3>
							<a onclick="reconfigured();"> <?php esc_attr_e('to reset the configuration' , 'Vikinguard');?></a>
							
					</div>
		<?php
				}
		?>
				
	</div>


<?php
	}
function mail_Vikinguard_Render() {
	?>

<div class="wrap">
	<img src="<?php echo plugins_url( 'heimdal.png', __FILE__ ) ?>"
		alt="Heimdal logo" width="300px" />
	<h2>VIKINGUARD</h2>

	<hr />
	<div class="heimdal-form">
		<h3 class="form-signin-heading"><?php esc_attr_e('Please introduce your email to configure Vikinguard', 'Vikinguard'); ?></h3>

		<input type="email" id="checkEmail" class="heimdal--input"
			placeholder="<?php esc_attr_e('Mail address'); ?>" required autofocus
			required name="mail" value=""
			title="<?php esc_attr_e('If you want to sign up, introduce your mail. If you are already registered, use your mail to sign in.', 'Vikinguard'); ?>"></input>
		<input
			onclick="sendMail('<?php esc_attr_e('Check your email' , 'Vikinguard');?>\n','<?php esc_attr_e('Communication problem. Please try again later.' , 'Vikinguard');?>')"
			id="enviar" type="submit" name="submit" class="heimdal--button"
			value="<?php esc_attr_e('Send it','Vikinguard' ) ?>"></input> <span
			class="heimdal-description"><?php esc_attr_e('Introduce your mail', 'Vikinguard'); ?></span>
	</div>

	<a href="https://vikinguard.com/support/" class="supportAdvise"><?php esc_attr_e('Do you have any problem? Please click here' , 'Vikinguard');?>.</a>

	<hr />
	<div class="row warning-note">
		<strong><?php esc_attr_e('We are not going to spam you' , 'Vikinguard');?>:</strong> <?php esc_attr_e('We are committed to keeping your e-mail address confidential. We do not sell, rent, or lease our subscription lists to third parties, and we will not provide your personal information to any third party individual, government agency, or company at any time unless compelled to do so by law.' , 'Vikinguard');?>
        				</div>


</div>
<?php
}
function configuration_Vikinguard_Render() {
	?>
<div class="wrap">
	<img src="<?php echo plugins_url( 'heimdal.png', __FILE__ ); ?>"
		alt="Heimdal logo" width="300px" />
	<h2>VIKINGUARD</h2>

	<hr />

	<h3 class="form-signin-heading"><?php esc_attr_e('Introduce your password to reconfigure the module.' , 'Vikinguard');?></h3>


	<div class="" id="sep">
		<ul>
			<li><span class="heimdal-inp-hed"><?php esc_attr_e('Mail' , 'Vikinguard');?></span>
				<input type="email" id="signinEmail" class="heimdal-inp"
				placeholder="<?php esc_attr_e('Mail address' , 'Vikinguard');?>"
				required autofocus
				data-error="<?php esc_attr_e('That email address is invalid' , 'Vikinguard');?>"
				required name="mail"
				value="<?php echo get_option( 'HEIMDALAPM_EMAIL_TMP' );?>"> </input>
			</li>
			<li><span class="heimdal-inp-hed"><?php esc_attr_e('Password' , 'Vikinguard');?>
							</span> <input type="password" data-minlength="6"
				class="heimdal-inp" id="signinPassword"
				placeholder="<?php esc_attr_e('Password' , 'Vikinguard');?>"
				required name="password"
				data-error="<?php esc_attr_e('minimum 6 caracters' , 'Vikinguard');?>">
				</input></li>
			<li><span>					<?php esc_attr_e('Did you forget your password? Click' , 'Vikinguard');?> <a
					href="https://vikinguard.com/heimdal/index.html?action=forgot"
					target="_blank"><?php esc_attr_e(' here' , 'Vikinguard');?>.</a></span>
			</li>
			<li><input id="enviar"
				onclick='signupMail("<?php esc_attr_e('check your password' , 'Vikinguard');?>","<?php esc_attr_e('Communication problem. Please try again later' , 'Vikinguard');?>.")'
				class="heimdal--button" type="submit"
				value="<?php esc_attr_e('Sign in','Vikinguard' ) ?>"></input></li>
		</ul>
	</div>
</div>
<?php
}
function configured_Vikinguard_Render() {
	?>

<div class="wrap">
	<img src="<?php echo plugins_url( 'heimdal.png', __FILE__ ); ?>"
		alt="Heimdal logo" width="300px" />
	<h2>VIKINGUARD</h2>

	<hr />
	<div>
							<?php esc_attr_e('VIKINGUARD IS CONFIGURED' , 'Vikinguard');?> 
		</div>

	<a onclick="reconfigured();"> <?php esc_attr_e('to reset the configuration' , 'Vikinguard');?></a>
	<h2><a href="https://vikinguard.com/heimdal/index.html?auto=true&email=<?php echo  urlencode(get_option( 'HEIMDALAPM_EMAIL' ));?>&password=<?php  echo urlencode(get_option( 'HEIMDALAPM_PASSWORD'));?>&version=WC3.1.2" target="_blank">
 						Vikinguard Console</a>
					 </div></h2>
</div>
<?php
}
function signup_Vikinguard_Render() {
	?>
<div class="wrap">
	<img src="<?php echo plugins_url( 'heimdal.png', __FILE__ ); ?>"
		alt="Heimdal logo" width="300px" />
	<h2>VIKINGUARD</h2>
	<hr />
	<div id="register" class="form-signin">
		<h3 class="form-signin-heading"><?php esc_attr_e('1) Select a password:', 'Vikinguard' );?></h3>
		<ul>
			<li><span class="heimdal-inp-hed"><?php esc_attr_e('Mail', 'Vikinguard' );?></span>
				<span id="signupEmail"><?php echo get_option( 'HEIMDALAPM_EMAIL_TMP' );?></span>
			</li>
			<li><span class="heimdal-inp-hed"><?php esc_attr_e('Choose a Password', 'Vikinguard' );?></span>
				<input type="password" data-minlength="6" class="heimdal-inp"
				id="signupPassword"
				placeholder="<?php esc_attr_e('Password', 'Vikinguard' );?>"
				required name="password"
				data-error="<?php esc_attr_e('minimum 6 caracters', 'Vikinguard' );?>">
				</input></li>
			<li><span class="heimdal-inp-hed"><?php esc_attr_e('Confirm the Password', 'Vikinguard' );?></span>
				<input type="password" class="heimdal-inp" id="signupConfirm"
				data-match="#signupPassword"
				data-match-error="<?php esc_attr_e('Whoops, these don\'t match', 'Vikinguard' );?>"
				placeholder="<?php esc_attr_e('Confirm', 'Vikinguard' );?>" required
				name="confirm"></input></li>
		</ul>
		<h3 class="form-signin-heading"><?php esc_attr_e('2) Review/Modify:', 'Vikinguard' );?></h3>
		<ul>

			<li><span class="heimdal-inp-hed"
				title="<?php esc_attr_e('This is just a name to refer to your web.', 'Vikinguard' );?>"><?php esc_attr_e('Your web Name', 'Vikinguard' );?></span>
				<input type="text" id="signupCustomer" class="heimdal-inp"
				placeholder="<?php esc_attr_e('Customer name', 'Vikinguard' );?>"
				required autofocus data-error="Customer" required name="customer"
				value="<?php echo bloginfo( 'name' ); ?>"> </input></li>
			<li><span class="heimdal-inp-hed"
				title="<?php esc_attr_e('Vikinguard is going to use this address to monitor the uptime of your web. Please, check the http and https is correct configured. Do not use private or localhost address, use your public ip or domain to allow Vikinguard to access to your web.', 'Vikinguard' );?>">
					<?php esc_attr_e('Your Web Address', 'Vikinguard' );?></span> <input type="url" id="signupShop"
				class="heimdal-inp"
				placeholder="<?php esc_attr_e('Web URL', 'Vikinguard' );?>"
				required autofocus data-error="Customer" required name="customer"
				value="<?php echo bloginfo( 'url' ); ?>"> </input></li>
			<li><input type="checkbox" id="signupTerms"
				data-error="<?php esc_attr_e('you must accept Vikinguard\'s terms', 'Vikinguard' );?>"
				required name="agree" class="heimdal-inp-hed" checked="checked"><?php esc_attr_e('I agree to the ', 'Vikinguard' );?> <a
				href="https://vikinguard.com/heimdal/EULA.html"> <?php esc_attr_e('Terms of Service.', 'Vikinguard' );?></a>
				</input></li>
			<li><input id="enviar" class="heimdal--button"
				onclick='signup("<?php echo get_option( 'HEIMDALAPM_EMAIL_TMP' );?>","<?php esc_attr_e('Customer Name too short' , 'Vikinguard');?>\n","<?php esc_attr_e('Short url must start by http:// or https://', 'Vikinguard' );?>\n","<?php esc_attr_e('Password too short', 'Vikinguard' );?>\n","<?php esc_attr_e('Whoops, these passwords do not match', 'Vikinguard' );?>\n","<?php esc_attr_e('Check your email configuration', 'Vikinguard' );?>\n","<?php esc_attr_e('You must accept the terms\n', 'Vikinguard' );?>","<?php esc_attr_e('We have noticed that you configured Vikinguard to monitor a demo/test environment (localhost or 127.0.0.1). Please note that without real traffic and no public URL, you will not be able to monitor neither uptime neither real user experience and you will lose some important functionalities of our tool', 'Vikinguard' );?>","<?php esc_attr_e('Communication problem. Please try again later.', 'Vikinguard' );?>","<?php echo get_option( 'HEIMDALAPM_EMAIL_TMP' );?>");'
				type="submit" value="<?php esc_attr_e('Send it','Vikinguard' ) ?>"></input>
			</li>
		</ul>
	</div>

<?php
}
function add_Vikinguard_admin_page() {
	if (function_exists ( 'add_submenu_page' )) {
		add_submenu_page ( 'plugins.php', __ ( 'Vikinguard  Settings', 'Vikinguard' ), __ ( 'Vikinguard  Settings' ), 'manage_options', 'vikinguard-config', 'print_Vikinguard_management' );
		add_menu_page ( __ ( 'Vikinguard Console', 'Vikinguard' ), __ ( 'Vikinguard Console' ), 'manage_options', 'vikinguard-console', 'print_Vikinguard_console', null, 56.1 );
	}
}
function add_Vikinguard_action_links($links) {
	return array_merge ( array (
			'settings' => '<a href="' . get_bloginfo ( 'wpurl' ) . '/wp-admin/plugins.php?page=vikinguard-config">Settings</a>' 
	), $links );
}

add_action ( 'wp_head', 'add_Vikinguard_header' );


if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	
		include_once( 'includes/woocommerce-advance.php' );

}

if (is_admin ()) {
	load_plugin_textdomain ( 'Vikinguard', false, dirname ( plugin_basename ( __FILE__ ) ) . '/i18n' );
	add_action( 'admin_enqueue_scripts', 'wpb_adding_heimdal_scripts' );
	
	add_action ( 'admin_menu', 'add_Vikinguard_admin_page' );
	add_filter ( 'plugin_action_links_' . plugin_basename ( __FILE__ ), 'add_Vikinguard_action_links' );
}
?>
