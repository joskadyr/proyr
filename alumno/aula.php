<?php
include __DIR__ . "/includes/header.php";

$curso = isset($_GET['curso']) ? (int)$_GET['curso'] : 0;

// Obtener título del curso
$tituloCurso = "Curso #" . $curso;
if ($curso > 0) {
    $stmt = $conn->prepare("SELECT titulo FROM cursos WHERE id = ?");
    $stmt->bind_param("i", $curso);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        $tituloCurso = $row['titulo'];
    }
}
?>

<h4 class="mb-3">Aula del curso: <?php echo htmlspecialchars($tituloCurso); ?></h4>

<h5>Unidades</h5>
<ul class="list-group mb-4">
<?php
if ($curso > 0) {
    $res = $conn->query("SELECT id, titulo FROM unidades WHERE id_curso = $curso ORDER BY id");
    if ($res->num_rows > 0) {
        while ($r = $res->fetch_assoc()) {
            echo "<li class='list-group-item'>" . htmlspecialchars($r['titulo']) . "</li>";
        }
    } else {
        echo "<li class='list-group-item text-muted'>No hay unidades registradas.</li>";
    }
} else {
    echo "<li class='list-group-item text-muted'>Curso no válido.</li>";
}
?>
</ul>

<h5>Materiales</h5>
<ul class="list-group">
<?php
if ($curso > 0) {
    $res = $conn->query("SELECT id, titulo, archivo FROM materiales WHERE id_curso = $curso ORDER BY id DESC");
    if ($res->num_rows > 0) {
        while ($r = $res->fetch_assoc()) {
            $titulo  = htmlspecialchars($r['titulo']);
            $archivo = "../uploads/" . urlencode($r['archivo']); // ruta relativa
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
            echo "<span>$titulo</span>";
            echo "<a class='btn btn-sm btn-outline-secondary' href='$archivo' target='_blank'>Descargar</a>";
            echo "</li>";
        }
    } else {
        echo "<li class='list-group-item text-muted'>No hay materiales subidos.</li>";
    }
} else {
    echo "<li class='list-group-item text-muted'>Curso no válido.</li>";
}
?>
</ul>

<?php include __DIR__ . "/includes/footer.php"; ?>
