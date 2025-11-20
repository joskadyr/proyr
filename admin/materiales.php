<?php include __DIR__."/includes/header.php"; ?>
<h4>Materiales</h4>
<form class="row g-2 mb-3" method="post" enctype="multipart/form-data">
  <div class="col-md-3"><input class="form-control" name="titulo" placeholder="Título" required></div>
  <div class="col-md-3">
    <select class="form-select" name="curso" required>
      <option value="">Curso...</option>
      <?php $c=$conn->query("SELECT id,titulo FROM cursos");
      while($r=$c->fetch_assoc()){ echo "<option value='{$r['id']}'>".htmlspecialchars($r['titulo'])."</option>"; } ?>
    </select>
  </div>
  <div class="col-md-4"><input class="form-control" type="file" name="archivo" required></div>
  <div class="col-md-2"><button class="btn btn-primary w-100">Subir</button></div>
</form>
<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
  $dir = __DIR__."/../uploads/";
  if(!is_dir($dir)) mkdir($dir,0777,true);
  $nombre = time()."_".basename($_FILES['archivo']['name']);
  $dest = $dir.$nombre;
  if(move_uploaded_file($_FILES['archivo']['tmp_name'],$dest)){
     $stmt=$conn->prepare("INSERT INTO materiales(id_curso,titulo,archivo) VALUES (?,?,?)");
     $stmt->bind_param("iss", $_POST['curso'], $_POST['titulo'], $nombre);
     $stmt->execute();
     echo '<div class="alert alert-success">Material subido.</div>';
  } else {
     echo '<div class="alert alert-danger">Error al subir.</div>';
  }
}
$res=$conn->query("SELECT m.id, c.titulo curso, m.titulo, m.archivo FROM materiales m JOIN cursos c ON c.id=m.id_curso ORDER BY m.id DESC");
?>
<table class="table table-hover"><thead><tr><th>#</th><th>Curso</th><th>Título</th><th>Archivo</th></tr></thead><tbody>
<?php while($r=$res->fetch_assoc()): ?>
<tr><td><?= $r['id']?></td><td><?= htmlspecialchars($r['curso'])?></td><td><?= htmlspecialchars($r['titulo'])?></td>
<td><a href="<?php echo url('/uploads/').urlencode($r['archivo']); ?><?= urlencode($r['archivo'])?>" target="_blank">Descargar</a></td></tr>
<?php endwhile; ?>
</tbody></table>
<?php include __DIR__."/includes/footer.php"; ?>
