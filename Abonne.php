<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des abonnés de la bibliothèque</title>
    <link rel="stylesheet" href="AbonneStyle.css">
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
    <div class="contenuDroite">
        <h1 class="titreAbonne">Liste des abonnés</h1>
        <table class="tableAbonne">
            <thead>
                <th>N°</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Caution</th>
                <th>Adresse</th>
                <th class="action">Actions</th>  
            </thead>
            
            <tbody>
                <tr class="ligne-form">
                    <td class="auto">Auto</td>
                    <form action="Abonne.php"  method="post">
                        <td class="td-form">
                            <div class="info"> <input type="text" name="nom" required="required" placeholder="Entrez le nom de l'abonné"></div>
                        </td>
                        <td class="td-form">
                            <div class="info"> <input type="text" name="prenom" required="required" placeholder="Entrez le prénom de l'abonné"></div>
                        </td>
                        <td class="td-form">
                            <div class="info"><input type="number" name="caution" required="required" placeholder="Entrez la caution de l'abonné"></div> 
                        </td>
                        <td class="td-form">
                            <div class="info"> <input type="text" name="adresse" required="required" placeholder="Entrez l'adresse"></div>
                        </td>
                        <td class="td-form">
                                <div class="enregistrer"><button name="enregistrer">Enregistrer</button></div>
                        </td>
                    </form>
                
                    <?php
                        if (isset($_POST["enregistrer"])){
                            $nom = htmlentities($_POST["nom"]);
                            $prenom = htmlentities($_POST["prenom"]);
                            $caution = htmlentities($_POST["caution"]);
                            $adresse = htmlentities($_POST["adresse"]);
                            try{
                                // Ouverture de la connexion à la base de données.
                               $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                               // Paramètrage des erreurs et exceptions à la connexion. 
                                $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                                //Préparation de la requête de lecture des données dans la base des données.
                                $req=$maVariable->prepare("INSERT INTO abonne(Nom, Prenom, Caution, Adresse)
                                VALUES(:Nom, :Prenom, :Caution, :Adresse)");
                               //Execution de la requête
                                $req->execute([
                                ':Nom'=> $nom,
                                ':Prenom' => $prenom,
                                ':Caution' => $caution,
                                ':Adresse' => $adresse
                                ]);
                                // header('location:Abonne.php');
                            }catch( PDOException $e){
                                     echo'ERROR:'.$e->getMessage();
                            }
                        }
                    ?>

                    <?php
                        try{
                        // Ouverture de la connexion à la base de données.
                        $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                        // Paramètreage des erreurs et exceptions à la connexion. 
                        $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //Préparation de la requête de lecture des données dans la base de données.
                        $req=$maVariable->prepare("SELECT * FROM abonne ORDER BY Nom ASC");
                        // Execution de la requête
                        $req->execute();
                        //Recupération des lignes de la base de données
                        $data=$req->fetchAll(PDO::FETCH_ASSOC);
                        //Nous parcourons les résultats de requêtes et nous les affichons ligne par ligne.
                        foreach($data as $row) {
                            $numeroAbonne = $row['NumeroAbonne'];
                            echo '<tr>
                            <td class="nonCentrer">'.$row['NumeroAbonne'] .'</td>
                            <td class="nonCentrer">'.$row['Nom'] .'</td>
                            <td class="nonCentrer">'.$row['Prenom'] .'</td>
                            <td class="centrer">'.$row['Caution'].'</td>
                            <td class="centrer">'.$row['Adresse'].'</td>
                            <td class="nonCentrer action">
                                <a href="supprimer.php?idAbonne='.$numeroAbonne.'"><img src="./Images/delete.png" alt="Icone delete"></a>
                                <a href="ModifierAbonne.php?idAbonne='.$numeroAbonne.'"><img src="./Images/modify.png" alt="Icone modifier" style="width: 25px; height: 25px; padding-top: 1px;"></a>
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
</body>
</html>