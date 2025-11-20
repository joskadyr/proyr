<?php include __DIR__."/includes/header.php"; ?>
<h4>Usuarios</h4>
<table class="table table-striped">
  <thead><tr><th>#</th><th>Usuario</th><th>Nombre</th><th>Rol</th></tr></thead>
  <tbody>
  <?php $res=$conn->query("SELECT id,usuario,nombre,rol FROM usuarios ORDER BY id");
  while($r=$res->fetch_assoc()): ?>
    <tr><td><?= $r['id']?></td><td><?= htmlspecialchars($r['usuario'])?></td><td><?= htmlspecialchars($r['nombre'])?></td><td><?= $r['rol']?></td></tr>
  <?php endwhile; ?>
  </tbody>
</table>
<?php include __DIR__."/includes/footer.php"; ?>
