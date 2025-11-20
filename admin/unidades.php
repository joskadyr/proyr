<?php include __DIR__."/includes/header.php"; $curso=(int)($_GET['curso']??0); ?>
<h4>Unidades del curso #<?= $curso ?></h4>
<form class="row g-2 mb-3" method="post">
  <div class="col-md-5"><input class="form-control" name="titulo" placeholder="Título de la unidad" required></div>
  <div class="col-md-5"><input class="form-control" name="contenido" placeholder="Contenido resumido"></div>
  <div class="col-md-2"><button class="btn btn-primary w-100">Agregar</button></div>
</form>
<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
  $stmt=$conn->prepare("INSERT INTO unidades(id_curso, titulo, contenido) VALUES (?,?,?)");
  $stmt->bind_param("iss",$curso,$_POST['titulo'],$_POST['contenido']);
  $stmt->execute();
  echo '<div class="alert alert-success">Unidad agregada.</div>';
}
$res=$conn->query("SELECT * FROM unidades WHERE id_curso=$curso ORDER BY id");
?>
<table class="table table-hover"><thead><tr><th>#</th><th>Título</th><th>Contenido</th></tr></thead><tbody>
<?php while($r=$res->fetch_assoc()): ?>
<tr><td><?= $r['id']?></td><td><?= htmlspecialchars($r['titulo'])?></td><td><?= htmlspecialchars($r['contenido'])?></td></tr>
<?php endwhile; ?>
</tbody></table>
<?php include __DIR__."/includes/footer.php"; ?>
