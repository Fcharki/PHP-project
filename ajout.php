
<?php
// se connecter à la base de données 
include_once("connect_pdo.php");
?>
<?php
$id= $dbh->lastInsertId();
// Retourner les données du formulaire
if(isset($_POST['submit'])) {
    $nomComplet = $_POST['name'];
    $genre = $_POST['gender'];
    $numero = $_POST['telephone'];
    $visite = $_POST['consultation'];
    $date = $_POST['date'];
    $time = $_POST['time'];


$sql="insert into patient(patientID, nom, sexe, numero, visite_boolean, rdv_date, rdv_heure)
values(:id, :name, :gender, :number, :consult, :date, :time)";

$query = $dbh->prepare($sql);
$query->bindParam(':id', $id);
$query->bindParam(':name', $nomComplet);
$query->bindParam(':gender', $genre);
$query->bindParam(':number', $numero);
$query->bindParam(':consult', $visite);
$query->bindParam(':date', $date);
$query->bindParam(':time', $time);

$patient_added = $query->execute();
if ($patient_added){
    echo "<script>alert('Row successfully added!');</script>";
}else
{
echo "<script>alert('Something went wrong.');</script>";
}
}

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Add page</title>
		<meta name="generator" content="Bootply"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/css.css">
    </head>
    <td ><a href="logout.php" class="btn btn-danger btn-md text-center p-2 m-3">Logout</a></td>

        <body class="bg-info">
        <a href="showdata.php" class="btn btn-success btn-md float text-center p-2 m-3">Show data</a>
<div class = "container-fluid">
<form  method="post" action="">
<table width="100%"  border="0"  class="form-row align-items-center">
<tr>
<th height="62" scope="row" class="col-sm-2 col-form-label">Nom complet </th>
<td width="71%"><input type="text" name="name" id="name"class="form-control form-control-sm"  required /></td>
</tr>
<tr>
<th height="62" scope="row" class="col-sm-2 col-form-label">Sexe</th>
<td>
<select name="gender"   id="gender_select" class="form-control form-control-sm" required>
    <option value="">--Veuillez sélectionner--</option>
    <option value="femme">Femme</option>
    <option value="homme">Homme</option>
</select>
</td>  
</tr>
<tr>
<th height="62" scope="row" class="col-sm-2 col-form-label">Numéro de téléphone : </th>
<td width="71%"><input type="tel" name="telephone"  class="form-control form-control-sm" required /></td>
</tr>
<tr><th class="col-sm-2 col-form-label">Avez-vous déjà consulté ce médecin?</th>
<td>
<input type="radio" name="consultation" class="form-check-input"  value="1">Oui
<input type="radio" name="consultation" class="form-check-input"  value="0">Non
</td><tr><td></td></tr>
</tr>
<tr>
<th class="col-sm-2 col-form-label">sélectionnez votre spécialiste:</th>
<div class="form-check form-check">
<td>
<input type="checkbox" class="form-check-input"  name="specialite[]" value="1" id="1"><label for="1" class="form-check-label" >ORL</label><br>
<input type="checkbox" class="form-check-input"  name="specialite[]" value="2" id="2"><label for="2" class="form-check-label" >Chirurgien dentiste</label><br>
<input type="checkbox" class="form-check-input"  name="specialite[]" value="3" id="3"><label for="3" class="form-check-label" >Medecin généraliste</label><br>
<input type="checkbox" class="form-check-input"  name="specialite[]" value="4" id="4"><label for="4" class="form-check-label" >Gynécologue medical et obstétrique</label><br>
<input type="checkbox" class="form-check-input"  name="specialite[]" value="5" id="5"><label for="5" class="form-check-label" >Pédiatre</label><br>
<input type="checkbox" class="form-check-input"  name="specialite[]" value="6" id="6"><label for="6" class="form-check-label" >Ophtalmologue</label><br>
<input type="checkbox" class="form-check-input"  name="specialite[]" value="7" id="7"><label for="7" class="form-check-label">Dermatologue et vénérologue</label>
</td></div></tr>
<tr>
<th class="col-sm-2 col-form-label">Rendez-vous</th>
</tr>
<tr>
    <th class="col-sm-2 col-form-label">Date</th>
<td>
<input type="date" name="date">
</td></tr>
<tr>
    <th class="col-sm-2 col-form-label">Time</th>
<td><input type="time" name="time"></td>
</tr>
<tr>
<th height="62" scope="row"></th>
<td width="71%"><input type="submit" name="submit" value="Submit" class="btn btn-primary mb-2" /> </td>
</tr>
</table>
</form>
</div>
</body>
</html>
