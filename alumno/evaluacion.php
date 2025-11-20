<?php include __DIR__."/includes/header.php"; ?>
<h4>Evaluaciones asignadas</h4>
<table class="table table-striped">
  <thead><tr><th>#</th><th>Curso</th><th>Título</th><th>Puntaje Máximo</th></tr></thead>
  <tbody>
<?php
$id=(int)$_SESSION['id_usuario'];
$res=$conn->query("SELECT e.id, c.titulo curso, e.titulo, e.puntaje_max FROM evaluaciones e
JOIN cursos c ON c.id=e.id_curso
JOIN inscripciones i ON i.id_curso=e.id_curso AND i.id_usuario=$id
ORDER BY e.id");
while($r=$res->fetch_assoc()){
  echo "<tr><td>{$r['id']}</td><td>".htmlspecialchars($r['curso'])."</td><td>".htmlspecialchars($r['titulo'])."</td><td>{$r['puntaje_max']}</td></tr>";
}
?>
  </tbody>
</table>
<?php include __DIR__."/includes/footer.php"; ?>
