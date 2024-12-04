<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blog-theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero text-center py-5 mb-4 bg-light">
        <div class="container">
            <h1 class="display-4 entry-title ml3"><?php esc_html_e('Bienvenido a Nuestro Blog', 'tiendavirtual'); ?></h1>
            <p class="lead"><?php esc_html_e('Manténgase actualizado con las últimas noticias y artículos.', 'tiendavirtual'); ?></p>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <section class="blog-posts my-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-4">
                    <?php get_sidebar(); ?>
                </div>

                <!-- Main Content -->
                <div class="col-md-8">
                    <div class="row">
                        <?php
                        if (have_posts()) :
                            while (have_posts()) : the_post(); ?>
                                <div class="col-md-6 mb-4">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class('card shadow-sm'); ?>>
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="card-img-top">
                                                <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h2 class="card-title"><?php the_title(); ?></h2>
                                            <p class="card-text"><?php the_excerpt(); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="btn btn-primary text-white"><?php esc_html_e('Leer más', 'tiendavirtual'); ?></a>
                                        </div>
                                    </article>
                                </div>
                        <?php endwhile;
                        else :
                            echo '<p>' . esc_html__('No se encontraron publicaciones', 'tiendavirtual') . '</p>';
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- #main -->

<?php get_footer(); ?>