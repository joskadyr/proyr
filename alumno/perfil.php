<?php include __DIR__."/includes/header.php"; ?>
<h4>Perfil</h4>
<ul class="list-group">
  <li class="list-group-item"><strong>Usuario:</strong> <?php echo htmlspecialchars($_SESSION['usuario']); ?></li>
  <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['nombre']); ?></li>
  <li class="list-group-item"><strong>Rol:</strong> <?php echo htmlspecialchars($_SESSION['rol']); ?></li>
</ul>
<?php include __DIR__."/includes/footer.php"; ?>
