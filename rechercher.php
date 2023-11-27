<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header-footer.css">
    <link rel="stylesheet" href="vehicule.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Changa+One:ital@1&family=Dosis&family=Poppins&display=swap" rel="stylesheet">
    <link rel="icon" href="images/drapeau.png">
    <title>Recherche</title>
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
                        <button type="submit" class="search-button"><img class="loupe" src="images/loupe.png" alt=""> <span class="sr-only">Lancer la recherche</span></button>
                    </div>
                </label>
            </form>
            <a href="vehicules.php">Nos véhicules</a>
            <a href="pilote.php">Nos pilotes</a>
            <a class="panier" href="panier.php">Mon panier</a>
        </nav>
    </header>


    <main>
        <section>
            <?php
            // Récupération du terme de recherche depuis le formulaire
            $searchTerm = $_POST['search'];

            // Extraction du type de voiture
            $type = '';
            if (preg_match("/\b(course|moto|rallye)\b/i", $searchTerm, $matches)) {
                $type = strtolower($matches[0]);
                $searchTerm = trim(str_ireplace($matches[0], '', $searchTerm));
            }

            // Connexion à la base de données
            $servername = "localhost";
            $username = "gazengel";
            $password = '9QaLgd4yExz$phF'; 
            $dbname = "gazengel_resaweb";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Échec de la connexion : " . $conn->connect_error);
            }

            // Construction de la requête SQL en fonction des termes de recherche et du type de voiture
            $sql = "SELECT * FROM voiture WHERE 1=1";

            if (!empty($searchTerm)) {
                $sql .= " AND nom_voiture LIKE '%$searchTerm%'";
            }

            if (!empty($type)) {
                $sql .= " AND type = '$type'";
            }

            $result = $conn->query($sql);

            // Affichage des résultats de la recherche
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                // Affichez les informations des résultats de la recherche
                    echo "  <a id=\"contenu\" class=\"vehicule\" href=\"detail_vehicule.php?id=" . $row["id_voiture"] . "\">
                                <img class=\"img\" src=\"images/" . $row["image1_voiture"] . "\" alt=\"\">";
                    echo "      <h1 class=\"intitule\">" . $row["nom_voiture"] . "</h1>";
                    echo "      <p class=\"descri\">" . $row["description"] . "</p>";
                    echo "      <p class=\"prix\">" . $row["prix_voiture"] . " €</p>
                            </a>";
                }
            } else {
                echo "  <p id=\"contenu\"class=\"aucun\">Aucun résultat trouvé.</p>";
            }

            $conn->close();
            ?>

        </section>
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