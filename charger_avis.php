<?php
// Connexion à la base de données
$servername = "localhost";
$username = "gazengel";
$password = '9QaLgd4yExz$phF'; 
$dbname = "gazengel_resaweb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

$sqlAvis = "SELECT * FROM avis ORDER BY date_creation DESC LIMIT 4, 50";
$resultAvis = $conn->query($sqlAvis);

if ($resultAvis->num_rows > 0) {
    while ($rowAvis = $resultAvis->fetch_assoc()) {
        echo "<p class=\"space\"><strong>" . $rowAvis["pseudo"] . "</strong> a écrit le <strong>" . $rowAvis["date_creation"] . "</strong> :</p>";
        echo "<p>" . $rowAvis["commentaire"] . "</p>";
    }
}
?>

