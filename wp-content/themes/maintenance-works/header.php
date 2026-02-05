<?php
/**
 * Header file for the Maintenance Works WordPress theme.
 * @package Maintenance Works
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php if( get_theme_mod('maintenance_works_theme_loader',false) == 1 ) { ?>
    <div class="preloader">
      <div class="loader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
  <?php }?>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
if( function_exists('wp_body_open') ){
    wp_body_open();
}
$maintenance_works_default = maintenance_works_get_default_theme_options(); ?>

<div id="maintenance-works-page" class="maintenance-works-hfeed maintenance-works-site">
<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e('Skip to the content', 'maintenance-works'); ?></a>

<?php
    get_template_part( 'template-parts/header/header', 'layout' );
?>

<div id="content" class="site-content">