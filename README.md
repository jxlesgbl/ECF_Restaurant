# ECF_Restaurant
Projet ECF TP DREETS

Repo publique.

Pour exécuter localement, clonez le repo GitHub et suivez ces étapes :

- Installer PHP 8.0 ou supérieur sur sa machine.
- Installer Composer, un gestionnaire de dépendances PHP.
- Cloner le référentiel sur sa machine locale.
- Accéder au répertoire racine du projet dans le terminal/l'invite de commande.
- Exécuter la commande 'composer install' pour installer toutes les dépendances du projet.
- Créer un fichier .env dans le répertoire racine du projet et configurer les identifiants de la base de données et autres variables d'environnement nécessaires.
- Exécuter la commande php bin/console 'doctrine:database:create' pour créer la base de données.
- Exécuter la commande php bin/console 'doctrine:migrations:migrate' pour exécuter les migrations de base de données et créer les tables nécessaires dans la base de données.
- Enfin, démarrer le serveur local en exécutant la commande 'symfony serve' ou 'symfony server:start' dans le terminal.
- Une fois que le serveur est en cours d'exécution, le projet devrait être accessible à l'adresse http://localhost:8000 dans un navigateur web.


Ce projet présente une application full-stack du restaurant Quai Antique.

Les fonctionnalités client:

- réservation de table 
- connexion
- inscription

Les fontionnalités admin :

- création de menus / galleries
- connexion
- Vue des réservations clients

