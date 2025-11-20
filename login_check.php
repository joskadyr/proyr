<?php
require_once __DIR__ . "/config.php";

$u = $_POST['usuario'] ?? '';
$p = $_POST['clave'] ?? '';

$stmt = $conn->prepare("SELECT id, usuario, clave, rol, nombre FROM usuarios WHERE usuario=? LIMIT 1");
$stmt->bind_param("s", $u);
$stmt->execute();
$res = $stmt->get_result();

if ($row = $res->fetch_assoc()) {
    // Para práctica: contraseña en plano
    if ($row['clave'] === $p) {
        $_SESSION['id_usuario'] = $row['id'];
        $_SESSION['usuario']    = $row['usuario'];
        $_SESSION['nombre']     = $row['nombre'];
        $_SESSION['rol']        = $row['rol'];

        if ($row['rol'] === 'admin') {
            header("Location: admin/index.php");   // relativo a login.php
        } else {
            header("Location: alumno/index.php");
        }
        exit;
    }
}

$_SESSION['error'] = "Usuario o contraseña incorrecta";
header("Location: login.php");
exit;
?>
