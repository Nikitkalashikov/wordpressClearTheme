<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    
    <?php wp_head(); ?>
</head>
<body class="body">
<div class="body-overlay">
<header class="header">
    <div class="container">
        <div class="logo">
            <?php if ( !is_front_page() ){?>
                <a href="/">
                    <p><?php esc_html_e('Example logo', 'kalashnikof');?></p>
                </a>
            <?php }else{?>
                <p><?php esc_html_e('Example logo', 'kalashnikof');?></p>
            <?php }?>
        </div>
        <?php 
            wp_nav_menu(array('theme_location' => 'top', 'container' => 'ul', 'menu_id' => 'header__menu','menu_class'=> 'menu header__menu', 'link_class'   => 'scroll-to'));
        ?>
    </div>
</header>
<div class="page__content">