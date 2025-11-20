<?php
require_once __DIR__ . "/../../config.php";
require_login();
if (!is_admin()) {
    header("Location: ../alumno/index.php");
    exit;
}
?>
<!doctype html>
<html lang="es" data-bs-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin • Proyecto2</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/style.css" rel="stylesheet"> <!-- relativo a admin/index.php -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-primary" href="index.php">Proyecto2 Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navContent">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="cursos.php">Cursos</a></li>
        <li class="nav-item"><a class="nav-link" href="unidades.php?curso=1">Unidades</a></li>
        <li class="nav-item"><a class="nav-link" href="usuarios.php">Usuarios</a></li>
        <li class="nav-item"><a class="nav-link" href="materiales.php">Materiales</a></li>
        <li class="nav-item"><a class="nav-link" href="evaluaciones.php">Evaluaciones</a></li>
        <li class="nav-item"><a class="nav-link" href="pagos.php">Pagos</a></li>
        <li class="nav-item"><a class="nav-link" href="certificados.php">Certificados</a></li>
      </ul>
      <span class="navbar-text text-light me-3"><?php echo $_SESSION['nombre']; ?></span>
      <a class="btn btn-outline-primary btn-sm" href="../logout.php">Salir</a>
    </div>
  </div>
</nav>
<div class="container py-4">
