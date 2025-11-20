# proyr

Aplicación web académica con gestión de cursos, alumnos y pagos.

## Funciones clave
- **Pagos**: el administrador puede listar, editar y actualizar el estado y fecha de pagos desde `admin/pagos.php`, y generar un QR de cobro por cada registro en `admin/pago_qr.php`. 
- **Edición validada**: los cambios de monto, estado y fecha se validan en `admin/pago_editar.php` antes de guardarse en base de datos.
- **Asistente virtual**: los alumnos cuentan con un chatbot básico en `alumno/chatbot.php`, accesible desde el menú principal, con respuestas predefinidas sobre pagos, cursos y certificados.

## Requisitos
- PHP 8+ y servidor web (ej. Apache en XAMPP).
- Extensión mysqli habilitada y base de datos configurada en `config.php`.
