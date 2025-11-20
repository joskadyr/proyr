<?php include __DIR__."/includes/header.php"; ?>
<div class="d-flex justify-content-between align-items-center mb-2">
  <h4>Cursos</h4>
  <form class="d-flex" method="post">
    <input class="form-control me-2" name="titulo" placeholder="Nuevo curso..." required>
    <button class="btn btn-primary">Agregar</button>
  </form>
</div>
<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
  $stmt=$conn->prepare("INSERT INTO cursos(titulo, descripcion) VALUES (?, '')");
  $stmt->bind_param("s", $_POST['titulo']);
  $stmt->execute();
  echo '<div class="alert alert-success">Curso agregado.</div>';
}
$res=$conn->query("SELECT * FROM cursos ORDER BY id");
?>
<table class="table table-striped">
  <thead><tr><th>#</th><th>Título</th><th>Acciones</th></tr></thead>
  <tbody>
    <?php while($r=$res->fetch_assoc()): ?>
      <tr>
        <td><?= $r['id'] ?></td>
        <td><?= htmlspecialchars($r['titulo']) ?></td>
        <td><a class="btn btn-sm btn-outline-secondary" href="unidades.php?curso=<?= $r['id'] ?>">Unidades</a></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
<?php include __DIR__."/includes/footer.php"; ?>
