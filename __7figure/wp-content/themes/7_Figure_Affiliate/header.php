<?php
/**
 * Header Template
 * 7 Figure Affiliate Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header bg-slate-900 text-white shadow-lg">
        <nav class="navbar bg-slate-900 py-4 px-6">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                
                <!-- Logo/Brand -->
                <div class="site-branding">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-bold text-amber-500 hover:text-amber-400 transition">
                        <?php bloginfo('name'); ?>
                    </a>
                </div>

                <!-- Primary Navigation -->
                <div class="site-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'fallback_cb' => 'wp_page_menu',
                        'container' => 'div',
                        'container_class' => 'nav-menu hidden md:flex gap-8',
                        'menu_class' => 'flex gap-8 items-center',
                        'link_before' => '<span class="hover:text-amber-400 transition">',
                        'link_after' => '</span>',
                    ));
                    ?>
                    
                    <!-- Fallback Navigation -->
                    <div class="nav-menu hidden md:flex gap-8">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-amber-400 transition">
                            <?php esc_html_e('Home', '7-figure-affiliate'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/products')); ?>" class="hover:text-amber-400 transition">
                            <?php esc_html_e('Products', '7-figure-affiliate'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/about-michael')); ?>" class="hover:text-amber-400 transition">
                            <?php esc_html_e('About', '7-figure-affiliate'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/blog')); ?>" class="hover:text-amber-400 transition">
                            <?php esc_html_e('Blog', '7-figure-affiliate'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="hover:text-amber-400 transition">
                            <?php esc_html_e('Contact', '7-figure-affiliate'); ?>
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="md:hidden text-white text-2xl" id="mobile-menu-toggle">
                    ☰
                </button>

            </div>
        </nav>
    </header>

    <main id="main" class="site-main">
