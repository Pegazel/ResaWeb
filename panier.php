<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="panier.css">
    <link rel="stylesheet" href="header-footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Changa+One:ital@1&family=Dosis&family=Poppins&display=swap" rel="stylesheet">
    <link rel="icon" href="images/drapeau.png">
    <title>Panier</title>
    <script>
        function validerFormulaire() {
            var nom = document.getElementById("nom").value;
            var prenom = document.getElementById("prenom").value;
            var email = document.getElementById("email").value;
            var tel = document.getElementById("telephone").value;
            var age = document.getElementById("age").value;
            var dateReservation = document.getElementById("date_reservation").value;

            var erreurs = [];

            if (nom === "") {
                erreurs.push("Le champ 'Nom' est requis.");
            }

            if (prenom === "") {
                erreurs.push("Le champ 'Prénom' est requis.");
            }

            if (email === "") {
                erreurs.push("Le champ 'Email' est requis.");
            } else if (!emailValide(email)) {
                erreurs.push("Veuillez saisir une adresse email valide. Par exemple prenom.nom@gmail.com");
            }

            if (tel === "") {
                erreurs.push("Le champ 'Téléphone' est requis.");
            } else if (!telValide(tel)) {
                erreurs.push("Veuillez saisir un numéro de téléphone valide. Il doit être du type 06 12 34 56 78");
            }

            if (age === "") {
                erreurs.push("Le champ 'Âge' est requis.");
            } else if (parseInt(age) < 18) {
                erreurs.push("Vous devez être âgé d'au moins 18 ans pour effectuer une réservation.");
            }

            if (dateReservation === "") {
                erreurs.push("Le champ 'Date de réservation' est requis.");
            } else {
                var dateAujourdhui = new Date();
                var dateSelectionnee = new Date(dateReservation);
                if (dateSelectionnee < dateAujourdhui) {
                    erreurs.push("La date de réservation ne peut pas être antérieure à aujourd'hui.");
                }
            }

            var messageErreur = document.getElementById("messageErreur");
            if (erreurs.length > 0) {
                messageErreur.innerHTML = "Erreur de saisie :<br>" + erreurs.join("<br>");
                messageErreur.style.display = "block";
                return false;
            }

            return true;
        }

        function emailValide(email) {
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        function telValide(tel) {
            var regex = /^(\d{2}\s){4}\d{2}$/;
            return regex.test(tel);
        }

    </script>
    
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
        
            $servername = "localhost";
            $username = "gazengel";
            $password = '9QaLgd4yExz$phF'; 
            $dbname = "gazengel_resaweb";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Échec de la connexion : " . $conn->connect_error);
            }

            if (isset($_POST['pilote'])) {
                $piloteId = $_POST['pilote'];
            
                // Requête pour récupérer le nom du pilote
                $sqlPilote = "SELECT nom_prenom FROM pilote WHERE id_pilote = ?";
                $stmtPilote = $conn->prepare($sqlPilote);
                $stmtPilote->bind_param("i", $piloteId);
                $stmtPilote->execute();
                $resultPilote = $stmtPilote->get_result();
            
                if ($resultPilote->num_rows > 0) {
                    $rowPilote = $resultPilote->fetch_assoc();
                    $piloteNom = $rowPilote['nom_prenom'];
            
                    echo '<h1 id="contenu">Votre réservation :</h1>';
                    echo '<div class="formulaire">';
                    echo "<p class=\"prix\">Pilote sélectionné : " . $piloteNom . "</p>";
            
                    if (!empty($_POST['voiture'])) {
                        $voitureId = $_POST['voiture'];
                        
            
                        // Requête pour récupérer le nom de la voiture
                        $sqlVoiture = "SELECT nom_voiture FROM voiture WHERE id_voiture = ?";
                        $stmtVoiture = $conn->prepare($sqlVoiture);
                        $stmtVoiture->bind_param("i", $voitureId);
                        $stmtVoiture->execute();
                        $resultVoiture = $stmtVoiture->get_result();
            
                        if ($resultVoiture->num_rows > 0) {
                            $rowVoiture = $resultVoiture->fetch_assoc();
                            $voitureNom = $rowVoiture['nom_voiture'];
                            
            
                            echo "<p class=\"prix\">Voiture sélectionnée : " . $voitureNom . "</p>";
                            echo "<div id=\"messageErreur\" class=\"erreur\"> </div>
                            <form action=\"reservation.php\" method=\"POST\" onsubmit=\"return validerFormulaire()\"><br>
                                <p class=\"etoile\"> * Tous les champs sont obligatoires </p>
                                <label for=\"nom\">Nom <span class=\"etoile\"> * </span> :
                                    <input type=\"text\" id=\"nom\" name=\"nom\" required>
                                </label><br>
                
                                <label for=\"prenom\">Prénom <span class=\"etoile\"> * </span> :
                                    <input type=\"text\" id=\"prenom\" name=\"prenom\" required>
                                </label><br>
                
                                <label for=\"age\">Âge <span class=\"etoile\"> * </span> :
                                    <input type=\"number\" id=\"age\" name=\"age\" maxlength=\"2\" required>
                                </label><br>
                
                                <label for=\"email\">Email <span class=\"etoile\"> * </span> :
                                    <input type=\"email\" id=\"email\" name=\"email\" required>
                                </label><br>
                
                                <label for=\"telephone\">Téléphone <span class=\"etoile\"> * </span> :
                                    <input type=\"tel\" id=\"telephone\" name=\"telephone\" placeholder=\"  06 12 34 56 78\" maxlength=\"14\" required>
                                </label><br>
                
                                <label for=\"date_reservation\">Date de réservation <span class=\"etoile\"> * </span> :
                                    <input type=\"date\" id=\"date_reservation\" name=\"date_reservation\" required>
                                </label><br>
                                
                                <label for=\"creneau\">Créneau horaire :
                                <select id=\"creneau\" name=\"creneau\">
                                    <option value=\"matin\">Matin (9h - 11h)</option>
                                    <option value=\"apres-midi\">Après-midi (14h - 16h)</option>
                                </select></label>
                                ";

                            if (isset($_POST['prix'])) {
                                $prixVoiture = $_POST['prix'];
                                echo "<p class=\"prix\">Prix : " . $prixVoiture . "€</p>";
                            }
                                
                            echo "<input type=\"hidden\" name=\"prix\" value=\"" . $prixVoiture . "\">";
                            echo "<input type=\"hidden\" name=\"nom_voiture\" value=\"" . $voitureNom . "\">";
                            echo "<input type=\"hidden\" name=\"nom_pilote\" value=\"" . $piloteNom . "\">";
                            
                                echo '<input class="envoyer" type="submit" value="Envoyer">
                            </form>
                        </div>';
                           
                        } else {
                            echo '<p class="panier_vide">Erreur : Voiture introuvable.</p>';
                        }
                    } else {
                        echo '<p id="contenu" class="panier_vide">Votre panier est vide.<br> Veuillez sélectionner un pilote pour commencer la réservation.</p>
                        <a class="retour" href="pilote.php">Retour vers les pilotes</a>';
                    }
                } else {
                    echo '<p class="panier_vide">Erreur : Pilote introuvable.</p>';
                }
            } else {
                echo '<p id="contenu" class="panier_vide">Votre panier est vide.<br> Veuillez sélectionner une voiture pour continuer la réservation.</p>
                <a class="retour" href="vehicules.php">Retour vers les véhicules</a>';
                    
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
    <script>
        window.onbeforeunload = function() {
            return "Attention : Si vous retournez en arrière, les informations que vous avez saisies dans ce formulaire seront perdues. Êtes-vous sûr de vouloir continuer ?";
        };
    </script>
</body>
</html>