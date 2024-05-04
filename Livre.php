<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des livres</title>
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
                         <img src="Images/iconeAuteur.png" alt="Auteur icone">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Auteur</h3>
                    </div>
                </div>
            </a>
            <a href="Livre.php" class="enregistrement">
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                        <img src="Images/iconeLivre.png" alt="Livre icone">
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
                        <img src="Images/iconeEmprunt.png" alt="Emprunter icone">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Emprunter</h3>
                    </div>
                </div>
            </a>
            <a href="Retourner.php" class="enregistrement" >
                <div class="actionMenu">
                    <div class="iconeActionMenu">
                        <img src="Images/iconeRetourner.png" alt="Retourner icone">
                    </div>
                    <div class="labelActionMenu">
                        <h3>Retourner</h3>
                    </div>
                </div>
            </a>
        </nav>
    </div>
    <div class="contenuDroite">
        <h1 class="titreLivre">Liste des livres</h1>
        <table class="tableLivre">
            <thead>
                <th>N°</th>
                <th>Titre</th>
                <th>Centre</th>
                <th>Editeur</th>
                <th>Etat</th>
                <th>Date d'achat</th>
                <th>Action</th>  
            </thead>
            
            <tbody>
                <tr class="ligne-form">
                    <td class="auto">Auto</td>
                    <form action="Livre.php"  method="post">
                        <td class="td-form">
                            <div class="info"> <input type="text" name="titre" required="reauired" placeholder="Entrez le titre du livre"></div>
                        </td>
                        <td class="td-form">
                            <div class="info"> <input type="number" name="centre" required="required" placeholder="Entrez le centre du livre"></div>
                        </td>
                        <td class="td-form">
                            <div class="info"><input type="text" name="editeur" required="required" placeholder="Entrez l'éditeur"></div> 
                        </td>
                        <td class="td-form">
                            <div class="etatLivre">
                                <select name="etat">
                                <option value="Disponible">Disponible</option>
                                <option value="Emprunté">Emprunté</option>
                            </select>
                            </div>
                        </td>
                        <td class="td-form">
                            <div class="dateLivre"> <input type="date" name="dateAchat" required="required" placeholder="Entrez la date"></div>
                        </td>
                        <td class="td-form">
                                <div class="enregistrer"><button name="enregistrer">Enregistrer</button></div>
                        </td>
                    </form>

                    <?php
                        if (isset($_POST["enregistrer"])){
                            $titre = htmlentities($_POST["titre"]);
                            $centre = htmlentities($_POST["centre"]);
                            $editeur = htmlentities($_POST["editeur"]);
                            $etat = htmlentities($_POST["etat"]);
                            $dateAchat = htmlentities($_POST["dateAchat"]);
                            try{
                                // Ouverture de la connexion à la base de données.
                               $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                               // Paramètrage des erreurs et exceptions à la connexion. 
                                $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                                //Préparation de la requête de lecture des données dans la base des données.
                                $req=$maVariable->prepare("INSERT INTO livre(Titre, Centre, Editeur, Etat, DateAchat)
                                VALUES(:titre, :centre, :editeur, :etat, :dateAchat)");
                               //Execution de la requête
                                $req->execute([
                                ':titre'=> $titre,
                                ':centre' => $centre,
                                ':editeur' => $editeur,
                                ':etat' => $etat,
                                ':dateAchat' => $dateAchat
                                ]);
                                // header('location:Livre.php');
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
                        $req=$maVariable->prepare("SELECT * FROM livre ORDER BY Titre ASC");
                        // Execution de la requête
                        $req->execute();
                        //Recupération des lignes de la base de données
                        $data=$req->fetchAll(PDO::FETCH_ASSOC);
                        //Nous parcourons les résultats de requêtes et nous les affichons ligne par ligne.
                        foreach($data as $row) {
                            $numeroLivre = $row['NumeroLivre'];
                            echo '<tr>
                            <td class="nonCentrer">'.$row['NumeroLivre'] .'</td>
                            <td class="nonCentrer">'.$row['Titre'] .'</td>
                            <td class="nonCentrer">'.$row['Centre'] .'</td>
                            <td class="nonCentrer">'.$row['Editeur'] .'</td>
                            <td class="centrer">'.$row['Etat'].'</td>
                            <td class="centrer">'.$row['DateAchat'].'</td>
                            <td class="nonCentrer action">
                                <a href="supprimer.php?idLivre='.$numeroLivre.'"><img src="./Images/delete.png" alt="Icone delete"></a>
                                <a href="ModifierLivre.php?idLivre='.$numeroLivre.'"><img src="./Images/modify.png" alt="Icone modifier" style="width: 25px; height: 25px; padding-top: 1px;"></a>
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