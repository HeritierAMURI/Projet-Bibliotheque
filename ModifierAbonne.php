<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les données d'un abonné</title>
    <link rel="stylesheet" href="ModifierStyle.css">
</head>
<body>

    <div class="menu">
        <div class="Icone-Library">
                <a href="Accueil.php"> <img src="Images/Icone_Library.png" alt="icone de la bibliotheque"> </a>
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
                        <img src="Images/iconeLivre.png" alt="icone livre">
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
                        <img src="Images/iconeEmprunt.png" alt="icone emprunt">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Emprunter</h3>
                    </div>
                </div>
            </a>
            <a href="Retourner.php" class="enregistrement" >
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                        <img src="Images/iconeRetourner.png" alt="icone retourner">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Retourner</h3>
                    </div>
                </div>
            </a>
        </nav>
    </div>
    <?php   
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $idAbonne= isset($_GET['idAbonne']) ? $_GET['idAbonne'] : "";
            try{
                // Ouverture de la connexion à la base de données.
                $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                // Paramètrage des erreurs et exceptions à la connexion. 
                $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                //Préparation de la requête de lecture des données dans la base de données.
                $req=$maVariable->prepare("SELECT * FROM abonne WHERE NumeroAbonne=$idAbonne");
                //Executer la requête
                $req->execute();
                //Recupérer les lignes
                $data=$req->fetchAll(PDO::FETCH_ASSOC);
                }catch(PDOException $e){
                    echo " ".$e->getMessage();
                }
                //Parcourir les résultats de la recherche et afficher ligne par ligne.
                foreach($data as $row) {
                    echo '<div class="container">
                        <h3>Modifiez les données d\'un abonné</h3>
                        <form action="Modify.php" method="post">
                            <div class="form-group">
                                <label for="nomP">Nom de l\'abonné à modifier : </label>
                                <input type="text" id="nom"  name="nom" value="'.$row["Nom"].'">
                            </div>

                            <div class="form-group">
                                <label for="prenom">Prénom de l\'abonné à modifier : </label>
                                <input type="text" id="prenom" name="prenom" value="'.$row["Prenom"].'">
                            </div>

                            <div class="form-group">
                                <label for="Caution">Caution de l\'abonné à modifier : </label>
                                <input type="number" id="caution" name="caution" value="'.$row["Caution"].'">
                            </div><br>

                            <div class="form-group">
                            <label for="adresse">Adresse de l\'abonné à modifier : </label>
                            <input type="text" id="adresse" name="adresse" value="'.$row["Adresse"].'">
                            </div><br>
                            <div class="form-group" style="display: none">
                                <label for="numeroAbonne">Numero de l\'abonné à modifier : </label>
                                <input type="number" id ="numeroAbonne" name="numeroAbonne" value="'.$row["NumeroAbonne"].'">
                            </div><br>
                            <button type="submit" class="button" name="modifier">Modifier</button>
                        </form>
                    </div>';
                    }
           
        }  
        ?>    
</body>
</html>