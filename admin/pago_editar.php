<?php
include __DIR__."/includes/header.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: pagos.php");
    exit;
}

$stmt = $conn->prepare("SELECT p.*, u.nombre alumno, c.titulo curso FROM pagos p JOIN usuarios u ON u.id=p.id_usuario JOIN cursos c ON c.id=p.id_curso WHERE p.id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$pago = $stmt->get_result()->fetch_assoc();

if (!$pago) {
    echo "<div class='alert alert-danger'>Pago no encontrado.</div>";
    include __DIR__ . "/includes/footer.php";
    exit;
}

$estadosPermitidos = ['pendiente', 'pagado', 'anulado'];
$mensajeError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $monto = isset($_POST['monto']) ? floatval($_POST['monto']) : $pago['monto'];
    $estado = isset($_POST['estado']) ? trim($_POST['estado']) : $pago['estado'];
    $fecha = isset($_POST['fecha']) ? trim($_POST['fecha']) : $pago['fecha'];

    if (!in_array($estado, $estadosPermitidos, true)) {
        $mensajeError = 'Estado no permitido.';
    } elseif ($monto <= 0) {
        $mensajeError = 'El monto debe ser mayor a 0.';
    } elseif (!$fecha) {
        $mensajeError = 'La fecha es obligatoria.';
    } elseif (!DateTime::createFromFormat('Y-m-d', $fecha)) {
        $mensajeError = 'La fecha no tiene un formato válido (AAAA-MM-DD).';
    } else {
        $update = $conn->prepare("UPDATE pagos SET monto = ?, estado = ?, fecha = ? WHERE id = ?");
        $update->bind_param('dssi', $monto, $estado, $fecha, $id);
        $update->execute();
        header("Location: pagos.php?msg=Pago+actualizado+correctamente");
        exit;
    }

    // Mostrar valores ingresados si hubo validación fallida
    $pago['monto'] = $monto;
    $pago['estado'] = $estado;
    $pago['fecha'] = $fecha;
}
?>

<h4>Editar pago #<?php echo $id; ?></h4>
<div class="card shadow-sm">
  <div class="card-body">
    <p class="mb-1"><strong>Alumno:</strong> <?php echo htmlspecialchars($pago['alumno']); ?></p>
    <p class="mb-3"><strong>Curso:</strong> <?php echo htmlspecialchars($pago['curso']); ?></p>

    <?php if($mensajeError): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($mensajeError); ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
        <label class="form-label">Monto</label>
        <input type="number" step="0.01" min="0" name="monto" value="<?php echo htmlspecialchars($pago['monto']); ?>" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select" required>
          <?php foreach ($estadosPermitidos as $estadoOpt): ?>
            <option value="<?php echo $estadoOpt; ?>" <?php echo $pago['estado']===$estadoOpt ? 'selected' : ''; ?>><?php echo ucfirst($estadoOpt); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Fecha</label>
        <input type="date" name="fecha" value="<?php echo htmlspecialchars(substr($pago['fecha'],0,10)); ?>" class="form-control" required>
      </div>
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a class="btn btn-outline-secondary" href="pagos.php">Volver</a>
      </div>
    </form>
  </div>
</div>

<?php include __DIR__."/includes/footer.php"; ?>
