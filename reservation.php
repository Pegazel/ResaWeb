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

        <?php
        // Vérifier si les données du formulaire sont soumises
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $nom = $_POST["nom"] ?? "";
            $prenom = $_POST["prenom"] ?? "";
            $age = $_POST["age"] ?? "";
            $nb_pers = $_POST["nombre_personnes"] ?? "";
            $mail = $_POST["email"] ?? "";
            $tel = $_POST["telephone"] ?? "";
            $date_reservation = $_POST["date_reservation"] ?? "";
            $prixVoiture = $_POST["prix"] ?? "";
            $nomVoiture = $_POST["nom_voiture"] ?? "";
            $nomPilote = $_POST["nom_pilote"] ?? "";
            $creneau = $_POST["creneau"] ?? "";

            // Connexion à la base de données
            $servername = "localhost";
            $username = "gazengel";
            $password = '9QaLgd4yExz$phF'; 
            $dbname = "gazengel_resaweb";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Échec de la connexion : " . $conn->connect_error);
            }
         

            // Insérer les données dans la table client
            $sql = "INSERT INTO client (nom, prenom, age, mail, tel, date_reservation, nom_voiture, nom_pilote, prix, creneau_horaire)
                    VALUES ('$nom', '$prenom', '$age', '$mail', '$tel', '$date_reservation', '$nomVoiture', '$nomPilote', '$prixVoiture', '$creneau')";
            if ($conn->query($sql) === TRUE) {
                echo "<p class=\"aucun\" id=\"contenu\">Réservation confirmée!<br>";
                echo "Merci $prenom $nom, votre réservation a été enregistrée avec succès !</p>";
            } else {
                echo "<p class=\"aucun\" id=\"contenu\">Erreur lors de la réservation : " . $conn->error . "</p>";
            }


            // Envoyer l'e-mail de confirmation
            $to = $mail; // Adresse e-mail du destinataire
            $subject = "Confirmation de réservation"; // Sujet de l'e-mail

            $message = "Cher(e) $prenom $nom,\n\n";
            $message .= "Nous vous confirmons la réservation de notre véhicule pour la date suivante : $date_reservation.\n\n";
            $message .= "Nous vous remercions pour votre réservation et restons à votre disposition pour toute demande supplémentaire.\n\n";
            $message .= "Cordialement,\n";
            $message .= "L'équipe de Fast & Serious";

            $headers = "From: pauline.gazengel@edu.univ-eiffel.fr";

            // Envoyer l'e-mail
            if (mail($to, $subject, $message, $headers)) {
                echo "<p class=\"aucun\">Réservation confirmée. Un e-mail de confirmation a été envoyé à l'adresse $mail.</p>";
            } else {
                echo "<p class=\"aucun\">Erreur lors de l'envoi de l'e-mail de confirmation.</p>";
            }

            // Fermer la connexion à la base de données
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