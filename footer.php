<a href="https://wa.me/56956412047?text=Maureen,%20Me%20gustaria%20recibir%20información%20sobre%20los%20Servicios%20%20de%20Ecuela%20Mistica" class="whatsapp-button" target="_blank">
    <i class="bi bi-whatsapp"></i>
</a>

<footer id="colophon" class="site-footer">
    <div class="bg-primary text-white pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-2">
                    <?php dynamic_sidebar('footer-widget-col-one'); ?>
                </div>
                <div class="col-sm-6 col-md-2">
                    <?php dynamic_sidebar('footer-widget-col-two'); ?>
                </div>
                <div class="col-md-4 ms-auto col-sm-12">
                    <?php dynamic_sidebar('footer-widget-col-three'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-3 pb-3">
        <div class="row d-flex align-items-center justify-content-between">
            <div class="col text-center text-md-start">
                <p class="mb-0">
                    &copy; <?php echo get_bloginfo('name') . " " . date('Y'); ?>
                    <br>
                    Creado por <a href="https://espaciosvirtuales.cl" class="text-light text-decoration-none" target="_blank" aria-label="Ir a Espacios Virtuales">Espacios Virtuales</a>
                </p>
            </div>
            <div class="col-auto text-center text-md-end">
                <img src="<?php echo get_template_directory_uri(). '/assets/imgs/logo.png'; ?>" class="img-fluid w-50" loading="lazy" alt="Logotipo de Davriel">
            </div>
        </div>
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
