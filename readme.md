Pour réinstaller ce site et sa base de données sur un serveur local XAMPP, il faut tout d'abord télécharger et installer XAMPP. 
Dans la fenêtre du panneau de contrôle XAMPP, on démarre les services Apache et MySQL en cliquant sur le bouton "Start". Ensuite, on copie tous les fichiers nécessaires au site web et on les colle dans un nouveau dossier créé exclusivement pour notre site web. Ce dossier doit se trouver dans le répertoire htdocs ou www.

Ensuite, il faut exporter sa base de données pour l'importer dans le serveur local XAMPP. Pour cela, nous allons sur phpmyadmin via ce lien http://localhost/phpmyadmin/. On créé sa base de données en lui donnant un nom adéquat (resaweb dans mon cas). 

Dans le fichier php, il faut se connecter à la base via un hôte (localhost), un nom d'utilisateur (généralement root), un mot de passe (root ou rien) et le nom de sa base de donnée.

Et enfin, nous pouvons accéder au site avec cette URL:

http://localhost/resaweb/index.php