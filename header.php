<?php

/**
 * The header for our theme
 *
 * This template displays the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package blog-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site">
        <!-- Skip to content link for screen readers -->
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'tiendavirtual'); ?></a>

        <!-- Announcement Bar -->
        <div class="announcement-bar">
            <div class="row">
                <div class="col d-flex justify-content-center justify-content-md-end">
                    <ul class="announcement-bar__list ml-2">
                        <li>
                            <a class="text-white text-decoration-none" href="https://www.youtube.com/@Momistica">
                                <i class="bi bi-youtube rounded-circle"></i>
                            </a>
                        </li>
                        <li>
                            <a class="text-white text-decoration-none" href="https://www.instagram.com/momistica/">
                                <i class="bi bi-instagram rounded-circle"></i>
                            </a>
                        </li>
                        <li>
                            <a class="text-white text-decoration-none" href="https://web.facebook.com/momistica">
                                <i class="bi bi-facebook rounded-circle"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Site Header -->
        <header id="masthead" class="site-header">

            <div class="container py-2">
                <div class="row align-items-center">
                    <div class="col d-flex justify-content-center justify-content-md-start site-header__logo">
                        <?php the_custom_logo(); ?>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav id="site-navigation" class="main-navigation">
                <div class="container d-flex justify-content-center">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button class="menu-toggle bg-primary" aria-controls="primary-menu" aria-expanded="false">
                                <i class="bi bi-list"></i>
                            </button>
                        </div>
                        <div class="col-12 text-center">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-1',
                                    'menu_id'        => 'primary-menu',
                                )
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Hero Section (if on front page) -->
        <?php
        if (is_front_page()) {
            echo do_shortcode('[ev-hero]');
        }
        ?>
    </div>