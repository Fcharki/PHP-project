
<?php include "connect_pdo.php"; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title> Reporting page</title>
		<meta name="generator" content="Bootply"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/css.css">
    </head>
    <a href="showdata.php" id="img4" class="btn btn-success btn-md text-center p-3 m-3">Retour<----</a>

        <body>
            <hr style="color:green;">
            <h1 style="color:crimson;">Statistiques</h1>
            <hr style="color:green;">
        <table>
        <tr><th>nombre total de consultations</th></tr>
         <?php 
           $quer = "SELECT count(specialiteID) as nombreConsultations
            FROM consultation;";
           $q = $dbh->prepare($quer);
           $q->execute();
           $re = $q->fetchAll(PDO::FETCH_ASSOC);
           ?>
            <?php
            // Display the statistics in an HTML table
           echo "<table border='1'>";
           echo "<thead>";
           echo "<tr><th>Nombre consultations</th></tr>";
           echo "</thead>";
           echo "<tbody>";
           foreach ($re as $row) {
           echo  "<td>".$row['nombreConsultations']."</td>";
                                      
           }
           echo "<tbody>";
           echo "</table>";
           ?>
          <tr><th>nombre total de patients</th></tr>
            <?php 
            $query = "SELECT count(patientID) as nombrePatients
            FROM patient;";
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php
             // Display the statistics in an HTML table
            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr><th>nombre patients</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($res as $row) {
                 echo "<tr><td>".$row['nombrePatients']."</td></tr>";
              
            }
            echo "<tbody>";
            echo "</table>";
            ?>
           <tr><th>nombre total des patients 'femme'</th></tr>
            <?php 
            $q = " SELECT count(patientID) as nbmaladeFemmes
               FROM patient
               WHERE sexe = 'femme';";
            $stm = $dbh->prepare($q);
            $stm->execute();
            $resu = $stm->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php
             // Display the statistics in an HTML table
            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr><th>nombre de maladies femmes</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($resu as $row) {
                echo "<tr><td>".$row['nbmaladeFemmes']."</td></tr>";
              
            }
            echo "<tbody>";
            echo "</table>";
            ?>
            <tr><th>le nombre de patients femme et homme</th></tr>
            <?php 
            $que = "SELECT sexe, COUNT(*) as nombre 
            FROM patient 
            WHERE sexe IN ('femme', 'homme') 
            GROUP BY sexe;";
            $st = $dbh->prepare($que);
            $st->execute();
            $resul = $st->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php
             // Display the statistics in an HTML table
            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr><th>Genre</th><th>nombrePatients</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($resul as $row) {
                echo "<tr><td>".$row['sexe'].' '."</td>
                    <td>".$row['nombre']."</td></tr>";
              
            }
            echo "<tbody>";
            echo "</table>";
            ?>
            <tr><th>les specialites et le nombre de demandes de chacune d'elles</th></tr>
            <?php 
             $que = "  SELECT nom_specialiste, COUNT(*) AS nombreDemandes
                       FROM consultation
                       JOIN specialite ON consultation.specialiteID = specialite.specialiteID
                       GROUP BY nom_specialiste;";
             $st = $dbh->prepare($que);
             $st->execute();
             $result = $st->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php
             // Display the statistics in an HTML table
            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr><th>Specialite</th><th>nb de demandes</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($result as $row) {
                echo "<tr><td>".$row['nom_specialiste']."</td>
                      <td>".$row['nombreDemandes']."</td></tr>";
              
            }
            echo "<tbody>";
            echo "</table>";
            ?>
            <tr><th>le nombre de consultations de jours et de nuit</th></tr>
            <?php 
             $sql = "SELECT SUM(CASE WHEN HOUR(rdv_heure) >= 00 
                     AND HOUR(rdv_heure) < 12 THEN 1 ELSE 0 END) AS nb_consultations_jour,
                     SUM(CASE WHEN HOUR(rdv_heure) < 00 OR HOUR(rdv_heure) >= 12 THEN 1 ELSE 0 END) 
                     AS nb_consultations_nuit 
                     FROM patient;";
            $statment = $dbh->prepare($sql);
            $statment->execute();
            $bilan = $statment->fetchAll(PDO::FETCH_ASSOC);
            ?>
             <?php
             // Display the statistics in an HTML table
            echo "<table border='1'>";
            echo "<thead>";
            echo "<th>jour</th><th>nuit</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($bilan as $row) {
                echo "<tr><td>".$row['nb_consultations_jour']."</td>
                      <td>".$row['nb_consultations_nuit']."</td></tr>";
              
            }
            echo "<tbody>";
            echo "</table>";
            ?>
            </table>

        </body>
</html>