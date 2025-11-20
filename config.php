<?php
// ===== CONFIGURACIÓN BASE DE DATOS =====
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "aulaandina2";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ===== FUNCIONES DE SESIÓN =====
function is_admin()   { return isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'; }
function is_alumno()  { return isset($_SESSION['rol']) && $_SESSION['rol'] === 'alumno'; }

function require_login() {
    // Esta ruta es relativa al script que se está ejecutando (admin/* o alumno/*)
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: ../login.php"); // tanto desde /admin como /alumno sube a /proyecto2/login.php
        exit;
    }
}
?>
