<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les auteurs de livres de la bibliothèque</title>
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
                        <img src="Images/iconeAbonne.png" alt="icone abonné">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Abonné</h3>
                    </div>
                  </div>
            </a>
            <a href="Auteur.php" class="enregistrement" >
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                         <img src="Images/iconeAuteur.png" alt="icone auteur">
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
    
    <div class="contenuAuteur">
        <div class="formulaire">
            <h1>Ajoutez un auteur</h1>
            <form action="Auteur.php" method="post">
                <select name="numeroLivre" style="padding: 10px; border: 1px solid rgb(225, 225, 225); margin-bottom: 5%;display: block; width: 99%;">
                    <option>Numéro du livre</option>
                    <?php
                        try{
                            // Ouverture de la connexion à la base de données.
                            $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                            // Paramètrage des erreurs et exceptions à la connexion. 
                            $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                            //Préparation de la requête de lecture des données dans la base de données.
                            $req=$maVariable->prepare("SELECT * FROM livre ORDER BY Titre ASC");
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
                    <input type="text" name="nomAuteur" placeholder="Entrez le nom de l'auteur">
                    <input type="submit" name="ajouter" value="Ajouter">
            </form>
            <?php
                if (isset($_POST["ajouter"])){
                    $numeroLivre = htmlentities($_POST["numeroLivre"]);
                    $nomAuteur = htmlentities($_POST["nomAuteur"]);
                    try{
                        // Ouverture de la connexion à la base de données.
                       $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                        // Paramètrage des erreurs et exceptions à la connexion. 
                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //Préparation de la requête de lecture des données dans la base des données.
                        $req=$maVariable->prepare("INSERT INTO auteurlivre(NumeroLivre, Auteur)
                        VALUES(:numeroLivre, :nomAuteur)");
                        //Execution de la requête
                         $req->execute([
                            ':numeroLivre'=> $numeroLivre,
                            ':nomAuteur' => $nomAuteur
                            ]);
                       // header('Location:Auteur.php');
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
                    <th class="numero">N°</th>
                    <th class="nom">Nom</th>
                    <th class="oeuvre">Oeuvre</th>
                    <th class="action">Action</th>
                </thead>
                <tbody>
                    <?php
                        try{
                        // Ouverture de la connexion à la base de données.
                        $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                        // Paramètreage des erreurs et exceptions à la connexion. 
                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //Préparation de la requête de lecture des données dans la base de données.
                        $req=$maVariable->prepare("SELECT auteurlivre.IdAuteur, auteurlivre.Auteur, auteurlivre.NumeroLivre, livre.Titre FROM auteurlivre JOIN livre ON auteurlivre.NumeroLivre=livre.NumeroLivre ORDER BY Auteur ASC");
                        // Execution de la requête
                        $req->execute();
                        //Recupération des lignes de la base de données
                        $data=$req->fetchAll(PDO::FETCH_ASSOC);
                        //Nous parcourons les résultats de requêtes et nous les affichons ligne par ligne.
                        foreach($data as $row) {
                            $numeroAuteur = $row['NumeroLivre'];
                            echo '<tr>
                                <td class="nonCentrer">'.$row['IdAuteur'] .'</td>
                                <td class="nonCentrer">'.$row['Auteur'] .'</td>
                                <td class="nonCentrer">'.$row['Titre'] .'</td>
                                <td class="nonCentrer action">
                                    <a href="supprimer.php?idAuteur='.$numeroAuteur.'"><img src="./Images/delete.png" alt="Icone delete"></a>
                                </td>
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