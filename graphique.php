<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title> graphes </title>
		<meta name="generator" content="Bootply"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/css.css">
    </head>
        <body>
        <a href="showdata.php" id="img4" class="btn btn-success btn-md text-center p-3 m-3">Retour<----</a>

<?php require 'connect_pdo.php'; ?><hr>
<h3 class="text-center">La présentation graphique de nombre de consultations selon le genre : </h3>
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
 $q = " SELECT sexe, COUNT(*) as nombreF 
        FROM patient 
        WHERE sexe = 'femme'";
$result = $dbh->query($q);
$row = $result->fetch(PDO::FETCH_ASSOC);
$nombref = $row['nombreF'];

$sql = " SELECT sexe, COUNT(*) as nombreH 
        FROM patient 
        WHERE sexe = 'homme'";
$resultat = $dbh->query($sql);
$row = $resultat->fetch(PDO::FETCH_ASSOC);
$nombreh = $row['nombreH'];
?>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Femmes', 'Hommes'],
      datasets: [{
        label: 'nb de consultations',
        data: [<?php echo $nombref; ?>, <?php echo $nombreh; ?>],
          backgroundColor: ["rgba(210, 60, 140, 1)", "rgba(54, 162, 235, 1)"],
              borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
        </body>
</html>