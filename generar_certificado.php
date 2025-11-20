<?php
require_once __DIR__."/config.php";
$curso = (int)($_GET['curso'] ?? 0);
$idUsu = (int)$_SESSION['id_usuario'];

// Verificar inscripción
$chk = $conn->prepare("SELECT c.titulo FROM inscripciones i JOIN cursos c ON c.id=i.id_curso WHERE i.id_usuario=? AND i.id_curso=?");
$chk->bind_param("ii",$idUsu,$curso);
$chk->execute();
$res = $chk->get_result();
if(!$row=$res->fetch_assoc()){ die("No estás inscrito en este curso."); }
$cursoTitulo = $row['titulo'];

// Verificar FPDF
$fpdfPath = __DIR__."/fpdf/fpdf.php";
if(!file_exists($fpdfPath)){
    header("Content-Type: text/plain; charset=utf-8");
    echo "Falta la librería FPDF en <?php echo url('/fpdf'); ?>. Descárgala de http://www.fpdf.org/ (archivo fpdf.php) y colócala en esa carpeta. Luego vuelve a intentar.";
    exit;
}
require_once $fpdfPath;

// Generar PDF sencillo
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',28);
$pdf->Cell(0,20,iconv('UTF-8','windows-1252','CERTIFICADO'),0,1,'C');
$pdf->SetFont('Arial','',14);
$pdf->Ln(10);
$nombre = $_SESSION['nombre'];
$linea = "Se certifica que $nombre culminó el curso: $cursoTitulo";
$pdf->MultiCell(0,10,iconv('UTF-8','windows-1252',$linea),0,'C');
$pdf->Ln(10);
$pdf->Cell(0,10,iconv('UTF-8','windows-1252','AulaAndina2 • Proyecto2'),0,1,'C');
// Guardar copia en uploads y registrar
$dir = __DIR__."/uploads/";
if(!is_dir($dir)) mkdir($dir,0777,true);
$fname = "cert_".$idUsu."_".$curso."_".time().".pdf";

// Guardar archivo en disco primero
$pdf->Output('F', $dir.$fname);

// Guardar registro en BD
$stmt=$conn->prepare("INSERT INTO certificados(id_usuario,id_curso,fecha,archivo) VALUES (?,?,NOW(),?)");
$stmt->bind_param("iis",$idUsu,$curso,$fname);
$stmt->execute();

// Mostrar en navegador después
$pdf->Output('I', 'certificado.pdf');
?>
