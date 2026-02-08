<?php 
/**
 * Структурированный Header дочерней темы Elmispase
 */
?>
<?php 
if ( ! function_exists( 'of_get_option' ) ) {
    function of_get_option( $name, $default = false ) { return $default; }
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<!-- ==========================================================================
     БЛОК 1: HEAD (Служебная информация)
     ========================================================================== -->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- ==========================================================================
     БЛОК 2: НАЧАЛО BODY И ОБЕРТКА САЙТА (Page Wrapper)
     ========================================================================== -->
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>
<?php do_action( 'before' ); ?>

<div id="page" class="hfeed site">
    <?php do_action( 'elmispase_before_header' ); ?>

    <!-- ==========================================================================
         БЛОК 3: HEADER (Шапка сайта: Лого, Меню, Виджеты)
         ========================================================================== -->
    <header id="masthead" class="site-header clearfix">
        
     <?php /*// 3.1. Изображение шапки (Позиция: Над навигацией)
        if( of_get_option( 'elmispase_header_image_position', 'above' ) == 'above' ) { elmispase_render_header_image(); }
         */?>

<!-- БЛОК 3.1: Изображение шапки с текстом поверх -->
<div class="custom-header-wrapper" style="position: relative;"> 
    
    <?php // Это стандартная функция Spacious, которая выводит тот самый <div> с картинкой
    if( of_get_option( 'elmispase_header_image_position', 'above' ) == 'above' ) { 
        elmispase_render_header_image(); 
    } ?>

    <!-- Вставляем ваш текст ПЕРЕД закрытием обертки -->
    <div class="header-overlay-text">
        <h1 class="hero-title">На высоте новых технологий</h1>
        <p class="hero-subtitle">«Элмис» — вдыхаем новую жизнь в ваше оборудование</p>
    
</div>
        
    <!-- Кнопка действия -->
    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-lg mt-3">
        Закзать звонок 
    </a>
</div>


  <!-- Кнопка с призывом -->
    <a href="#callback-form" class="btn-callback">Рассчитать проект</a>
</div>

</div> <!-- Конец обертки -->






<div id="header-text-nav-container">
            <div class="inner-wrap">
                <div id="header-text-nav-wrap" class="clearfix">
                    
                    <!-- 3.2. ЛЕВАЯ СЕКЦИЯ: Логотип и Название -->
                    <div id="header-left-section">
                        <?php 
                        if ( has_custom_logo() ) { the_custom_logo(); } 
                        elseif ( of_get_option( 'elmispase_header_logo_image', '' ) != '' ) { ?>
                            <div id="header-logo-image">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <img src="<?php echo of_get_option( 'elmispase_header_logo_image' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                                </a>
                            </div>
                        <?php }

                        if( of_get_option( 'elmispase_show_header_logo_text', 'text_only' ) !== 'logo_only' ) { ?>
                        <div id="header-text">
                            <h1 id="site-title"> 
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                            </h1>
                            <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
                        </div>
                        <?php } ?>
                    </div>

                    <!-- 3.3. ПРАВАЯ СЕКЦИЯ: Виджеты шапки и Меню -->
                    <div id="header-right-section">
                        <?php if( is_active_sidebar( 'elmispase_header_sidebar' ) ) : ?>	
                            <div id="header-right-sidebar" class="clearfix">
                                <?php dynamic_sidebar( 'elmispase_header_sidebar' ); ?>		
                            </div>
                        <?php endif; ?>

                        <nav id="site-navigation" class="main-navigation" role="navigation">
                            <h1 class="menu-toggle"><?php _e( 'Menu', 'elmispase' ); ?></h1>
                            <?php
                                if ( has_nav_menu( 'primary' ) ) {									
                                    wp_nav_menu( array( 'theme_location' => 'primary' ) );
                                } else { wp_page_menu(); }
                            ?>
                        </nav>					
                    </div> 
                    
               </div><!-- #header-text-nav-wrap -->
            </div><!-- .inner-wrap -->
        </div><!-- #header-text-nav-container -->

        <?php // 3.4. Изображение шапки (Позиция: Под навигацией)
        if( of_get_option( 'elmispase_header_image_position', 'above' ) == 'below' ) { elmispase_render_header_image(); } ?>

        <!-- 3.5. СЛАЙДЕР (Только для главной страницы) -->
        <?php
        if( of_get_option( 'elmispase_activate_slider', '0' ) == '1' && ( is_home() || is_front_page() ) ) {
            elmispase_featured_image_slider();
        } ?>

        <!-- 3.6. ЗАГОЛОВОК СТРАНИЦЫ (Для всех страниц, кроме главной) -->
        <?php if( ( '' != elmispase_header_title() ) && !( is_home() || is_front_page() ) ) : ?>
        <div class="header-post-title-container clearfix">
            <div class="inner-wrap">
                <div class="post-title-wrapper">
                    <h1 class="header-post-title-class"><?php echo elmispase_header_title(); ?></h1>
                </div>
                <?php if( function_exists( 'elmispase_breadcrumb' ) ) { elmispase_breadcrumb(); } ?>
            </div>
        </div>
        <?php endif; ?>
    </header>

    <?php do_action( 'elmispase_after_header' ); ?>
    <?php do_action( 'elmispase_before_main' ); ?>

    <!-- ==========================================================================
         БЛОК 4: ОСНОВНОЙ КОНТЕНТ (Начало)
         Примечание: этот блок закрывается в footer.php
         ========================================================================== -->
    <div id="main" class="clearfix">
        <div class="inner-wrap">
            <div class="inner-wrap">
    <!-- Ваша кнопка -->
    <a href="#" class="btn-callback">Рассчитать проект</a>
</div>