<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil de l'application de gestion de la bibliotheque</title>
    <link rel="stylesheet" href="AccueilStyle.css">
</head>
<body class="defilement">
    <div class="menu">
        <div class="Icone-Library">
                <a href="Accueil.php"> <img src="Images/Icone_Library.png" alt="icone de la bibliotheaue"> </a>
            </div>
        <nav> 
            <h2>Enregistrement</h2>
            <a id="Abonne" href="Abonne.php">
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                        <img src="Images/iconeAbonne.png" alt="Delete icone">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Abonné</h3>
                    </div>
                  </div>
            </a>
            <a id="Auteur" href="Auteur.php" class="enregistrement" >
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                         <img src="Images/iconeAuteur.png" alt="Delete icone">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Auteur</h3>
                    </div>
                </div>
            </a>
            <a href="Livre.php" class="enregistrement">
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                        <img src="Images/iconeLivre.png" alt="Delete icone">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Livre</h3>
                    </div>
                </div>
            </a>
            <h2>Opération</h2>
            <a href="Emprunter.php" class="enregistrement">
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                        <img src="Images/iconeEmprunt.png" alt="Delete icone">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Emprunter</h3>
                    </div>
                </div>
            </a>
            <a href="Retourner.php" class="enregistrement" >
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                        <img src="Images/iconeRetourner.png" alt="Delete icone">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Retourner</h3>
                    </div>
                </div>
            </a>
        </nav>
    </div>
    <div class="conenuDroite" id="Accueil">
        <div class="description">
            <h1 class="titre">Bienvenue sur votre application de gestion de la bibliothèque</h1>
            <p>Ne laissez rien au hasard, personalisez votre exprerience, exploitez tout le potentiel et gérez votre bibliothèque avec précision !</p>
            <p>La situation actuelle de vos Abonnés, Auteur, livres, emprunts et retour est la suivante : </p>
        </div>
        <div class="situationBibliotheque">
            <div class="vosAbonnes">
                <a href="Abonne.html" class="choixAccuril">
                    <?php
                        try{
                        // Ouverture de la connexion à la base de données.
                        $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                        // Paramètreage des erreurs et exceptions à la connexion. 
                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //Préparation de la requête de lecture des données dans la base de données.
                        $req=$maVariable->prepare("SELECT COUNT(*) as n FROM abonne");
                        // Execution de la requête
                        $req->execute();
                        //Recupération des lignes de la base de données
                        $data=$req->fetchAll(PDO::FETCH_ASSOC);
                        //Nous parcourons les résultats de requêtes et nous les affichons ligne par ligne.

                        echo '<h1>'.$data[0]['n'].'</h1>';
                        }catch( PDOException $e){
                            echo'ERROR:'.$e->getMessage();
                        }
                    ?>
                    <h3>Abonnés</h3>
                </a>
            </div>
            <div class="vosAuteurs">
                <a href="Auteur.php" class="choixAccuril">
                    <?php
                        try{
                        // Ouverture de la connexion à la base de données.
                        $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                        // Paramètreage des erreurs et exceptions à la connexion. 
                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //Préparation de la requête de lecture des données dans la base de données.
                        $req=$maVariable->prepare("SELECT COUNT(*) as n FROM auteurlivre");
                        // Execution de la requête
                        $req->execute();
                        //Recupération des lignes de la base de données
                        $data=$req->fetchAll(PDO::FETCH_ASSOC);
                        //Nous parcourons les résultats de requêtes et nous les affichons ligne par ligne.

                        echo '<h1>'.$data[0]['n'].'</h1>';
                        }catch( PDOException $e){
                            echo'ERROR:'.$e->getMessage();
                        }
                    ?>
                    <h3>Auteurs</h3>
                </a>
            </div>
            <div class="vosLivres">
                <a href="Livre.php" class="choixAccuril">
                    <?php
                        try{
                        // Ouverture de la connexion à la base de données.
                        $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                        // Paramètreage des erreurs et exceptions à la connexion. 
                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //Préparation de la requête de lecture des données dans la base de données.
                        $req=$maVariable->prepare("SELECT COUNT(*) as n FROM livre");
                        // Execution de la requête
                        $req->execute();
                        //Recupération des lignes de la base de données
                        $data=$req->fetchAll(PDO::FETCH_ASSOC);
                        //Nous parcourons les résultats de requêtes et nous les affichons ligne par ligne.

                        echo '<h1>'.$data[0]['n'].'</h1>';
                        }catch( PDOException $e){
                            echo'ERROR:'.$e->getMessage();
                        }
                    ?>
                    <h3>Livres</h3>
                </a>
            </div>
            <div class="vosEmprunts">
                <a href="Emprunter.php" class="choixAccuril">
                <?php
                        try{
                        // Ouverture de la connexion à la base de données.
                        $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                        // Paramètreage des erreurs et exceptions à la connexion. 
                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //Préparation de la requête de lecture des données dans la base de données.
                        $req=$maVariable->prepare("SELECT COUNT(*) as n FROM emprunt WHERE DateRetour is NULL");
                        // Execution de la requête
                        $req->execute();
                        //Recupération des lignes de la base de données
                        $data=$req->fetchAll(PDO::FETCH_ASSOC);
                        //Nous parcourons les résultats de requêtes et nous les affichons ligne par ligne.

                        echo '<h1>'.$data[0]['n'].'</h1>';
                        }catch( PDOException $e){
                            echo'ERROR:'.$e->getMessage();
                        }
                    ?>
                    <h3>Empruntés</h3>
                </a>
            </div>
            <div class="vosRetour">
            <?php
                    try{
                        // Ouverture de la connexion à la base de données.
                        $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                        // Paramètreage des erreurs et exceptions à la connexion. 
                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //Préparation de la requête de lecture des données dans la base de données.
                        $req=$maVariable->prepare("SELECT COUNT(*) as n FROM emprunt WHERE DateRetour is not NULL");
                        // Execution de la requête
                        $req->execute();
                        //Recupération des lignes de la base de données
                        $data=$req->fetchAll(PDO::FETCH_ASSOC);
                        //Nous parcourons les résultats de requêtes et nous les affichons ligne par ligne.

                        echo '<h1>'.$data[0]['n'].'</h1>';
                        }catch( PDOException $e){
                            echo'ERROR:'.$e->getMessage();
                        }
                    ?>
                <h3>Retournés</h3>
            </div>
        </div>
    </div>
</body>
</html>