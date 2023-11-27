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

// Récupération des informations du véhicule depuis la base de données
$vehicule_id = $_GET['id']; 
$query = "SELECT nom_voiture FROM voiture WHERE id_voiture = $vehicule_id";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nom_vehicule = $row["nom_voiture"];
} else {
    $nom_vehicule = "Véhicule non trouvé"; // Affichage par défaut si le véhicule n'est pas trouvé
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header-footer.css">
    <link rel="stylesheet" href="detail_vehicule.css">
    <link rel="stylesheet" href="slider.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Changa+One:ital@1&family=Dosis&family=Poppins&display=swap" rel="stylesheet">
    <link rel="icon" href="images/drapeau.png">
    <title><?php echo $nom_vehicule; ?></title>
</head>

<body>
    <header>
        <a href="#contenu" class="skip-link">Aller au contenu</a>
        <nav class="nav">
            <a href="index.php" class="titre" id="Accueil"><img class="logo" src="images/logo.png" alt="Accueil"></a>
            <form method="POST" action="rechercher.php" class="search-form">
                <label for="recherche"><span class="sr-only">Champ de recherche sur le site</span>
                <div class="search-input">
                    <input type="text" id="recherche" name="search" placeholder="Recherche">
                    <button type="submit" class="search-button"><img class="loupe" src="images/loupe.png" alt=""> <span class="sr-only">Lancer la recherche</span> </button>
                </div>
                </label>
            </form>
            <a href="vehicules.php">Nos véhicules</a>
            <a href="pilote.php">Nos pilotes</a>
            <a class="panier" href="panier.php">Mon panier</a>
        </nav>
    </header>


    <main>


            <?php
            // Récupération de l'ID de la voiture à partir de l'URL
            if (isset($_GET["id"])) {
                $voitureId = $_GET["id"];

                // Connexion à la base de données
                $servername = "localhost";
                $username = "gazengel";
                $password = '9QaLgd4yExz$phF'; 
                $dbname = "gazengel_resaweb";
               
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Échec de la connexion : " . $conn->connect_error);
                }


                $sql = "SELECT * FROM voiture , client  WHERE id_voiture = $voitureId";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    

                    // Affichage des informations de la voiture
                    echo "  <a class=\"retour\" href=\"vehicules.php\" id=\"contenu\">
                                <img class=\"fleche\" src=\"images/fleche.png\" alt=\"Retour à la page des véhicules\">    
                            </a>";
                    echo "  <h1 class=\"nom\">" . $nom_vehicule . "</h1>";



                    echo "  <div class=\"js-slider\">
                                <div class=\"js-photos\">";
                    
                    // Récupérer le numéro de la dernière image non vide
                    $lastImage = 1;
                    for ($i = 2; $i <= 5; $i++) {
                        if (!empty($row["image" . $i . "_voiture"])) {
                            $lastImage = $i;
                        }
                    }
                    
                    // Afficher la dernière image
                    echo "          <div class=\"js-photo clone\">
                                        <img src=\"images/" . $row["image" . $lastImage . "_voiture"] . "\" alt=\"\">
                                    </div>";
                    


                    // Afficher les images intermédiaires
                    for ($i = 1; $i <= 5; $i++) {
                        $imageURL = $row["image" . $i . "_voiture"];
                        $imageAlt = "";

                        if (!empty($imageURL)) {
                            echo "  <div class=\"js-photo reel-slide\">";
                            echo "      <img class=\"images_slider\" src=\"images/" . $imageURL . "\" alt=\"" . $imageAlt . "\">";
                            echo "  </div>";
                        }
                    }
                    
                    // Afficher la première image
                    echo "      <div class=\"js-photo clone\">
                                    <img src=\"images/" . $row["image1_voiture"] . "\" alt=\"\">
                                </div>";

                    echo "  </div>
                            <div class=\"js-navigation\">
                                <button class=\"js-btn-decale-droite\">
                                    <span class=\"arrow\"><span class=\"sr-only\">image suivante</span></span>
                                </button>
                                <button class=\"js-btn-decale-gauche\">
                                    <span class=\"arrow\"><span class=\"sr-only\">image précédente</span></span>
                                </button>
                            </div>
                        </div>";


                    echo "  <section>
                            <div class=\"un\">";


                    $sqlAvis = "SELECT * FROM avis ORDER BY date_creation DESC";
                    $resultAvis = $conn->query($sqlAvis);

                    if ($resultAvis->num_rows > 0) {
                        echo "  <div class=\"avis\">";
                        echo "      <h2>Avis</h2>";

                        $count = 0;
                        while ($rowAvis = $resultAvis->fetch_assoc()) {
                            echo "  <p class=\"space\"><strong>" . $rowAvis["pseudo"] . "</strong> a écrit le <strong>" . $rowAvis["date_creation"] . "</strong> :</p>";
                            echo "  <p>" . $rowAvis["commentaire"] . "</p>";

                            $count++;
                            if ($count >= 4) {
                                break;
                            }
                        }

                        $sqlAvisCount = "SELECT COUNT(*) AS total FROM avis";
                        $resultAvisCount = $conn->query($sqlAvisCount);

                        if ($resultAvisCount->num_rows > 0) {
                            $rowAvisCount = $resultAvisCount->fetch_assoc();
                            $totalAvis = $rowAvisCount["total"];

                            if ($totalAvis > 4) {
                                echo "<button id=\"afficherAvis\" onclick=\"chargerAvis()\">Voir tous les avis (" . $totalAvis . ")</button>";
                            }
                        }

                        echo "<div id=\"avisComplet\" style=\"display: none;\"></div>";
                        echo "</div>";
                    }


                    // Formulaire d'ajout d'avis
                    echo "<div class=\"avis_perso\">";
                    echo "  <form action=\"ajouter_avis.php\" method=\"POST\">
                                <p class=\"etoile\"> * Tous les champs sont obligatoires </p>
                                <label for=\"pseudo\">Pseudo <span class=\"etoile\"> * </span>: <br>
                                    <input id=\"pseudo\" type=\"text\" name=\"pseudo\" required><br>
                                </label>
                                <label class=\"commentaire\" for=\"commentaire\">Commentaire <span class=\"etoile\"> *</span>: <br>
                                    <textarea id=\"commentaire\" name=\"commentaire\" required></textarea><br>
                                </label>
                                <input class=\"bouton_avis\" type=\"submit\" value=\"Laisser un avis\">
                            </form>";
                    echo "</div>
                        </div>";

                    
                    echo "  <div class=\"deux\">
                                <p>" . $row["vrai_description"] . "</p>";
                    
                    $prixVoiture = $row["prix_voiture"];

                    echo "      <p class=\"prix\">Prix : " . $prixVoiture . "€</p>";



                    // Récupération des pilotes en fonction du type de véhicule
                    if ($row['type'] == 'course') {
                        $sqlPilote = "SELECT * FROM pilote WHERE FIND_IN_SET('course', type_pilote) > 0";
                    } elseif ($row['type'] == 'moto') {
                        $sqlPilote = "SELECT * FROM pilote WHERE FIND_IN_SET('moto', type_pilote) > 0";
                    } elseif ($row['type'] == 'rallye') {
                        $sqlPilote = "SELECT * FROM pilote WHERE FIND_IN_SET('rallye', type_pilote) > 0";
                    }

                    $resultPilote = $conn->query($sqlPilote);



                    // Affichage de la liste déroulante des pilotes
                    if ($resultPilote->num_rows > 0) {
                        echo "  <form action=\"panier.php\" method=\"POST\">  
                                    <label class=\"pilote\" for=\"pilote\">Pilote : ";
                        echo "      <select id=\"pilote\" name=\"pilote\">";
                        while ($rowPilote = $resultPilote->fetch_assoc()) {
                            echo "  <option value=\"" . $rowPilote["id_pilote"] . "\">" . $rowPilote["nom_prenom"] . "</option>";
                        }
                        echo "      </select>
                                </label><br>";
                    } else {
                        echo "  <p>Aucun pilote disponible.</p><br>";
                    }

                    echo "          <a href=\"pilote.php\" class=\"plus_pilote\">En savoir plus sur les pilotes</a>";
                    echo "          <input type=\"hidden\" name=\"voiture\" value=\"" .  $voitureId . "\">";
                    echo "          <input type=\"hidden\" name=\"prix\" value=\"" . $prixVoiture . "\">";

                    echo "          <input class=\"reserver\" type=\"submit\" value=\"Réserver\">
                                </form> 
                            </div>
                        </section>";




                } else {
                    echo "Voiture non trouvée.";
                }

                $conn->close();
            }
            ?>


    </main>

    <footer>
        <img class="logo" src="images/logo.png" alt="">
        <div class="links">
            <a href="pilote.php">Nos pilotes</a>
            <a href="index.php#nouveautes">Évènements à venir</a>
        </div>
        <div class="links">
            <a href="vehicules.php">Nos véhicules</a>
            <a href="plan.php">Plan du site</a>
        </div>
        <div class="links">
            <a href="nous.php">Qui sommes nous?</a>
            <a href="nous.php#mention">Mentions légales</a>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>