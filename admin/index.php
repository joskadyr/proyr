<?php include __DIR__."/includes/header.php"; ?>
<h3 class="mb-3">Dashboard</h3>
<div class="row g-3">
  <div class="col-md-4">
    <div class="card shadow-sm"><div class="card-body">
      <h6 class="text-muted">Total cursos</h6>
      <h2>
        <?php echo $conn->query("SELECT COUNT(*) c FROM cursos")->fetch_assoc()['c']; ?>
      </h2>
    </div></div>
  </div>
  <div class="col-md-8">
    <div class="card shadow-sm"><div class="card-body">
      <h6 class="mb-3">Inscripciones por curso</h6>
      <canvas id="chart1"></canvas>
<?php
$labels = [];
$data = [];
$res = $conn->query("SELECT c.titulo, COUNT(i.id) total FROM cursos c LEFT JOIN inscripciones i ON i.id_curso=c.id GROUP BY c.id ORDER BY c.id");
while($r=$res->fetch_assoc()){ $labels[]=$r['titulo']; $data[]=(int)$r['total']; }
?>
<script>
const ctx=document.getElementById('chart1');
new Chart(ctx,{
  type:'bar',
  data:{ labels: <?php echo json_encode($labels, JSON_UNESCAPED_UNICODE); ?>,
         datasets:[{ label:'Inscritos', data: <?php echo json_encode($data); ?> }]},
  options:{ responsive:true, plugins:{ legend:{display:false} } }
});
</script>
    </div></div>
  </div>
</div>
<?php include __DIR__."/includes/footer.php"; ?>
