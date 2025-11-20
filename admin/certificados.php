<?php include __DIR__."/includes/header.php"; ?>
<h4>Certificados emitidos</h4>

<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Alumno</th>
      <th>Curso</th>
      <th>Fecha</th>
      <th>Archivo</th>
    </tr>
  </thead>
  <tbody>
<?php
// Listar certificados emitidos
$sql = "
SELECT ce.id,
       u.nombre AS alumno,
       c.titulo AS curso,
       ce.fecha,
       ce.archivo
FROM certificados ce
JOIN usuarios u ON u.id = ce.id_usuario
JOIN cursos    c ON c.id = ce.id_curso
ORDER BY ce.id DESC
";
$res = $conn->query($sql);

while ($r = $res->fetch_assoc()) {

    if (!empty($r['archivo'])) {
        // enlace al PDF guardado en /proyecto2/uploads/
        $href   = "../uploads/" . htmlspecialchars($r['archivo']);
        $enlace = "<a href=\"{$href}\" target=\"_blank\">Descargar</a>";
    } else {
        $enlace = "—";
    }

    echo "<tr>";
    echo "<td>{$r['id']}</td>";
    echo "<td>" . htmlspecialchars($r['alumno']) . "</td>";
    echo "<td>" . htmlspecialchars($r['curso']) . "</td>";
    echo "<td>{$r['fecha']}</td>";
    echo "<td>{$enlace}</td>";
    echo "</tr>";
}
?>
  </tbody>
</table>

<?php include __DIR__."/includes/footer.php"; ?>
