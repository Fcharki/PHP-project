<td ><a href="logout.php" id="float-right" class="btn btn-danger btn-md text-center p-2 m-3">Log out</a></td>

<?php 
include "connect_pdo.php";
$id = $_GET['updateid'];
// Sélectionner les données de la table patient
$requete = "SELECT * FROM patient where patientID = $id;";
$result = $dbh->query($requete);
while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $name = $row["nom"];
    $gender = $row["sexe"];
    $number = $row["numero"];
    $visit = $row["visite_boolean"];
    $date_rdv = $row["rdv_date"];
    $time_rdv = $row["rdv_heure"];
}


if(isset($_POST['submit'])) {
    // Get the patientID
   
    $nomComplet = $_POST['name'];
    $genre = $_POST['gender'];
    $numero = $_POST['telephone'];
    $visite = $_POST['consultation'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $req = "update patient
            set nom = :name,
                sexe = :gender,
                numero = :number,
                visite_boolean = :consult,
                rdv_date = :date,
                rdv_heure = :time
            where patientID = $id";

    $stmt = $dbh->prepare($req);
    // Bind the parameters
    $stmt->bindParam(':name', $nomComplet);
    $stmt->bindParam(':gender', $genre);
    $stmt->bindParam(':number', $numero);
    $stmt->bindParam(':consult', $visite);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time', $time);
    // Query Execution
    $result = $stmt->execute();
    // Message after updation
    if($result){
            echo "<script>alert('Successfully updated')</script>";
            echo "<script type='text/javascript'> document.location = 'showdata.php'; </script>";

        }else{
            echo "<script>alert('Something went wrong ')</script>";
        }
    }


?><hr>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title> Update page</title>
		<meta name="generator" content="Bootply"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/css.css">
    </head>
        <body class="bg-info">
        <a href="showdata.php" class="btn btn-success btn-md text-center p-2 m-3">Show the updated data</a>
<div class = "container-fluid">
<form  method="post" action="">
<table width="90%"  border="0"  class="form-row align-items-center">
<tr>
<th height="62" scope="row" class="col-sm-2 col-form-label">Nom complet </th>
<td width="71%"><input type="text" value="<?php echo $name ;?> " name="name" id="name" class="form-control form-control-sm"  required /></td>
</tr>
<tr>
<th height="62" scope="row" class="col-sm-2 col-form-label">Sexe</th>
<td  value="<?php echo $gender ;?>">
<select name="gender" id="gender_select" class="form-control form-control-sm" required>
    <option value="">--Veuillez sélectionner--</option>
    <option value="femme "  <?php if ($gender == 'femme') echo 'selected'; ?>>Femme</option>
    <option value="homme"   <?php if ($gender == 'homme') echo 'selecteed'; ?>>Homme</option>
</select>
</td>  
</tr>
<tr>
<th height="62" scope="row" class="col-sm-2 col-form-label">Numéro de téléphone : </th>
<td width="71%"><input type="tel" name="telephone"  value="<?php echo  $number ;?>" class="form-control form-control-sm" required /></td>
</tr>
<tr><th class="col-sm-2 col-form-label">Avez-vous déjà consulté ce médecin?</th>
<td>
<input type="radio" name="consultation"   value="1"  <?php if ($visit == '1') echo 'checked'; ?> class="form-check-input">Oui
<input type="radio" name="consultation" value="0"  <?php if ($visit == '0') echo 'checked'; ?>  class="form-check-input" >Non
</td><tr><td></td></tr>
</tr>
<tr>
<th class="col-sm-2 col-form-label">sélectionnez votre spécialiste:</th>
<div class="form-check form-check">
<td>
<input type="checkbox" class="form-check-input" name="specialite[]" value="1"  id="1"><label for="1" class="form-check-label" >ORL</label><br>
<input type="checkbox" class="form-check-input" name="specialite[]" value="2" id="2"><label for="2" class="form-check-label" >Chirurgien dentiste</label><br>
<input type="checkbox" class="form-check-input" name="specialite[]" value="3" id="3"><label for="3" class="form-check-label" >Medecin généraliste</label><br>
<input type="checkbox" class="form-check-input" name="specialite[]" value="4" id="4"><label for="4" class="form-check-label" >Gynécologue medical et obstétrique</label><br>
<input type="checkbox" class="form-check-input" name="specialite[]" value="5" id="5"><label for="5" class="form-check-label" >Pédiatre</label><br>
<input type="checkbox" class="form-check-input" name="specialite[]" value="6" id="6"><label for="6" class="form-check-label" >Ophtalmologue</label><br>
<input type="checkbox" class="form-check-input" name="specialite[]" value="7" id="7"><label for="7" class="form-check-label">Dermatologue et vénérologue</label>
</td></div></tr>
<tr>
<th class="col-sm-2 col-form-label">Rendez-vous</th>
</tr>
<tr>
    <th class="col-sm-2 col-form-label">Date</th>
<td>
<input type="date" name="date"   value="<?php echo $date_rdv ;?>">
</td></tr>
<tr>
    <th class="col-sm-2 col-form-label">Time</th>
<td><input type="time" name="time"   value="<?php echo $time_rdv ;?>"></td>
</tr>
<tr>
<th height="62" scope="row"></th>
<td width="71%"><input type="submit" name="submit" value="update" class="btn btn-primary mb-2" /> </td>
</tr>
</table>
</form>
<hr>
</div>
</body>
</html>

<?php
 include 'end_pdo.php';
?>