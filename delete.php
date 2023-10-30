<?php 
include "connect_pdo.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];
    $quer = "delete from patient where patientID= $id";
    $q = $dbh->prepare($quer);
    $result = $q->execute();

        if($result){
            echo "<script>alert('Row successfully deleted')</script>";
            header('location: showdata.php');
        }else{
            echo "<script>alert('Something went wrong ')</script>";
        }

}

?>