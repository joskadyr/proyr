<?php include __DIR__."/includes/header.php"; ?>
<h4>Pagos</h4>
<table class="table table-bordered">
  <thead><tr><th>#</th><th>Alumno</th><th>Curso</th><th>Monto</th><th>Estado</th><th>Fecha</th></tr></thead>
  <tbody>
<?php
$res=$conn->query("SELECT p.id, u.nombre alumno, c.titulo curso, p.monto, p.estado, p.fecha FROM pagos p
JOIN usuarios u ON u.id=p.id_usuario JOIN cursos c ON c.id=p.id_curso ORDER BY p.id DESC");
while($r=$res->fetch_assoc()){
  echo "<tr><td>{$r['id']}</td><td>".htmlspecialchars($r['alumno'])."</td><td>".htmlspecialchars($r['curso'])."</td><td>{$r['monto']}</td><td>{$r['estado']}</td><td>{$r['fecha']}</td></tr>";
}
?>
  </tbody>
</table>
<?php include __DIR__."/includes/footer.php"; ?>
