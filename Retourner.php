<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retourner un livre dans la bibliothèque</title>
    <link rel="stylesheet" href="styleFormListe.css">
</head>
<body class="defilement">
    <div class="menu">
        <div class="Icone-Library">
                <a href="Accueil.php"> <img src="Images/Icone_Library.png" alt="icone de la bibliotheque"> </a>
            </div>
        <nav> 
            <h2>Enregistrement</h2>
            <a href="Abonne.php">
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                        <img src="Images/iconeAbonne.png" alt="Icone abonné">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Abonné</h3>
                    </div>
                  </div>
            </a>
            <a href="Auteur.php" class="enregistrement" >
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                         <img src="Images/iconeAuteur.png" alt="Icone auteur">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Auteur</h3>
                    </div>
                </div>
            </a>
            <a href="Livre.php" class="enregistrement">
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                        <img src="Images/iconeLivre.png" alt="Icone livre">
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
                        <img src="Images/iconeEmprunt.png" alt="Icone emprunter">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Emprunter</h3>
                    </div>
                </div>
            </a>
            <a href="Retourner.php" class="enregistrement" >
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                        <img src="Images/iconeRetourner.png" alt="Icone retourner">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Retourner</h3>
                    </div>
                </div>
            </a>
        </nav>
    </div>
    
    <div class="contenuAuteur formulaireRetourner">
        <div class="formulaire">
            <h1>Retourner un livre</h1>
            <form action="Retourner.php" method="post">
                <select name="numeroAbonne" style="padding: 10px; border: 1px solid rgb(225, 225, 225); margin-bottom: 5%;display: block; width: 99%;">
                    <option>Choisissez l'abonné</option>
                    <?php
                        try{
                            // Ouverture de la connexion à la base de données.
                            $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                            // Paramètrage des erreurs et exceptions à la connexion. 
                            $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                            //Préparation de la requête de lecture des données dans la base de données.
                            $req=$maVariable->prepare("SELECT * FROM abonne ORDER BY Nom ASC");
                            $req=$maVariable->prepare("SELECT emprunt.NumeroAbonne, emprunt.DateRetour, abonne.Nom, abonne.NumeroAbonne, abonne.Nom FROM emprunt JOIN abonne ON emprunt.NumeroAbonne=abonne.NumeroAbonne WHERE emprunt.DateRetour is NULL  ORDER BY abonne.Nom ASC");
                            //Executer la requête
                            $req->execute();
                            //Recupérer les lignes
                            $data=$req->fetchAll(PDO::FETCH_ASSOC);
                            //Parcourir les résultats de la recherche et afficher ligne par ligne.
                            foreach($data as $row) {
                                echo '<option value="'.$row["NumeroAbonne"].'">'.$row["Nom"].' '.$row["Prenom"].'</option>';
                            }
                        }catch(PDOException $e){
                            echo " ".$e->getMessage();
                        }
                    ?>
                </select>
                <select name="numeroLivre" style="padding: 10px; border: 1px solid rgb(225, 225, 225); margin-bottom: 5%;display: block; width: 99%;">
                    <option>Choisisssez le livre</option>
                    <?php
                        try{
                            // Ouverture de la connexion à la base de données.
                            $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                            // Paramètrage des erreurs et exceptions à la connexion. 
                            $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                            //Préparation de la requête de lecture des données dans la base de données.
                            $req=$maVariable->prepare("SELECT * FROM livre WHERE Etat='Emprunté' ORDER BY Titre ASC");
                            //Executer la requête
                            $req->execute();
                            //Recupérer les lignes
                            $data=$req->fetchAll(PDO::FETCH_ASSOC);
                            //Parcourir les résultats de la recherche et afficher ligne par ligne.
                            foreach($data as $row) {
                                echo '<option value="'.$row["NumeroLivre"].'">'.$row["Titre"].'</option>';
                            }
                        }catch(PDOException $e){
                                    echo " ".$e->getMessage();
                        }
                    ?>
                </select>
                <input type="submit" name="retourner" value="Retourner">
            </form>
            <?php
                if (isset($_POST["retourner"])){
                    $numeroAbonne = $_POST["numeroAbonne"];
                    $numeroLivre = $_POST["numeroLivre"];
                    try{
                        // Ouverture de la connexion à la base de données.
                       $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                       // Paramètrage des erreurs et exceptions à la connexion. 
                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //Préparation de la requête de lecture des données dans la base des données.
                        $req=$maVariable->prepare("UPDATE  emprunt SET DateRetour = CURRENT_DATE() WHERE NumeroAbonne= :numeroAbonne");
                        //Execution de la requête
                        $req->execute([
                            ':numeroAbonne'=> $numeroAbonne
                            ]);
                    }catch( PDOException $e){
                         echo'ERROR:'.$e->getMessage();
                    }
                    try{
                        // Ouverture de la connexion à la base de données.
                       $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                       // Paramètrage des erreurs et exceptions à la connexion. 
                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //Préparation de la requête de lecture des données dans la base des données.
                        $req=$maVariable->prepare("UPDATE livre SET Etat='Disponible' WHERE NumeroLivre= :numeroLivre;");
                        //Execution de la requête
                        $req->execute([':numeroLivre' => $numeroLivre]);
                    }catch( PDOException $e){
                         echo'ERROR:'.$e->getMessage();
                    }
                }
            ?>
        </div>
    </div>

</body>
</html>