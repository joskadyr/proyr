<?php include __DIR__."/includes/header.php"; ?>
<h4>Mis certificados</h4>
<p class="text-muted">Si la librería FPDF no está instalada en /proyecto2/fpdf, verás un aviso.</p>
<table class="table table-hover">
  <thead><tr><th>#</th><th>Curso</th><th>Fecha</th><th>Acción</th></tr></thead>
  <tbody>
<?php
$id=(int)$_SESSION['id_usuario'];
$res=$conn->query("SELECT c.id cid, c.titulo, IFNULL((SELECT fecha FROM certificados WHERE id_usuario=$id AND id_curso=c.id ORDER BY id DESC LIMIT 1), NULL) f
FROM cursos c JOIN inscripciones i ON i.id_curso=c.id WHERE i.id_usuario=$id ORDER BY c.id");
while($r=$res->fetch_assoc()){
  $f = $r['f'] ? $r['f'] : "—";
  echo "<tr><td>{$r['cid']}</td><td>".htmlspecialchars($r['titulo'])."</td><td>{$f}</td>
        <td><a class='btn btn-sm btn-primary' href='../generar_certificado.php?curso={$r['cid']}' target='_blank'>Descargar PDF</a></td></tr>";
}
?>
  </tbody>
</table>
<?php include __DIR__."/includes/footer.php"; ?>
