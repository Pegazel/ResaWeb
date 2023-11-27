<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="header-footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Changa+One:ital@1&family=Dosis&family=Poppins&display=swap" rel="stylesheet">
    <link rel="icon" href="images/drapeau.png">
    <title>Fast & Serious</title>
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

        <p class="text" id="contenu">Découvrez notre site de réservation en ligne pour des expériences de conduite sensationnelles. Réservez une voiture de course, une moto ou une voiture de rallye avec un pilote professionnel sur le circuit la Ferté-Droitier. Choisissez parmi une sélection de véhicules de haute performance et profitez d'une conduite guidée par des experts, le pilote étant celui qui conduit. Vivez l'adrénaline de la vitesse en toute sécurité. Réservez maintenant et plongez dans une expérience de conduite inoubliable.</p> 


        <h1 class="nouveautes" id="nouveautes" > Nouveautés:</h1>

        <?php
            $servername = "localhost";
            $username = "gazengel";
            $password = '9QaLgd4yExz$phF'; 
            $dbname = "gazengel_resaweb";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Échec de la connexion : " . $conn->connect_error);
            }

            // Requête SQL pour récupérer les nouveautés
            $sql = "SELECT * FROM nouveautes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "  <h2 class=\"test\"> " . $row["titre_nouveau"] . "</h2>";


                    // Si c'est une vidéo
                    if ($row["type_contenu"] === "video") {
                    echo "  <video class=\"video\" controls muted loop>
                                <source src=\"images/" . $row["image_nouveau"] . "\" type=\"video/mp4\" alt=\"\">
                            </video>";
                    }
                    // Sinon, c'est une photo
                    else {
                        // Vérifier le nombre d'images pour la ligne
                        $images = explode(',', $row["image_nouveau"]);
                        $numImages = count($images);

                        // Si une seule image
                        if ($numImages === 1) {
                            echo "  <img class=\"video\" src=\"images/" . $images[0] . "\" alt=\"\">";
                        }
                        // Si deux images
                        elseif ($numImages === 2) {
                            echo "  <div class=\"img\">
                                        <img class=\"image\" src=\"images/" . $images[0] . "\" alt=\"\">";
                                        
                            echo "      <img class=\"image\" src=\"images/" . $images[1] . "\" alt=\"\">
                                    </div>";
                        }
                        
                    }

                    echo "<p class=\"descriptif\">" . $row["texte_nouveau"] . "</p>";
                    
                }
            } else {
                echo "Aucune nouveauté trouvée.";
            }

            $conn->close();

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