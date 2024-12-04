<?php

/**
 * Shortcodes
 */


 function hero_slider_shortcode() {
    ob_start();
    ?>
    <div id="hero" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicadores de la presentación -->
        <div class="carousel-indicators">
            <?php for ($i = 0; $i < 3; $i++) : ?>
                <button type="button" data-bs-target="#hero" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $i + 1; ?>"></button>
            <?php endfor; ?>
        </div>

        <!-- Hero dinámico con fondo oscuro y descripciones interactivas -->
        <div class="carousel-inner"> <!-- Eliminamos height h-100 para evitar problemas -->
            <?php
            $page_id = get_option('page_on_front');
            if ($page_id) {
                for ($i = 1; $i <= 3; $i++) {
                    $card = get_field("hero_$i", $page_id); // Extraemos los grupos hero_1, hero_2, etc.
                    if (!empty($card) && isset($card["image_$i"], $card["title_$i"], $card["body_$i"])) {
                        $image = $card["image_$i"];
                        $title = $card["title_$i"];
                        $body = $card["body_$i"];
                        $active_class = ($i === 1) ? 'active' : '';

                        if ($image) {
                            $image_url = wp_get_attachment_image_src($image, 'full')[0];
                            ?>
                            <div class="carousel-item <?php echo esc_attr($active_class); ?>">
                                <div class="position-relative w-100 h-100">
                                    <img src="<?php echo esc_url($image_url); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="Slide <?php echo esc_attr($i); ?>">
                                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);">
                                        <div class="container text-center">
                                            <!-- Título en animación -->
                                            <h5 class="text-white"><?php echo esc_html($title); ?></h5>
                                            <!-- Descripción interactiva que invita a la introspección -->
                                            <p class="lead text-white"><?php echo esc_html($body); ?></p>
                                            <!-- Botón hacia Spotify con efecto visual -->
                                                <button type="button" class="btn btn-em-gold btn-lg shadow-lg" data-bs-toggle="modal" data-bs-target="#subscribeModal">
                                                    Suscribete <i class="bi bi-person-hearts me-2 text-white"></i> 
                                                </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
            }
            ?>
        </div>

        <!-- Controles de navegación del carousel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#hero" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hero" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ev-hero', 'hero_slider_shortcode');


// About Section con imágenes, Lightbox y Modal adaptado
function ev_about_shortcode() {
    $data = blog_get_page(array('sobre-nosotros'));
    while ($data->have_posts()) {
        $data->the_post(); ?>
        
        <section id="about" class="mb-5 py-5">
            <div class="container shadow-custom rounded p-4 text-center">
                <?php $intro = get_field('introductions'); ?>
                <h2 class="display-6">
                    <?php echo esc_html($intro["intro_1"]); ?>
                </h2>
                <p class="lead">
                    <?php echo esc_html($intro["intro_2"]); ?>
                </p>

                <!-- Botón de suscripción -->
                <a href="https://calendly.com/momistica/asesoria-alquimiza" target="_blank" class="btn btn-em-gold btn-lg shadow-lg">
                    Agenda <i class="bi bi-calendar rounded-circle"></i>
                </a>
            </div>

            <div class="container py-4">
                <div class="row text-center">
                    <?php
                    // Loop para las tarjetas
                    for ($i = 1; $i <= 3; $i++) {
                        $card = get_field("card_$i");
                        if ($card) { ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body rounded">
                                        <div class="card-icon mb-3">
                                            <i class="bi bi-moon-stars-fill display-4 text-gold"></i>
                                        </div>
                                        <h5 class="card-title"><?php echo esc_html($card["title_$i"]); ?></h5>
                                        <p class="card-text"><?php echo esc_html($card["body_$i"]); ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>

                <!-- Galería de imágenes con Lightbox -->
                <div class="row">
                    <?php 
                    $images = get_field("images");
                    for ($j = 1; $j <= 3; $j++) {
                        $image = $images["image_$j"];
                        if ($image) { ?>
                            <div class="col-md-4 mb-4">
                                <a href="<?php echo esc_url($image['url']); ?>" data-lightbox="gallery" data-title="<?php echo esc_attr($image['alt']); ?>">
                                    <div class="image-container">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="img-fluid">
                                    </div>
                                </a>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>

            <!-- Modal de suscripción -->
            <?php ev_subscribe_modal(); ?>
        </section>
    <?php
    }
    wp_reset_postdata();
}
add_shortcode('ev-sobre-nosotros', 'ev_about_shortcode');


function ev_subscribe_modal()
{ ?>
        <!-- Modal de Bootstrap -->
        <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="subscribeModalLabel">Suscríbete a Nuevas Aventuras</h5> <!-- Texto en negro -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario de contacto -->
                        <form id="modalContactForm" class="needs-validation mt-4" novalidate>
                            <div class="mb-3">
                                <label for="modalName" class="form-label text-dark">Nombre:</label> <!-- Texto en negro -->
                                <input type="text" class="form-control text-dark" id="modalName" name="contact_name" required minlength="3" placeholder="Ingresa tu nombre">
                                <div class="invalid-feedback">Por favor ingrese un nombre con al menos 3 caracteres</div>
                            </div>
                            <div class="mb-3">
                                <label for="modalEmail" class="form-label text-dark">Correo Electrónico:</label> <!-- Texto en negro -->
                                <input type="email" class="form-control text-dark" id="modalEmail" name="contact_email" required placeholder="email@ejemplo.cl">
                                <div class="invalid-feedback">Por favor ingrese un correo electrónico válido</div>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" id="subscribeCheck" name="contact_subscribe" value="yes" checked="checked">
                                <label class="form-check-label text-dark" for="subscribeCheck">
                                    Deseo recibir actualizaciones y promociones
                                </label>
                            </div>
                            <button type="submit" class="btn btn-gold w-100">Enviar</button> <!-- Botón con color amarillo oro -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    add_action('ev_modal_subscribe', 'blog_subscribe_modal');

// Servicios & Programas adaptado para Escuela Mística
function ev_servicios_shortcode()
{
    $data = blog_get_page(array('servicios'));

    while ($data->have_posts()) {
        $data->the_post();
        $intro = get_field('introductions');

    ?>
        <section class="py-5 bg-dark-blue text-light" id="servicios-programas"> <!-- Fondo azul oscuro y texto claro -->
            <div class="container">
                <div class="text-center mb-4">
                    <h2 class="text-gold display-6"><?php echo esc_html($intro["intro_1"]); ?></h2> <!-- Título principal -->
                    <p class="lead text-muted"> <?php echo esc_html($intro["intro_2"]); ?></p>
                </div>

                <!-- Carousel de Servicios -->
                <div id="carousel-servicios" class="carousel slide overflow-hidden rounded" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php for ($i = 0; $i < 3; $i++) { ?>
                            <button type="button" data-bs-target="#carousel-servicios" data-bs-slide-to="<?php echo $i; ?>" <?php echo ($i === 0) ? 'class="active"' : ''; ?> aria-label="Slide <?php echo $i + 1; ?>"></button>
                        <?php } ?>
                    </div>

                    <div class="carousel-inner">
                        <?php for ($i = 1; $i <= 3; $i++) {
                            $card = get_field('card_' . $i);
                            $image = $card['image_' . $i];
                            $title = $card['title_' . $i];
                            $body = $card['body_' . $i];
                            $link = $card['link_' . $i];
                        ?>
                            <div class="carousel-item <?php echo ($i === 1) ? 'active' : ''; ?>" data-bs-interval="8000">
                                <div class="card h-100 border-0 shadow-lg">
                                    <a href="<?php echo esc_url($link); ?>" target="_blank">
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" class="d-block w-100 rounded">
                                    </a>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h3 class="fs-4 fw-bold text-gold"><?php echo esc_html($title); ?></h3>
                                        <p class="text-light"><?php echo esc_html($body); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Controles del carousel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-servicios" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-servicios" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="container py-5">
                <div class="text-center text-light">
                    <p><?php echo esc_html($intro["intro_3"]); ?></p>
                </div>
            </div>
        </section>
    <?php
    }

    wp_reset_postdata();
}
add_shortcode('ev-servicios', 'ev_servicios_shortcode');



// Shortcode para la sección de música
function ev_perfil_shortcode() {
    ob_start();
    
    // Obtener los valores de ACF
    $links = get_field('embebidos'); 

    $spotify_link = $links['spotify_link']; // Asignado a la página de opciones o página específica
    $youtube_link = $links['youtube_link'];
    
    // Comprobar si los enlaces están disponibles ?>
    
        <section id="music-section" class="py-5 bg-light text-dark">
            <div class="container">
                <div class="row justify-content-center mb-4">
                    <div class="col-md-8 text-center">
                        <h2 class="display-6 text-primary mb-3">¡Escucha y Descubre!</h2>
                        <p class="lead text-muted">Explora esta música en Spotify y nuestros videos en YouTube</p>
                    </div>
                </div>

                <div class="row g-4"> <!-- Usar g-4 para espacio entre columnas -->
                    <?php if ($spotify_link): ?>
                        <div class="col-md-6">
                            <div class="ratio ratio-16x9 shadow-lg rounded"> <!-- Reemplazar embed-responsive con ratio -->
                                <iframe class="rounded" src="<?php echo esc_url($spotify_link); ?>" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($youtube_link): ?>
                        <div class="col-md-6">
                            <div class="ratio ratio-16x9 shadow-lg rounded">
                                <iframe class="rounded" src="<?php echo esc_url($youtube_link); ?>" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

    <?php 

    return ob_get_clean();
}
add_shortcode('ev-perfil-section', 'ev_perfil_shortcode');

// Patreon & Apoyo Comunitario con Redes Sociales Shortcode
function patreon_support_shortcode() {
    // Obtener los valores de los campos de ACF
    $patreon = get_field('patreon');
    $patreon_url = $patreon['patreon_url'];
    $support_message = $patreon['support_message'];

    // Obtener enlaces a redes sociales de ACF
    $links = get_field('rss');
    $youtube_link = $links['youtube_link'];
    $instagram_link = $links['instagram_link'];
    $tiktok_link = $links['tiktok_link'];

    ob_start();
    ?>
    <section id="support" class="py-5 bg-light text-center"> <!-- Sección con fondo claro -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="mb-4 text-primary">Apoya Mi Trabajo</h2>
                    <p class="lead text-muted mb-4"><?php echo esc_html($support_message); ?></p>
                    
                    <!-- Botón de Patreon -->
                    <a href="<?php echo esc_url($patreon_url); ?>" target="_blank" class="btn btn-lg btn-patreon shadow-lg mb-3">
                        Apóyame en Patreon <i class="bi bi-patreon"></i>
                    </a>
                </div>
            </div>

            <!-- Redes Sociales -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="social-links mt-4">
                        <?php if ($youtube_link): ?>
                            <a href="<?php echo esc_url($youtube_link); ?>" target="_blank" class="social-icon" aria-label="YouTube">
                                <i class="bi bi-youtube"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($instagram_link): ?>
                            <a href="<?php echo esc_url($instagram_link); ?>" target="_blank" class="social-icon" aria-label="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($tiktok_link): ?>
                            <a href="<?php echo esc_url($tiktok_link); ?>" target="_blank" class="social-icon" aria-label="Tik Tok">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('patreon-support', 'patreon_support_shortcode');


// Función para crear el shortcode de calendario con eventos de ACF y modales
function blog_calendar_events_shortcode() {
    $calendar = new Calendar(date('Y-m-d'));

    $data = blog_get_custom_post_type(array('evento'));        
    $posts = $data->posts;

    foreach ($posts as $post) {
        $on = get_field('on', $post); 
        $date = get_field('date', $post);
        
        if ($on && $date) {
            $calendar->add_event($post->post_title, $date, 1, $post->ID);
        }
    }

    ob_start();
    ?>
    <section class="container-bg pt-5 pb-5" id="eventos-calendar">
        <?= $calendar ?>
    </section>

    <?php
    foreach ($posts as $post) {
        $on = get_field('on', $post);
        $date = get_field('date', $post);

        if ($on && $date) {
            $modal_id = 'modal_' . $post->ID;
            ?>
            <div class="modal fade" id="<?= $modal_id ?>" tabindex="-1" aria-labelledby="<?= $modal_id ?>Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="<?= $modal_id ?>Label"><?= esc_html($post->post_title); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?= apply_filters('the_content', $post->post_content); ?>
                            <p><strong>Fecha:</strong> <?= get_field('date', $post); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a href="#" class="btn btn-primary">Comprar entradas</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    return ob_get_clean();
}
add_shortcode('ev_calendar_eventos', 'blog_calendar_events_shortcode');
function blog_page_testimonials_shortcode() {
    // Obtener los testimonios
    $data = blog_get_custom_post_type('testimonial', 9);

    if ($data->have_posts()) {
        ?>
        <section class="testimonials-section py-5" id="testimonios">
            <div class="container">
                <div class="title text-center mb-4">
                    <h2 class="text-gold">Testimonios</h2>
                </div>

                <div id="testimonials-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php 
                        $total_slides = ceil($data->post_count / 3);
                        for ($i = 0; $i < $total_slides; $i++) { 
                        ?>
                            <button type="button" data-bs-target="#testimonials-carousel" data-bs-slide-to="<?php echo $i; ?>" <?php if ($i === 0) echo 'class="active"'; ?> aria-label="Slide <?php echo $i + 1; ?>"></button>
                        <?php } ?>
                    </div>

                    <div class="carousel-inner">
                        <?php
                        $counter = 0;

                        echo '<div class="carousel-item active"><div class="row">';

                        while ($data->have_posts()) {
                            $data->the_post();
                            $testimonial_link = get_post_meta(get_the_ID(), '_testimonial_link', true);

                            ?>
                            <div class="col-md-4 mb-4">
                                <div class="video-container">
                                    <?php if (!empty($testimonial_link)): ?>
                                        <iframe width="100%" height="200" src="<?php echo esc_attr($testimonial_link); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <?php else: ?>
                                        <p class="text-muted">No hay video disponible.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php

                            $counter++;

                            if ($counter % 3 === 0 && $data->current_post + 1 < $data->post_count) {
                                echo '</div></div>';
                                echo '<div class="carousel-item"><div class="row">';
                            }
                        }

                        echo '</div></div>';
                        ?>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonials-carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonials-carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
        <?php
        wp_reset_postdata();
    } else {
        ?>
        <section class="testimonials-section py-5" id="testimonios">
            <div class="container text-center">
                <p class="text-muted">No hay testimonios disponibles.</p>
            </div>
        </section>
        <?php
    }
}

add_shortcode('ev-testimonios', 'blog_page_testimonials_shortcode');
