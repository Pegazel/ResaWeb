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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Changa+One:ital@1&family=Dosis&family=Poppins&display=swap" rel="stylesheet">
    <link rel="icon" href="images/drapeau.png">
    <title>Plan du site</title>
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
        <div class="plan" id="contenu">
            <div>
                <h1><a href="vehicules.php">Nos véhicules :</a></h1>
                <ul>
                    <?php
                    // Connexion à la base de données
                    $servername = "localhost";
                    $username = "gazengel";
                    $password = '9QaLgd4yExz$phF'; 
                    $dbname = "gazengel_resaweb";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Échec de la connexion : " . $conn->connect_error);
                    }

                    // Récupérer les noms des véhicules depuis la table "voiture"
                    $sqlVehicules = "SELECT * FROM voiture";
                    $resultVehicules = $conn->query($sqlVehicules);

                    if ($resultVehicules->num_rows > 0) {
                        while ($row = $resultVehicules->fetch_assoc()) {
                            $nomVoiture = $row['nom_voiture'];
                            echo '<li><a href="detail_vehicule.php?id=' . $row["id_voiture"] . '">' . $nomVoiture . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>


            <div>
                <h1><a href="pilote.php">Nos pilotes :</a></h1>
                <ul>
                    <?php
                    // Récupérer les noms des pilotes depuis la table "pilote"
                    $sqlPilotes = "SELECT nom_prenom FROM pilote";
                    $resultPilotes = $conn->query($sqlPilotes);

                    if ($resultPilotes->num_rows > 0) {
                        while ($row = $resultPilotes->fetch_assoc()) {
                            $nomPilote = $row['nom_prenom'];
                            echo '<li>' . $nomPilote . '</li>';
                        }
                    }

                    // Fermer la connexion à la base de données
                    $conn->close();
                    ?>
                </ul>
            </div>
            <div>
                <h1>En savoir plus</h1>
                <ul>
                    <li><a href="nous.php#mention">Mentions légales</a></li>
                    <li><a href="nous.php">Qui sommes nous?</a></li>
                    <li><a href="index.php#nouveautes">Nouveautés</a></li>
                </ul>
            </div>
        </div>
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