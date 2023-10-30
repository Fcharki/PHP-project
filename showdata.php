<td ><a href="logout.php" id="float-right" class="btn btn-danger btn-md text-center p-2 m-3">Log out</a></td>
<?php
// se connecter à la base de données 
include_once("connect_pdo.php");
?>
<hr>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Affichage dans un tableau </title>
		<meta name="generator" content="Bootply"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/css.css">
        <style>
        body{
            font-size: 24px;
        }
        .wrapper{
            width: 90%;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    </head>

        <body style="background-color:antiquewhite;">
        <table border="1">
        <div class="container col-12"><strong><u><i>Reportings :</i></u></strong>
            <a href="reporting.php" class="btn btn-warning btn-md text-center px-2 m-3">View statistics R1</a>
            <a href="attestation.php" class="btn btn-success btn-md text-center px-2 m-3">View attestation R2</a>
            <a href="graphique.php" class="btn btn-info px-2 m-3" >view the graphical representation R3</a>
            </div>
        </table>
           
        <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 d-flex justify-content-between">
                        <h2 class="pull-left">___________________Liste des patients______________________</h2>
                
                    </div>
<?php
// Sélectionner les données de la table
$requete = "SELECT * FROM patient";
$result = $dbh->query($requete);
// Afficher les données dans un tableau HTML
echo "<table border=1   class='table table-bordered table-striped table-responsive'>";
echo   "<tr>
        <th class='col-2 text-center fs-4'>ID</th>
        <th class='col-2 text-center fs-5'>Nom complet</th>
        <th class='col-2 text-center fs-5'>Genre</th>
        <th class='col-2 text-center fs-5'>Numéro de téléphone</th>
        <th class='col-1 text-center fs-5'>Question</th>
        <th class='col-2 text-center fs-5'>Date rdv</th>
        <th class='col-1 text-center fs-5'>Heure rdv</th>
        <th class='text-center fs-5' colspan='2'>Actions</th>
        </tr>";

while($row = $result->fetch(PDO::FETCH_ASSOC)) {
$id = $row["patientID"];
if($row["visite_boolean"] == 1){
    $row["visite_boolean"] =  'oui';
}else{
    $row["visite_boolean"] =  'non';
}

    echo  "<tr>
          <td class='col-1 text-center fs-6'>".$id ."</td>
          <td class='col-2 text-center fs-6'>".$row["nom"]."</td>
          <td class='col-1 text-center fs-6'>".$row["sexe"]."</td>
          <td class='col-2 text-center fs-6'>".$row["numero"]."</td>
          <td class='col-1 text-center fs-6'>".$row["visite_boolean"]."</td>
          <td class='col-2 text-center fs-6'>".$row["rdv_date"]."</td>
          <td class='col-3 text-center fs-6'>".$row["rdv_heure"]."</td>";

          echo '<div class="btn-group">';   
          echo '<td><a class="btn btn-success d-inline-block"  href="update.php?updateid=' .$id. '">Modifier</a></td>'; // le bouton d'update
         
          echo '<td><a class="btn btn-danger d-inline-block " href="delete.php?deleteid=' .$id. ' ">Supprimer</a></td>'; // le bouton de suppression
        }  
        
        echo '</div>';
        echo '</tr>';
        echo '<p><a class="btn btn-md btn-primary d-inline-block" href="ajout.php?addid=' .$id. '">Ajouter un patient</a></p>'; //  le bouton d'ajout;

  
echo "</table>";

// se déconnecter de la base de données
$dbh = null;
?>
</body>
</html>