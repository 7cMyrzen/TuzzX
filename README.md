# Sites E-Commerce PHP

<img height="50" src="https://raw.githubusercontent.com/marwin1991/profile-technology-icons/refs/heads/main/icons/php.png"> <img height="50" src="https://raw.githubusercontent.com/marwin1991/profile-technology-icons/refs/heads/main/icons/html.png"> <img height="50" src="https://raw.githubusercontent.com/marwin1991/profile-technology-icons/refs/heads/main/icons/css.png"> <img height="50" src="https://raw.githubusercontent.com/marwin1991/profile-technology-icons/refs/heads/main/icons/javascript.png">

## Installation

Télécharger le zip du repository et le dézipper dans le dossier www de Wampserver64.

Ouvrir Wampserver, et aller sur la page de phpMyAdmin.
Créer une nouvelle table `tuzzx`, aller dans l'onglet importer et importer le fichier `/database/tuzzX Basics` (ce fichier contient toutes les tables nécessaires aux fonctionnement du site et quelques données de base).

Ouvrir la page `localhost/tuzzx/`.

## Backend

### Ficher `index.php`:  
&nbsp;&nbsp;&nbsp;&nbsp;Point d'entrée de toutes les requêtes redirigées via .htaccess  

### Dossier `/app`(serveur):  
&nbsp;&nbsp;&nbsp;&nbsp;`/models`: Partie M (MVC) avec les fonctionspour agir sur la base de donnée.  
&nbsp;&nbsp;&nbsp;&nbsp;`/views`: Partie V (MVC) avec les pages contenant le html des différentes pages.  
&nbsp;&nbsp;&nbsp;&nbsp;`/controllers`: Partie C (MVC) qui contrôle le fonctionnement du site (connection, requêtes).  
&nbsp;&nbsp;&nbsp;&nbsp;`/core`: Dossier avec les configurations (database.php pour la base de donnée et le Routeur qui s'occupe d renvoyer vers les différents controller).

### Dossier `database`:  
&nbsp;&nbsp;&nbsp;&nbsp;Dossier contenant le fichier de créatiion de la base de la base de donnée.

### Dossier `public`:  
&nbsp;&nbsp;&nbsp;&nbsp; Dossier contenant les ressouces affichées à l'écran (CSS, JS, Images)
    

## Description

TuzzX est un site de vente de en ligne avec des *vaisseau spaciaux* mis en vente.

Le site dispose de plusieurs pages :

|Page   |Utilité|   Lien    |
|-------|-------|-------|
|Home |Page d'accueil|index.php?url=home|
|Auth |Page d'authentification|index.php?url=auth|
|Profile|Page de profil|index.php?url=profile|
|Cart|Page du panier|index.php?url=cart|
|Shop|Page de la boutique avec les articles| index.php?url=ships|
|Ships|Page d'un article à part|index.php?url=ship?id={id}|
|Invoice|Page de facture|index.php?url=invoice?id={id}|
|Sell |Page de vente| index.php?url=sell|
|Admin|Page réservée aux admin|index.php?url=admin|

#### Fonctionnement

Quand on arrive sur le site une page d'accueil apparaît, de là on peut soit aller se connecter (ou s'inscrire) avec un compte existant :

|Utilisateur|Mot de passe|
|---|---|
|Tous les users de base| user |
|Tous les admins de bases| admin |
|Sauf Tuzz L'Eblair avec |okok|

Ensuite on peut aller vers la boutique, regarder les vaisseaux en ventes. Aller vers son profil, voir son panier et ses factures si il y en a. Ou encore aller dans l'onglet vente vendre son propre vaisseau (une fois mis en vente, il n'est pas sur la page de vente car un admin doit valider l'ajout depuis la page admin pour des raisons de modérations).
