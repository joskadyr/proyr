<?php
include __DIR__."/includes/header.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: pagos.php");
    exit;
}

$stmt = $conn->prepare("SELECT p.*, u.nombre alumno, u.email, c.titulo curso FROM pagos p JOIN usuarios u ON u.id=p.id_usuario JOIN cursos c ON c.id=p.id_curso WHERE p.id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$pago = $stmt->get_result()->fetch_assoc();

if (!$pago) {
    echo "<div class='alert alert-danger'>Pago no encontrado.</div>";
    include __DIR__ . "/includes/footer.php";
    exit;
}

$qrData = sprintf(
    'Pago #%d | Alumno: %s | Curso: %s | Monto: %s | Estado: %s | Contacto: %s',
    $pago['id'],
    $pago['alumno'],
    $pago['curso'],
    $pago['monto'],
    $pago['estado'],
    $pago['email']
);
$qrUrl = 'https://chart.googleapis.com/chart?chs=320x320&cht=qr&chl=' . urlencode($qrData) . '&choe=UTF-8';
?>

<h4>QR de pago #<?php echo $id; ?></h4>
<div class="card shadow-sm">
  <div class="card-body text-center">
    <p class="mb-1"><strong>Alumno:</strong> <?php echo htmlspecialchars($pago['alumno']); ?></p>
    <p class="mb-1"><strong>Curso:</strong> <?php echo htmlspecialchars($pago['curso']); ?></p>
    <p class="mb-3"><strong>Monto:</strong> <?php echo htmlspecialchars($pago['monto']); ?> (<?php echo htmlspecialchars($pago['estado']); ?>)</p>
    <img src="<?php echo $qrUrl; ?>" alt="QR de pago" class="img-fluid mb-3" style="max-width:320px;">
    <div class="d-flex justify-content-center gap-2">
      <a class="btn btn-outline-primary" href="<?php echo $qrUrl; ?>" target="_blank" rel="noreferrer">Abrir en nueva pestaña</a>
      <a class="btn btn-secondary" href="pagos.php">Volver a la lista</a>
    </div>
  </div>
</div>

<?php include __DIR__."/includes/footer.php"; ?>
