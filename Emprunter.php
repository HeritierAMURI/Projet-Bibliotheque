<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunter un livre de la bibliothèque</title>
    <link rel="stylesheet" href="styleFormListe.css">
</head>
<body class="defilement">
    <div class="menu">
        <div class="Icone-Library">
                <a href="Accueil.php"> <img src="Images/Icone_Library.png" alt="icone de la bibliotheaue"> </a>
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
                        <img src="Images/iconeEmprunt.png" alt="Icone Emprunter">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Emprunter</h3>
                    </div>
                </div>
            </a>
            <a href="Retourner.php" class="enregistrement" >
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                        <img src="Images/iconeRetourner.png" alt="Icone Retourner">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Retourner</h3>
                    </div>
                </div>
            </a>
        </nav>
    </div>
    
    <div class="contenuAuteur">
        <div class="formulaire">
            <h1>Emprunter un livre</h1>
            <form action="Emprunter.php" method="post">
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
                    <option>Choisissez le livre</option>
                    <?php
                        try{
                            // Ouverture de la connexion à la base de données.
                            $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                            // Paramètrage des erreurs et exceptions à la connexion. 
                            $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                            //Préparation de la requête de lecture des données dans la base de données.
                            $req=$maVariable->prepare("SELECT * FROM livre WHERE Etat='Disponible' ORDER BY Titre ASC");
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
                <!-- <input type="date" name="dateEmprunt" placeholder="Entrez la date d'emprunt"> -->
                <input type="submit" name="emprunter" value="Emprunter">
            </form>
            <?php
                if (isset($_POST["emprunter"])){
                    $numeroAbonne = $_POST["numeroAbonne"];
                    $numeroLivre = $_POST["numeroLivre"];
                    // $dateEmprunt = $_POST["dateEmprunt"];
                    try{
                        // Ouverture de la connexion à la base de données.
                       $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                       // Paramètrage des erreurs et exceptions à la connexion. 
                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //Préparation de la requête de lecture des données dans la base des données.
                        $req=$maVariable->prepare("INSERT INTO emprunt(NumeroAbonne, NumeroLivre, DateEmprunt)
                        VALUES(:numeroAbonne, :numeroLivre, CURRENT_DATE())");
                        //Execution de la requête
                        $req->execute([
                            ':numeroAbonne'=> $numeroAbonne,
                            ':numeroLivre' => $numeroLivre
                            ]);
                            // header('location:Abonne.php');
                    }catch( PDOException $e){
                         echo'ERROR:'.$e->getMessage();
                    }
                    try{
                        // Ouverture de la connexion à la base de données.
                       $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                       // Paramètrage des erreurs et exceptions à la connexion. 
                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //Préparation de la requête de lecture des données dans la base des données.
                        $req=$maVariable->prepare("UPDATE livre SET Etat='Emprunté' WHERE NumeroLivre= :numeroLivre;");
                        //Execution de la requête
                        $req->execute([':numeroLivre' => $numeroLivre]);
                            // header('location:Abonne.php');
                            header('Location:Emprunter.php');
                    }catch( PDOException $e){
                         echo'ERROR:'.$e->getMessage();
                    }
                }
            ?>
        </div>
        <div class="tableau">
            <h1>Liste des auteurs</h1>
            <table>
                <thead>
                    <th class="numero">N°Ab</th>
                    <th class="nom">Nom</th>
                    <th class="oeuvre">Date d'emprunt</th>
                    <th class="action">Date de retour</th>
                </thead>
                <tbody>
                    <?php
                        try{
                            // Ouverture de la connexion à la base de données.
                            $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                            // Paramètreage des erreurs et exceptions à la connexion. 
                            $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                            //Préparation de la requête de lecture des données dans la base de données.
                            $req=$maVariable->prepare("SELECT emprunt.DateEmprunt, emprunt.DateRetour, abonne.NumeroAbonne, abonne.Nom FROM emprunt JOIN abonne ON emprunt.NumeroAbonne=abonne.NumeroAbonne ORDER BY abonne.Nom ASC");
                            // Execution de la requête
                            $req->execute();
                            //Recupération des lignes de la base de données
                            $data=$req->fetchAll(PDO::FETCH_ASSOC);
                            //Nous parcourons les résultats de requêtes et nous les affichons ligne par ligne.
                            foreach($data as $row) {
                                echo '<tr>
                                    <td class="nonCentrer">'.$row['NumeroAbonne'] .'</td>
                                    <td class="nonCentrer">'.$row['Nom'] .'</td>
                                    <td class="nonCentrer">'.$row['DateEmprunt'] .'</td>
                                    <td class="nonCentrer">'.$row['DateRetour'] .'</td>
                                    </tr>';
                                }
                            
                            }catch( PDOException $e){
                                    echo'ERROR:'.$e->getMessage();
                            }
                        ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>