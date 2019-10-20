<?php /* Default template for displaying content. */ ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header mh-clearfix"><?php
		mh_magazine_lite_featured_image();
		the_title('<h1 class="entry-title">', '</h1>');
		mh_post_header(); ?>
	</header>
	<?php dynamic_sidebar('posts-1'); ?>
	<div class="entry-content mh-clearfix"><?php
		the_content(); ?>
	</div><?php
	the_tags('<div class="entry-tags mh-clearfix"><i class="fa fa-tag"></i><ul><li>','</li><li>','</li></ul></div>');
	dynamic_sidebar('posts-2'); ?>
</article>
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
