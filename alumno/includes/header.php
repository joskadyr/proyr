<?php
require_once __DIR__ . "/../../config.php";
require_login();
if (!is_alumno() && !is_admin()) {
    header("Location: ../login.php");
    exit;
}
?>
<!doctype html>
<html lang="es" data-bs-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Alumno • Proyecto2</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>.hero{background:linear-gradient(135deg,#0d6efd22,#6c757d33);}</style>
</head>
<body class="bg-slate">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">AulaAndina2</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navContent">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="aula.php">Aula</a></li>
        <li class="nav-item"><a class="nav-link" href="evaluacion.php">Evaluación</a></li>
        <li class="nav-item"><a class="nav-link" href="certificados.php">Mis certificados</a></li>
        <li class="nav-item"><a class="nav-link" href="chatbot.php">Chatbot</a></li>
        <li class="nav-item"><a class="nav-link" href="perfil.php">Perfil</a></li>
      </ul>
      <span class="navbar-text text-light me-3"><?php echo htmlspecialchars($_SESSION['nombre'] ?? ''); ?></span>
      <a class="btn btn-outline-light btn-sm" href="../logout.php">Salir</a>
    </div>
  </div>
</nav>
<div class="container py-4">
