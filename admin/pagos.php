<?php include __DIR__."/includes/header.php"; ?>
<h4>Pagos</h4>

<?php if(isset($_GET['msg'])): ?>
  <div class="alert alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
<?php endif; ?>

<table class="table table-bordered align-middle">
  <thead><tr><th>#</th><th>Alumno</th><th>Curso</th><th>Monto</th><th>Estado</th><th>Fecha</th><th>Acciones</th></tr></thead>
  <tbody>
<?php
$res=$conn->query("SELECT p.id, u.nombre alumno, c.titulo curso, p.monto, p.estado, p.fecha FROM pagos p
JOIN usuarios u ON u.id=p.id_usuario JOIN cursos c ON c.id=p.id_curso ORDER BY p.id DESC");
  while($r=$res->fetch_assoc()){
    $id=(int)$r['id'];
    $monto = htmlspecialchars($r['monto']);
    $estado = htmlspecialchars($r['estado']);
    $fecha = htmlspecialchars($r['fecha']);
    echo "<tr><td>{$id}</td><td>".htmlspecialchars($r['alumno'])."</td><td>".htmlspecialchars($r['curso'])."</td><td>{$monto}</td><td>{$estado}</td><td>{$fecha}</td>";
  echo "<td class='d-flex gap-2'>";
  echo "<a class='btn btn-sm btn-primary' href='pago_editar.php?id={$id}'>Editar</a>";
  echo "<a class='btn btn-sm btn-outline-info' href='pago_qr.php?id={$id}'>QR de pago</a>";
  echo "</td></tr>";
}
?>
  </tbody>
</table>
<?php include __DIR__."/includes/footer.php"; ?>
