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
        <a href="showdata.php" id="img4" class="btn btn-success btn-md text-center p-3 m-3">Retour<----</a>

        <?php include "connect_pdo.php"; ?><hr>
<?php    // Sélectionner les données de la table
            $requete = "SELECT * FROM patient";
            $result = $dbh->query($requete);
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["patientID"];
            $name = $row["nom"];
            $gender = $row["sexe"];
            $number = $row["numero"];
}?>
        <a href="pdf.php" class="btn btn-sm btn-success">Download PDF</a><br>
        <br>
            <h2>Attestation de réservation de consultation</h2>

            <form method="post">
            
                <div>
                <img src="images/logo1.png"  alt="logo clinique"  width="150" height="150">
                <img src="images/logocmc.png" id="img2" alt="logo cmc"  width="150" height="150">
                </div>
            <table class="table text-center table-bordered border-secondary" id="mytab">
                <tr>
                    <th class="bg-danger">ID patient</th>
                    <td><?php echo $id; ?></td>

                </tr>   
                <tr>
                    <th class="bg-warning">Nom :</th>
                    <td><?php echo $name; ?></td>
                    </td>
                </tr>
                <tr>
                    <th class="bg-warning">Sexe:</th>
                    
                    <td><?php  echo $gender;?></td>
                </tr>
                <tr>
                    <th class="bg-warning">Tel :</th>
                    <td><?php  echo $number ;?></td>
                </tr>
                <tr>
                    <th class="bg-warning">Nombre de consultations :</th>
                    <td> <?php   $q = "SELECT count(specialiteID) as maladies
                            FROM consultation
                            where patientID = $id;";
                            $sta = $dbh->prepare($q);
                            $sta->execute();
                            if ($result = $sta->fetch(PDO::FETCH_ASSOC)){
                                echo $result['maladies'];

                            }
                          ?></td>
                </tr>

                <tr>
                    <th class="bg-warning">Prix total :</th>
                    <td><?php echo $result['maladies'] * 300;?>DH</td>
                </tr>
            </table>
            <div>
            <p><h5>Date Edition :
                <?php $date = date("d-m-Y");
                echo $date; ?>
            </h5></p>
            <img src="images/qrcode.png" alt="QR code"  width="150" height="150">
               <div  id="img4">Visa du clinique<br><img src="images/cachet.png" 
                alt="visa clinique"  width="150" height="150"></div> 
            </div>
            </form>
        </body>
</html>