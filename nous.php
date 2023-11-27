<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="nous.css">
    <link rel="stylesheet" href="header-footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Changa+One:ital@1&family=Dosis&family=Poppins&display=swap" rel="stylesheet">
    <link rel="icon" href="images/drapeau.png">
    <title>Qui sommes nous?</title>
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
        <h1 id="contenu">Qui sommes nous?</h1>
        <p>Bienvenue sur notre site de réservation fictif, réalisé exclusivement dans le cadre d'un projet étudiant de première année du BUT MMI. Notre équipe passionnée est ravie de vous accueillir et de vous offrir une expérience unique de réservation de voitures de course, de motos et de rallye.</p>

        <p>Notre objectif est de vous faire vivre des sensations fortes en vous permettant de réserver des véhicules de course d'exception et de vous offrir des expériences uniques sur circuit. Que vous soyez un amateur de vitesse, un passionné de sensations fortes ou simplement curieux de découvrir le monde de la course automobile, notre site est conçu pour répondre à vos attentes.</p>
            
        <p>Nous nous engageons à vous fournir un service de qualité, où la sécurité est notre priorité absolue. Tous nos pilotes sont des professionnels expérimentés qui veilleront à vous offrir une expérience de conduite inoubliable tout en assurant votre sécurité à chaque instant.</p>
            
        <p>Veuillez noter que ce site est purement fictif et ne propose pas de réservations réelles. Il a été créé dans le cadre de notre formation universitaire pour mettre en pratique nos connaissances et compétences en matière de développement web et de conception de sites.</p>
            
        <p>Nous vous invitons à explorer notre site et à découvrir les différentes options de réservation disponibles. N'hésitez pas à nous contacter si vous avez des questions ou des demandes spécifiques. Merci de votre visite et nous espérons que vous apprécierez votre expérience virtuelle sur notre site de réservation.</p>



        <h1 id="mention">Mentions légales</h1>

        <p> Propriétaire du site :  <br>
        Nom de l'entreprise : Fast & Serious <br>
        2 Rue Albert Einstein, <br>
        77420 Champs-sur-Marne </p>
        
        <p>Responsable de la publication : Pauline Gazengel</p>
        
        <p>Hébergement du site : <br>
        o2switch <br>
        Chemin des Pardiaux, <br>
        63000 Clermont-Ferrand</p>
        
        <p> Propriété intellectuelle : <br>
        Tous les contenus présents sur ce site, tels que les textes, les images, les vidéos et les éléments graphiques, sont la propriété exclusive de leurs détenteurs respectifs. Tous les médias utilisés sur ce site sont libres de droits, à l'exception de la vidéo de la caméra embarquée de la Beltoise, qui est la propriété de l'Argus, et des images de la Beltoise, qui sont la propriété de l'Argus, de Carsidiac et de l'Automobile Magazine. Toute utilisation, reproduction ou diffusion non autorisée de ces contenus est strictement interdite.</p>
        
        <p> Protection des données personnelles : <br>
        Les informations personnelles collectées sur ce site sont traitées dans le respect de la réglementation en vigueur. Elles sont utilisées uniquement dans le cadre de la réservation de véhicules et ne sont en aucun cas partagées avec des tiers. Conformément à la loi sur la protection des données, vous disposez d'un droit d'accès, de rectification et de suppression de vos données personnelles. Pour exercer ces droits, veuillez nous contacter à l'adresse indiquée ci-dessus.</p>

        <p>Je remercie mes camarades pour leur aide sur mon site, Lou-Anne DUBILLE, Nahina BOIREAU, Arthur ZACHARY, Morgan ZARKA, Waldi FIAGA et Idriss MEROUANE.</p>
        
        <p>Nous vous remercions de lire attentivement ces mentions légales. Pour toute question ou demande d'information supplémentaire, veuillez nous contacter à l'adresse indiquée ci-dessus.</p> 
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