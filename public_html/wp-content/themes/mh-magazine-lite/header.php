<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Granada Pro Cycling GRPC. La información del #CiclismodeGranada  
Amateur y Profesional. Noticias, entrevistas, cicloturismo...">
    <meta name"keywords" content="Granada Pro Cycling, GRPC, ciclismo, web, granada, Granada, amateur, profesional">
    <meta author="Rafael Lachica Garrido">
    <meta property="og:title" content="Granada Pro Cycling" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://granadaprocycling.com" />
    <meta property="og:image" content="https://granadaprocycling.com/wp-content/banners/favicons/grpc-favicon.png" />
    <meta name="robots" content="Index,Follow"
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<body id="mh-mobile" <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<title>Granada Pro Cycling</title>
<?php mh_before_header();
get_template_part('content', 'header');
mh_after_header(); ?>
