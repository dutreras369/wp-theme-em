jQuery(document).ready(function ($) {
  // Animación de texto
  function animateText() {
    var $textWrapper = $(".ml3");
    if ($textWrapper.length) {
      $textWrapper.html(
        $textWrapper.text().replace(/\S/g, "<span class='letter'>$&</span>")
      );

      anime
        .timeline({ loop: true })
        .add({
          targets: ".ml3 .letter",
          opacity: [0, 1],
          easing: "easeInOutQuad",
          duration: 2250,
          delay: function (el, i) {
            return 150 * (i + 1);
          },
        })
        .add({
          targets: ".ml3",
          opacity: 0,
          duration: 1000,
          easing: "easeOutExpo",
          delay: 1000,
        });
    }
  }

  function handleMenuNavigation() {
    $(".menu-toggle").on("click", function () {
      $("#site-navigation").toggleClass("menu-open");

      // Cambia el aria-expanded de acuerdo al estado del menú
      var expanded = $(this).attr("aria-expanded") === "true" || false;
      $(this).attr("aria-expanded", !expanded);
    });

    // Cierra el menú si se hace clic fuera de él
    $(document).on("click", function (e) {
      if (
        !$(e.target).closest("#site-navigation").length &&
        $("#site-navigation").hasClass("menu-open")
      ) {
        $("#site-navigation").removeClass("menu-open");
        $(".menu-toggle").attr("aria-expanded", false);
      }
    });
  }

  function handleHeroCarousel() {
    $(".carousel").carousel({
      interval: 5000, // Cambia cada 5 segundos
      ride: "carousel",
    });
  }

  /* function handleSubscriptionForm() {

        $('#registerForm').on('submit', function (event) {
            event.preventDefault();
            var isValid = true;

            // Limpiar mensajes de error anteriores
            $('.invalid-feedback').remove();
            $('.is-invalid').removeClass('is-invalid');

            // Validar nombre
            var username = $('#username').val().trim();
            if (username === '') {
                isValid = false;
                $('#username').addClass('is-invalid');
                $('#username').after('<div class="invalid-feedback">Por favor ingrese un nombre.</div>');
            }

            // Validar email
            var email = $('#email').val().trim();
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (email === '') {
                isValid = false;
                $('#email').addClass('is-invalid');
                $('#email').after('<div class="invalid-feedback">Por favor ingrese un email.</div>');
            } else if (!emailPattern.test(email)) {
                isValid = false;
                $('#email').addClass('is-invalid');
                $('#email').after('<div class="invalid-feedback">Por favor ingrese un email válido.</div>');
            }

            // Validar mensaje si existe en el formulario
            if ($('#msj').length > 0) {
                var message = $('#msj').val().trim();
                if (message === '') {
                    isValid = false;
                    $('#msj').addClass('is-invalid');
                    $('#msj').after('<div class="invalid-feedback">Por favor ingrese un mensaje.</div>');
                }
            }

            // Si el formulario es válido, enviar la solicitud AJAX
            if (isValid) {
                var formData = {
                    'action': 'handle_contact_form',
                    'contact_name': username,
                    'contact_email': email,
                    'contact_message': message
                };

                $.ajax({
                    url: ajax_object.ajax_url,  // Asegúrate de que esta URL esté correctamente localizada en PHP
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            alert('¡Formulario enviado correctamente!');
                            $('#registerForm').trigger('reset');  // Limpiar formulario
                        } else {
                            alert(response.data);  // Mostrar mensaje de error del servidor
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);  // Mostrar el error en la consola
                        alert('Error en la comunicación con el servidor.');
                    }
                });
            }
        });
    } */

  handleMenuNavigation();
  handleHeroCarousel();
  animateText();
  /* handleSubscriptionForm(); */
});
