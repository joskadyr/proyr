<?php include __DIR__."/includes/header.php"; ?>
<h4>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></h4>
<p class="text-muted">Aquí verás tus cursos inscritos y novedades.</p>
<div class="row g-3">
<?php
$id = (int)$_SESSION['id_usuario'];
$res = $conn->query("SELECT c.id, c.titulo FROM inscripciones i JOIN cursos c ON c.id=i.id_curso WHERE i.id_usuario=$id");
while($r=$res->fetch_assoc()): ?>
  <div class="col-md-4">
    <div class="card h-100 shadow-sm"><div class="card-body d-flex flex-column">
      <h5 class="card-title"><?= htmlspecialchars($r['titulo']) ?></h5>
      <a class="mt-auto btn btn-outline-primary" href="aula.php?curso=<?= $r['id'] ?>">Entrar</a>
    </div></div>
  </div>
<?php endwhile; ?>
</div>
<?php include __DIR__."/includes/footer.php"; ?>
