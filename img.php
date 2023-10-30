<?php
// Get the base64-encoded image data
$imagePath = 'images/logo1.png'; // Replace with the path to your image file

$imageData = base64_encode(file_get_contents($imagePath));
$imageSrc = 'data:image/png;base64,' . $imageData;

// Save the base64-encoded image data to a file on the server
$imageFilename = 'downloaded_image.png'; // Specify the filename to save the image as
file_put_contents($imageFilename, base64_decode($imageData));

$html = '<body>
    <h2>image a telecharger</h2>

    <div>
        <img src="' . $imageFilename . '">
        <!-- Rest of your HTML code -->
    </div>

</body>';

// Generate and output the PDF
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("image.pdf");
?>
