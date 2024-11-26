<?php
/*
Template Name: Sobre Mí
*/

get_header(); ?>

<section class="p-5 bg-light" id="about-me">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4">Sobre Mí</h1>
            <p class="lead">Soy David Utreras, un ser apasionado y experimentado en el arte de diseñar y construir soluciones innovadoras que brindan experiencias únicas y significativas.</p>
        </div>

        <!-- Sección de Conexión Personal -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <h2><i class="bi bi-person-circle me-2"></i> Mi Trayectoria</h2>
                <p>He aprendido que la verdadera creación no se trata solo de soluciones técnicas, sino de algo más profundo: "La conexión entre lo que existe dentro de nosotros y el mundo que nos rodea".</p>
            </div>
            <div class="col-md-6 mb-4">
                <h2><i class="bi bi-music-note-beamed me-2"></i> Mi Música</h2>
                <p>Como cantautor bajo el nombre de Davriel Ustrel, invito a mis oyentes a un viaje interior de introspección. Mis canciones fusionan géneros como el folk, el pop acústico y la música alternativa.</p>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Habilidades -->
<section class="p-5 bg-primary text-white" id="skills">
    <div class="container">
        <h2 class="text-center display-6 mb-4"><i class="bi bi-tools me-2"></i>Habilidades y Áreas de Experiencia</h2>

        <div class="row">
            <div class="col-md-6 mb-4">
                <h3><i class="bi bi-code-slash me-2"></i> Desarrollo de Aplicaciones</h3>
                <ul>
                    <li>Lenguajes de Programación: Java, JavaScript, Python</li>
                    <li>Frameworks: React, Spring Boot, Flask, Bootstrap, WordPress</li>
                    <li>Optimización y rendimiento de sitios web</li>
                </ul>
            </div>

            <div class="col-md-6 mb-4">
                <h3><i class="bi bi-gear me-2"></i> Consultoría Tecnológica</h3>
                <ul>
                    <li>Soluciones de Ingeniería de Datos</li>
                    <li>Estrategias de Monetización en plataformas digitales</li>
                </ul>
            </div>

            <div class="col-md-6 mb-4">
                <h3><i class="bi bi-laptop me-2"></i> Diseño UI/UX</h3>
                <ul>
                    <li>Interfaz de Usuario intuitiva</li>
                    <li>Uso de técnicas de PNL para maximizar la retención</li>
                </ul>
            </div>

            <div class="col-md-6 mb-4">
                <h3><i class="bi bi-mortarboard me-2"></i> Formación y Desarrollo</h3>
                <ul>
                    <li>Planificación y estructuración de cursos en áreas de computación y emprendimiento</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Proyectos -->
<section class="p-5 bg-light" id="projects">
    <div class="container">
        <h2 class="text-center display-6 mb-4"><i class="bi bi-folder2 me-2"></i>Mis Proyectos</h2>

        <div class="row">
            <div class="col-md-6 mb-4">
                <h3><img src="<?php echo get_template_directory_uri(). '/assets/imgs/espacios-virtuales.png'; ?>" class="img-fluid w-25" loading="lazy" alt="..."> Espacios Virtuales</h3>
                <p>Proyecto de servicios electrónicos y análisis de datos que combina tecnología con soluciones prácticas para empresas.</p>
            </div>

            <div class="col-md-6 mb-4">
                <h3><img src="<?php echo get_template_directory_uri(). '/assets/imgs/enraiza.png'; ?>" class="img-fluid w-25" loading="lazy" alt="..."> Enraiza</h3>
                <p>Creación de una red social para emprendimientos orgánicos enfocados en la renovación y restauración del medio ambiente.</p>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Visión y Propósito -->
<section class="p-5 bg-primary text-white" id="vision">
    <div class="container text-center">
        <h2 class="display-6 mb-4"><i class="bi bi-lightbulb me-2"></i>Visión y Propósito</h2>
        <p class="lead">Mi propósito, tanto en el desarrollo de software como en la música, es contribuir a la evolución de la conciencia humana. Creo firmemente que la autenticidad en nuestras acciones puede transformar vidas, y es a través de esa autenticidad que nacen las conexiones más únicas y profundas.</p>
    </div>
</section>

<?php get_footer(); ?>
