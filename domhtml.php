<?php 
$a =15;
$html = "<h1>hi i'm your file, download me if you can </h1><h2>".$a."</h2>";
?>

<?php

require_once 'dompdf\autoload.inc.php';

use Dompdf\Dompdf;
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="Attestation.pdf"');
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("myFile.pdf");

?>