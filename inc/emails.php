<?php

/* Emails */
// Funciones para enviar correos de respuesta automática
function send_custom_email_response($user_email, $subscribe)
{
    // Asunto del correo
    $subject = '¡Gracias por contactarte con nosotros!';

    // Encabezados de correo para enviar HTML y asegurar compatibilidad con Gmail
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: Escuela Mistica <info@escuelamistica.cl>';
    $headers[] = 'Reply-To: Escuela Mistica <info@escuelamistica.cl>';

    // Mensaje adicional si la casilla de suscripción está marcada
    $subscription_message = '';
    if ($subscribe === 'yes') {
        $subscription_message = '
            <p style="color: #003366; font-size: 16px; line-height: 1.5; margin-bottom: 20px;">
                Además, como te has suscrito a nuestras actualizaciones, recibirás promociones exclusivas y contenido relevante en tu correo.
            </p>';
    }

    // Cuerpo del mensaje utilizando estructura de tablas
    $message = '
    <html>
    <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 0; margin: 0;">
    <table style="width: 100%; max-width: 600px; margin: 0 auto; border-collapse: collapse; background-color: #f4f4f4;">
        <!-- Header -->
        <tr>
            <td style="background-color: #003366; padding: 20px; text-align: center;">
                <h1 style="color: #FFD700; margin: 0; font-size: 24px; font-weight: bold;">
                    ¡Gracias por contactarnos en Escuela Mistica!
                </h1>
            </td>
        </tr>
        
        <!-- Message Section -->
        <tr>
            <td style="padding: 20px; background-color: #ffffff;">
                <p style="color: #003366; font-size: 16px; line-height: 1.5; margin-bottom: 20px;">
                    ¡Hola! Agradecemos mucho que te hayas tomado el tiempo para contactarnos. Hemos recibido tu mensaje y te responderemos lo antes posible.
                </p>
                ' . $subscription_message . '
                <p style="color: #003366; font-size: 16px; line-height: 1.5;">
                    Mientras tanto, te invitamos a explorar y conectar a través de nuestras redes sociales. ¡Te esperamos!
                </p>
            </td>
        </tr>
        
        <!-- Call to Action -->
        <tr>
            <td style="background-color: #f8f9fa; padding: 20px; text-align: center;">
                <a href="https://escuelamistica.cl" style="display: inline-block; padding: 15px 30px; background-color: #FFD700; color: #003366; text-decoration: none; font-size: 16px; font-weight: bold; border-radius: 5px;">
                    Visita nuestro sitio
                </a>
            </td>
        </tr>
        
        <!-- Social Media Links -->
        <tr>
            <td style="padding: 20px; background-color: #003366; text-align: center;">
                <p style="color: #fff; font-size: 14px; margin-bottom: 10px;">Síguenos en nuestras redes sociales</p>
                <a href="https://instagram.com/momistica" style="margin: 0 10px;">Instagram</a>
                <a href="https://wa.me/56956412047?text=Maureen,%20Me%20gustaria%20recibir%20información%20sobre%20los%20Servicios%20%20de%20Ecuela%20Mistica" style="margin: 0 10px;">WhatsApp</a>
                <a href="https://www.facebook.com/momistica" style="margin: 0 10px;">Facebook</a>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="padding: 10px; text-align: center; font-size: 12px; color: #999;">
                Este es un correo automático. Por favor, no respondas a este mensaje.
            </td>
        </tr>
    </table>
    </body>
    </html>';

    // Envío del correo
    wp_mail($user_email, $subject, $message, $headers);
}


// Client Email
function send_custom_email_response_cl($user_email, $nombre_cliente)
{
    // Asunto del correo
    $subject = '🎉 ¡Bienvenido a Escuela Mistica, ' . $nombre_cliente . '! 🎉';

    // Encabezados de correo para enviar HTML y asegurar compatibilidad con Gmail
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: Escuela Mistica <info@escuelamistica.cl>';
    $headers[] = 'Reply-To: Escuela Mistica <info@escuelamistica.cl>';

    // Cuerpo del mensaje
    $message = '
    <html>
    <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 0; margin: 0;">
    <table style="width: 100%; max-width: 600px; margin: 0 auto; border-collapse: collapse; background-color: #f4f4f4;">
        <!-- Header -->
        <tr>
            <td style="background-color: #2c3e50; padding: 30px; text-align: center;">
                <h1 style="color: #FFD700; margin: 0; font-size: 26px; font-weight: bold;">
                    🎉 ¡Bienvenido a Escuela Mistica, ' . esc_html($nombre_cliente) . '! 🎉
                </h1>
            </td>
        </tr>
        
        <!-- Message Section -->
        <tr>
            <td style="padding: 20px; background-color: #ffffff;">
                <p style="color: #2c3e50; font-size: 18px; line-height: 1.6; margin-bottom: 20px;">
                    ¡Hola ' . esc_html($nombre_cliente) . '! Nos alegra mucho que hayas decidido unirte a nuestra comunidad en <strong>Espacios Virtuales</strong>. Ahora eres parte de una red que se inspira en la creatividad, la innovación y el crecimiento.
                </p>
                <p style="color: #2c3e50; font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                    Nuestro equipo está aquí para apoyarte en cada paso de tu viaje digital. A continuación, te invitamos a explorar nuestros recursos y a conectar con nosotros en redes sociales. ¡Juntos lograremos grandes cosas!
                </p>
            </td>
        </tr>
        
        <!-- Call to Action -->
        <tr>
            <td style="background-color: #f8f9fa; padding: 30px; text-align: center;">
                <a href="https://https://escuelamistica.cl" style="display: inline-block; padding: 15px 30px; background-color: #FFD700; color: #2c3e50; text-decoration: none; font-size: 18px; font-weight: bold; border-radius: 5px;">
                    Explora Escuela Mistica 
                </a>
            </td>
        </tr>
        
        <!-- Social Media Links -->
        <tr>
            <td style="padding: 20px; background-color: #2c3e50; text-align: center;">
                <p style="color: #fff; font-size: 16px; margin-bottom: 10px;">¡Síguenos y conecta con nuestra comunidad!</p>
                <a href="https://instagram.com/momistica" style="margin: 0 10px; color: #FFD700; font-size: 16px;">Instagram</a> |
                <a href="https://wa.me/56956412047?text=Maureen,%20Me%20gustaria%20recibir%20información%20sobre%20los%20Servicios%20%20de%20Ecuela%20Mistica" style="margin: 0 10px;">WhatsApp</a>
                <a href="https://facebook.com/momistica" style="margin: 0 10px; color: #FFD700; font-size: 16px;">Facebook</a>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="padding: 15px; text-align: center; font-size: 14px; color: #999;">
                Este es un correo automático. Por favor, no respondas a este mensaje.
            </td>
        </tr>
    </table>
    </body>
    </html>';

    // Envío del correo y verificación del éxito del envío
    $sent = wp_mail($user_email, $subject, $message, $headers);

    if (! $sent) {
        error_log('Error al enviar el correo a ' . $user_email);
    }
}


/* Actions */
// Procesar formularios vía AJAX
// Contact Form
function handle_contact_form()
{
    if (isset($_POST['contact_name'], $_POST['contact_email'])) {
        $name = sanitize_text_field($_POST['contact_name']);
        $email = sanitize_email($_POST['contact_email']);
        $message = isset($_POST['contact_message']) ? sanitize_textarea_field($_POST['contact_message']) : '';
        $subscribe = isset($_POST['contact_subscribe']) ? sanitize_text_field($_POST['contact_subscribe']) : 'no';

        error_log("Valor recibido de contact_subscribe: " . $subscribe);

        if (!is_email($email)) {
            wp_send_json_error('Por favor ingresa un email válido');
        }

        $post_id = wp_insert_post(array(
            'post_type'   => 'contacto',
            'post_title'  => $name,
            'post_content' => $message,
            'post_status' => 'publish',
        ));

        if (!is_wp_error($post_id)) {
            update_post_meta($post_id, '_contact_email', $email);
            update_post_meta($post_id, '_contact_message', $message);
            update_post_meta($post_id, '_contact_subscribe', $subscribe);


            send_custom_email_response($email, $subscribe);

            wp_send_json_success('Formulario enviado correctamente');
        } else {
            wp_send_json_error('Error al enviar el formulario');
        }
    } else {
        wp_send_json_error('Campos faltantes o inválidos');
    }
    wp_die();
}

add_action('wp_ajax_nopriv_handle_contact_form', 'handle_contact_form');
add_action('wp_ajax_handle_contact_form', 'handle_contact_form');

// Client Form
function handle_cliente_form()
{
    // Verificar que todos los campos necesarios están presentes
    if (isset($_POST['cliente_nombre'], $_POST['cliente_rut'], $_POST['cliente_email'], $_POST['cliente_telefono'], $_POST['nombre_emprendimiento'], $_POST['dominio_deseado'], $_POST['direccion'])) {

        // Sanitizar datos del formulario
        $nombre = sanitize_text_field($_POST['cliente_nombre']);
        $rut = sanitize_text_field($_POST['cliente_rut']);
        $email = sanitize_email($_POST['cliente_email']);
        $telefono = sanitize_text_field($_POST['cliente_telefono']);
        $nombre_emprendimiento = sanitize_text_field($_POST['nombre_emprendimiento']);
        $dominio_deseado = sanitize_text_field($_POST['dominio_deseado']);

        // Manejar la dirección como un array asociativo y sanitizar cada campo
        $direccion = array(
            'region'    => sanitize_text_field($_POST['direccion']['region']),
            'provincia' => sanitize_text_field($_POST['direccion']['provincia']),
            'comuna'    => sanitize_text_field($_POST['direccion']['comuna']),
            'calle'     => sanitize_text_field($_POST['direccion']['calle']),
        );

        // Opcional: RUT de la empresa si el cliente tiene empresa constituida
        $tiene_empresa = isset($_POST['tiene_empresa']) ? 'on' : 'off';
        $rut_empresa = $tiene_empresa === 'on' && isset($_POST['rut_empresa']) ? sanitize_text_field($_POST['rut_empresa']) : '';

        // Crear un nuevo cliente en el CPT
        $post_id = wp_insert_post(array(
            'post_type'   => 'cliente',
            'post_title'  => $nombre,
            'post_status' => 'publish',
        ));

        // Verificar si el post fue creado correctamente
        if (! is_wp_error($post_id)) {
            // Guardar los datos del cliente en metadatos
            update_post_meta($post_id, '_cliente_rut', $rut);
            update_post_meta($post_id, '_cliente_email', $email);
            update_post_meta($post_id, '_cliente_telefono', $telefono);
            update_post_meta($post_id, '_nombre_emprendimiento', $nombre_emprendimiento);
            update_post_meta($post_id, '_tiene_empresa', $tiene_empresa);
            update_post_meta($post_id, '_rut_empresa', $rut_empresa);
            update_post_meta($post_id, '_dominio_deseado', $dominio_deseado);
            update_post_meta($post_id, '_direccion', maybe_serialize($direccion)); // Serializar el array de dirección

            // Enviar correo de bienvenida
            send_custom_email_response_cl($email, $nombre);

            // Respuesta de éxito en JSON
            wp_send_json_success('¡Bienvenido a Espacios Virtuales! Nos alegra tenerte con nosotros, ' . $nombre . '. Hemos registrado tus datos exitosamente.');
        } else {
            // Respuesta de error si la creación del post falla
            wp_send_json_error('Error al registrar el cliente');
        }
    } else {
        // Respuesta de error si faltan campos
        wp_send_json_error('Campos faltantes o inválidos');
    }
    wp_die();
}
add_action('wp_ajax_nopriv_handle_cliente_form', 'handle_cliente_form');
add_action('wp_ajax_handle_cliente_form', 'handle_cliente_form');
