<?php mh_before_footer(); ?>
<?php mh_magazine_lite_footer_widgets(); ?>
<div class="mh-copyright-wrap">
	<div class="mh-container mh-container-inner mh-clearfix">
			<p class="mh-copyright"><?php printf(esc_html__('Copyright &copy; %1$s', 'mh-magazine-lite'), date("Y"), '<a href="' . esc_url('https://www.github.com/rafaellg8') . '" rel="nofollow">R.Lachica Garrido</a>'); ?> &nbsp&nbsp<a href="mailto:info@granadaprocycling.com">info@granadaprocycling.com</a>
		<a style="float: right" href="https://www.github.com/rafaellg8">  Rafael L.Garrido</a>
	</div>
</div>
<?php mh_after_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>