<?php
include "connect_pdo.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Select patient data
$requete = "SELECT * FROM patient";
$result = $dbh->query($requete);
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $id = $row["patientID"];
    $name = $row["nom"];
    $gender = $row["sexe"];
    $number = $row["numero"];
}

// Count consultations
$q = "SELECT count(specialiteID) as maladies
    FROM consultation
    where patientID = $id;";
$sta = $dbh->prepare($q);
$sta->execute();
if ($result = $sta->fetch(PDO::FETCH_ASSOC)) {
    $maladies = $result['maladies'];
}

// Get the base64-encoded image data for each image
$imagePaths = [
    'images/logocmc.png',
    'images.logo1.png',
    'images/qrcode.png',
    'images/cachet.png',
];

$imageSrcs = [];
$imageFilenames = [];

foreach ($imagePaths as $imagePath) {
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageSrc = 'data:image/png;base64,' . $imageData;

    // Save the base64-encoded image data to a file on the server
    $imageFilename = 'downloaded_image_' . uniqid() . '.png'; // Generate a unique filename for each image
    file_put_contents($imageFilename, base64_decode($imageData));

    $imageSrcs[] = $imageFilename;
    $imageFilenames[] = $imageFilename;
}


// Generate HTML for the PDF
$html = '
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Attestation de réservation</title>
        <meta name="generator" content="Bootply"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/css.css">
    </head>
    <body>
        <br>
        <h2>Attestation de réservation de consultation</h2>

        <div>
        <img src="' . $imageSrcs[0] . '">
        <img src="' . $imageSrcs[1] . '">
            
        </div>
        <table class="table text-center table-bordered border-primary" id="mytab">
            <tr>
                <th class="bg-warning">ID patient</th>
                <td>' . $id . '</td>
            </tr>
            <tr>
                <th class="bg-warning">Nom :</th>
                <td>' . $name . '</td>
                </td>
            </tr>
            <tr>
                <th class="bg-warning">Sexe:</th>
                <td>' . $gender . '</td>
            </tr>
            <tr>
                <th class="bg-warning">Tel :</th>
                <td>' . $number . '</td>
            </tr>
            <tr>
                <th class="bg-warning">Nombre de consultations :</th>
                <td>' . $maladies . '</td>
            </tr>
            <tr>
                <th class="bg-warning">Prix total :</th>
                <td>' . $maladies * 300 . 'DH</td>
            </tr>
        </table>
        <div>
            <p>
                <h5>Date Edition :</h5>
                ' . date("d-m-Y") . '
            </p>
            <img src="' . $imageSrcs[2] . '">
            <div id="img4">Visa du clinique<br>
            <img src="' . $imageSrcs[3] . '">
            </div>
        </div>
    </body>
</html>';

// Generate and download the PDF
require_once 'dompdf\autoload.inc.php';
use Dompdf\Dompdf;
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="Attestation.pdf"');

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("Attestation.pdf", array("Attachment" => true));

// Delete the downloaded image files after generating the PDF
foreach ($imageFilenames as $filename) {
    unlink($filename);
}
?>
