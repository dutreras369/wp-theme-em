jQuery(document).ready(function ($) {
  function getRegions() {
    // Obtener datos desde el archivo JSON
    $.getJSON(formData.jsonUrl, function (data) {
      const regiones = data.regiones;

      // Llenar el selector de regiones
      regiones.forEach((region) => {
        $("#region").append(new Option(region.nombre, region.nombre));
      });

      // Cuando cambia la región, actualizar el selector de provincias
      $("#region").on("change", function () {
        const selectedRegion = $(this).val();
        $("#provincia")
          .empty()
          .append(new Option("Seleccione una provincia", ""))
          .prop("disabled", false);
        $("#comuna")
          .empty()
          .append(new Option("Seleccione una comuna", ""))
          .prop("disabled", true);

        // Encontrar la región seleccionada
        const regionData = regiones.find(
          (region) => region.nombre === selectedRegion
        );
        if (regionData) {
          regionData.provincias.forEach((provincia) => {
            $("#provincia").append(
              new Option(provincia.nombre, provincia.nombre)
            );
          });
        }
      });

      // Cuando cambia la provincia, actualizar el selector de comunas
      $("#provincia").on("change", function () {
        const selectedRegion = $("#region").val();
        const selectedProvincia = $(this).val();
        $("#comuna")
          .empty()
          .append(new Option("Seleccione una comuna", ""))
          .prop("disabled", false);

        // Encontrar la región y provincia seleccionadas
        const regionData = regiones.find(
          (region) => region.nombre === selectedRegion
        );
        const provinciaData = regionData.provincias.find(
          (provincia) => provincia.nombre === selectedProvincia
        );
        if (provinciaData) {
          provinciaData.comunas.forEach((comuna) => {
            $("#comuna").append(new Option(comuna, comuna));
          });
        }
      });
    });
  }

  function haveEnterprise() {
    // Mostrar u ocultar el campo de RUT de la empresa
    $("#tiene_empresa").on("change", function () {
      if ($(this).is(":checked")) {
        $("#rut_empresa_field").show();
      } else {
        $("#rut_empresa_field").hide().find("input").val("");
      }
    });
  }

  function handleClientForm() {
    $("#clienteForm").on("submit", function (event) {
      event.preventDefault();

      // Validación de RUT de la empresa solo si el checkbox está seleccionado
      var tieneEmpresa = $("#tiene_empresa").is(":checked");
      var rutEmpresa = tieneEmpresa ? $("#rut_empresa").val() : "";

      var formData = {
        action: "handle_cliente_form",
        cliente_nombre: $("#cliente_nombre").val(),
        cliente_email: $("#cliente_email").val(),
        cliente_rut: $("#cliente_rut").val(),
        nombre_emprendimiento: $("#nombre_emprendimiento").val(),
        tiene_empresa: tieneEmpresa,
        rut_empresa: rutEmpresa,
        dominio_deseado: $("#dominio_deseado").val(),
        cliente_telefono: $("#cliente_telefono").val(),
        direccion: {
          region: $("#region").val(),
          provincia: $("#provincia").val(),
          comuna: $("#comuna").val(),
          calle: $("#calle").val(),
        },
      };

      console.log(formData);

      // Validación de ejemplo: verificar que todos los campos obligatorios estén llenos
      var isValid = true;
      $(".is-invalid").removeClass("is-invalid");
      $(".invalid-feedback").remove(); // Limpiar mensajes de error

      if (!formData.cliente_nombre || formData.cliente_nombre.length < 3) {
        $("#cliente_nombre")
          .addClass("is-invalid")
          .after(
            '<div class="invalid-feedback">Por favor ingrese un nombre válido.</div>'
          );
        isValid = false;
      }
      // Validación de email
      var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (
        !formData.cliente_email ||
        !emailPattern.test(formData.cliente_email)
      ) {
        $("#cliente_email")
          .addClass("is-invalid")
          .after(
            '<div class="invalid-feedback">Por favor ingrese un email válido.</div>'
          );
        isValid = false;
      }

      if (!formData.cliente_rut) {
        $("#cliente_rut")
          .addClass("is-invalid")
          .after(
            '<div class="invalid-feedback">Por favor ingrese un RUT válido.</div>'
          );
        isValid = false;
      }

      if (!formData.nombre_emprendimiento) {
        $("#nombre_emprendimiento")
          .addClass("is-invalid")
          .after(
            '<div class="invalid-feedback">Por favor ingrese el nombre del emprendimiento.</div>'
          );
        isValid = false;
      }

      var phonePattern = /^[0-9]{7,15}$/; // Acepta solo números, entre 7 y 15 dígitos
      if (
        !formData.cliente_telefono ||
        !phonePattern.test(formData.cliente_telefono)
      ) {
        $("#cliente_telefono")
          .addClass("is-invalid")
          .after(
            '<div class="invalid-feedback">Por favor ingrese un número de teléfono válido.</div>'
          );
        isValid = false;
      }
      if (formData.tiene_empresa && !formData.rut_empresa) {
        $("#rut_empresa")
          .addClass("is-invalid")
          .after(
            '<div class="invalid-feedback">Por favor ingrese un RUT válido para la empresa.</div>'
          );
        isValid = false;
      }

      if (!formData.direccion.region) {
        $("#region")
          .addClass("is-invalid")
          .after(
            '<div class="invalid-feedback">Por favor seleccione una región.</div>'
          );
        isValid = false;
      }

      if (!formData.direccion.provincia) {
        $("#provincia")
          .addClass("is-invalid")
          .after(
            '<div class="invalid-feedback">Por favor seleccione una provincia.</div>'
          );
        isValid = false;
      }

      if (!formData.direccion.comuna) {
        $("#comuna")
          .addClass("is-invalid")
          .after(
            '<div class="invalid-feedback">Por favor seleccione una comuna.</div>'
          );
        isValid = false;
      }

      if (!formData.direccion.calle) {
        $("#calle")
          .addClass("is-invalid")
          .after(
            '<div class="invalid-feedback">Por favor ingrese una calle.</div>'
          );
        isValid = false;
      }
      if (isValid) {
        console.log(formData.ajax_url);

        $.ajax({
          url: ajax_object.ajax_url,
          type: "POST",
          data: formData,
          success: function (response) {
            if (response.success) {
              alert("¡Cliente registrado correctamente!");
              $("#clienteForm").trigger("reset");
              $("#rut_empresa_field").hide(); // Ocultar campo de empresa
            } else {
              alert(response.data);
            }
          },
          error: function (xhr, status, error) {
            console.error("Error:", error);
            alert("Error en la comunicación con el servidor.");
          },
        });
      }
    });
  }

  function handleContactForm() {
    $("#registerForm").on("submit", function (event) {
      event.preventDefault();
      var isValid = true;

      // Limpiar mensajes de error anteriores
      $(".invalid-feedback").remove();
      $(".is-invalid").removeClass("is-invalid");

      // Validar nombre
      var username = $("#username").val().trim();
      if (username === "") {
        isValid = false;
        $("#username").addClass("is-invalid");
        $("#username").after(
          '<div class="invalid-feedback">Por favor ingrese un nombre.</div>'
        );
      }

      // Validar email
      var email = $("#email").val().trim();
      var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
      if (email === "") {
        isValid = false;
        $("#email").addClass("is-invalid");
        $("#email").after(
          '<div class="invalid-feedback">Por favor ingrese un email.</div>'
        );
      } else if (!emailPattern.test(email)) {
        isValid = false;
        $("#email").addClass("is-invalid");
        $("#email").after(
          '<div class="invalid-feedback">Por favor ingrese un email válido.</div>'
        );
      }

      // Validar mensaje si está presente
      var message = $("#msj").val().trim();
      if (message.length > 0 && message.length < 10) {
        isValid = false;
        $("#msj").addClass("is-invalid");
        $("#msj").after(
          '<div class="invalid-feedback">El mensaje debe tener al menos 10 caracteres si lo llenas.</div>'
        );
      }

      var subscribe = $("#subscribeContact").is(":checked") ? "yes" : "no";

      // Si el formulario es válido, enviar la solicitud AJAX
      if (isValid) {
        var formData = {
          action: "handle_contact_form",
          contact_name: username,
          contact_email: email,
          contact_message: message,
          contact_subscribe: subscribe,

        };

        $.ajax({
          url: ajax_object.ajax_url, // Asegúrate de que esta URL esté correctamente localizada en PHP
          type: "POST",
          data: formData,
          success: function (response) {
            if (response.success) {
              alert("¡Formulario enviado correctamente!");
              $("#registerForm").trigger("reset"); // Limpiar formulario
            } else {
              alert(response.data); // Mostrar mensaje de error del servidor
            }
          },
          error: function (xhr, status, error) {
            console.error(xhr.responseText); // Mostrar el error en la consola
            alert("Error en la comunicación con el servidor.");
          },
        });
      }
    });
  }

  function handleSubscriptionForm() {
    // Manejar la validación del formulario del modal
    $("#modalContactForm").on("submit", function (event) {
      event.preventDefault();
      var isValid = true;

       // Obtener el estado del checkbox
       const subscribeChecked = $("#subscribeCheck").prop("checked");
       console.log("Checkbox suscripción está marcado:", subscribeChecked);

      // Validar nombre
      var name = $("#modalName").val().trim();
      if (name.length < 3) {
        isValid = false;
        $("#modalName").addClass("is-invalid");
      } else {
        $("#modalName").removeClass("is-invalid");
      }

      // Validar correo electrónico
      var email = $("#modalEmail").val().trim();
      var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
      if (!emailPattern.test(email)) {
        isValid = false;
        $("#modalEmail").addClass("is-invalid");
      } else {
        $("#modalEmail").removeClass("is-invalid");
      }

      // Obtener el estado del checkbox
      var subscribe = $("#subscribeCheck").is(":checked") ? "yes" : "no";

      // Enviar datos si el formulario es válido
      if (isValid) {
        var formData = {
          action: "handle_contact_form",
          contact_name: name,
          contact_email: email,
          contact_subscribe: subscribe
        };

        $.ajax({
          url: ajax_object.ajax_url,
          type: "POST",
          data: formData,
          success: function (response) {
            if (response.success) {
              alert("¡Formulario enviado correctamente!");
              $("#modalContactForm").trigger("reset");
            } else {
              alert("Error: " + response.data);
            }
          },
          error: function (xhr) {
            console.error(xhr.responseText);
            alert("Error al enviar el formulario.");
          },
        });
      }
    });
  }

  getRegions();
  haveEnterprise();
  handleClientForm();
  handleContactForm();
  handleSubscriptionForm();
});
