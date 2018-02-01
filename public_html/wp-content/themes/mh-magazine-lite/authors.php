<?php /* Template Name: Autores */ ?>


<?php get_header(); ?>
<div class="mh-wrapper mh-clearfix">
	<!-- This sets the $curauth variable -->

    <?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>


<h2>Acerca: <?php echo $curauth->nickname; ?></h2>


<dl>

<dt>Web</dt>


<dd><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></dd>


<dt>Perfil</dt>


<dd><?php echo $curauth->user_description; ?></dd>

    </dl>



<h2>Entradas de <?php echo $curauth->nickname; ?>:</h2>



<ul>
<!-- El Loop -->

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<li>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Enlace permanente: <?php the_title(); ?>">
            <?php the_title(); ?></a>,
            <?php the_time('d M Y'); ?> en <?php the_category('&');?>
        </li>


    <?php endwhile; else: ?>


<?php _e('Ninguna entrada de este autor.'); ?>


    <?php endif; ?>

<!-- Fin del Loop -->

    </ul>

</div>
</div>
<?php get_footer(); ?>