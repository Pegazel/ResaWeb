<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detail_vehicule.css">
    <link rel="stylesheet" href="vehicule.css">
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
            // Vérifier si le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupérer les données du formulaire
                $pseudo = $_POST["pseudo"];
                $commentaire = $_POST["commentaire"];

                // Connexion à la base de données
                $servername = "localhost";
                $username = "gazengel";
                $password = '9QaLgd4yExz$phF'; 
                $dbname = "gazengel_resaweb";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Échec de la connexion : " . $conn->connect_error);
                }

                // Échapper les caractères spéciaux dans le commentaire
                $commentaire = mysqli_real_escape_string($conn, $commentaire);

                // Insertion de l'avis dans la base de données
                $sql = "INSERT INTO avis (pseudo, commentaire) VALUES ('$pseudo', '$commentaire')";
                if ($conn->query($sql) === TRUE) {
                    echo "  <a class=\"retour\" href=\"vehicules.php\">
                                <img class=\"fleche\" src=\"images/fleche.png\" alt=\"Retour à la page des véhicules\">    
                            </a>";
                    echo "  <p class=\"nom aucun\">Avis ajouté avec succès.</p>";
                } else {
                    echo "  <a class=\"retour\" href=\"vehicules.php\">
                                <img class=\"fleche\" src=\"images/fleche.png\" alt=\"Retour à la page des véhicules\">    
                            </a>";
                    echo "  <p class=\"nom aucun\">Erreur lors de l'ajout de l'avis : " . $conn->error . "</p>";
                }

                // Fermeture de la connexion à la base de données
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