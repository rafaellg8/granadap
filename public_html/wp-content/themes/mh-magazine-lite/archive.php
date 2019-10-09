<?php get_header(); ?>
<div class="mh-wrapper mh-clearfix">
	<div id="main-content" class="mh-loop mh-content" role="main"><?php
		mh_before_page_content();
		if (have_posts()) { ?>
			<header class="page-header"><?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				if (is_author()) {
					mh_magazine_lite_author_box();
				} else {
					the_archive_description('<div class="entry-content mh-loop-description">', '</div>');
				} ?>
			</header><?php
			mh_magazine_lite_loop_layout();
			mh_magazine_lite_pagination();
		} else {
			get_template_part('content', 'none');
		} ?>
    	<div class="banners-footer">
    	    <div class="banner-publi">
        		<a href="http://www.spicles.com" target="_blank">
        		    <img src="/wp-content/banners/banner-Spicles.jpg" alt="spicles-grandaprocycling">
        		</a>
        	</div>
        	<div style="clear: both"></div>
        	<div class="banner-publi">
        		<a href="https://www.hsnstore.com/hsnaffiliate/click/?linkid=b3RoZXJsaW5rfHxodHRwczovL3d3dy5oc25zdG9yZS5jb20vfHxHUkFOQURBUFJPQ1lDTElOR3x8aHR0cHM6Ly93d3cuaHNuc3RvcmUuY29tLw==" target="_blank">
        		    <img src="/wp-content/banners/hsn-banner.jpg" alt="hsn-store-granadaprocycling">
        		</a>
        	</div>
        	<div style="clear: both"></div>
        	<div class="banner-publi">
        	    <a href="http://msa.training" target="_blank">
        	        <img src="/wp-content/banners/msa-training.jpg" alt="msa-training-granadaprocycling">
        	    </a>
        	</div>
        </div>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>