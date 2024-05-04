<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biemnvenue sur votre application de gestion de la bibliotheque</title>
    <link rel="stylesheet" href="indexStyle.css">
</head>
<body class="defilement">
    <div class="containere">
        <h3>APPLICATION DE GESTON D'UNE BIBLIOTHEQUE</h3>
            <form action="index.php" method ='post' class=""login-form>
                <div class="form-group">
                    <input type="text" name="identifiant" id="Identifiant" placeholder="Entrer votre identifiant" required autofocus="autofocus">
                </div>
                <div class="form-group">
                    <input type="password" name="motDePasse" id="MotDePasse" placeholder="Entrer votre mot de passe" required>
                </div>
                <input type="submit" name="seConnecter" value="Se Connecter">

                <?php
                    if (isset($_POST["seConnecter"])) {
                        $identifiant = $_POST["identifiant"];
                        $motDePasse = $_POST["motDePasse"];

                        try{
                            // Ouverture de la connexion à la base de données.
                            $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
                            // Paramètrage des erreurs et exceptions à la connexion. 
                            $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                            //Préparer de la requête de la lecture des données dans la base des données.
                            $req=$maVariable->prepare("SELECT * FROM identification;");
                            //Execution de la requête
                            $req->execute();

                            //Recupération des lignes de la table de la base de données
                            $data=$req->fetchAll(PDO::FETCH_ASSOC);
                            //Parcourir les résultats de la recherche et afficher ligne par ligne.
                            foreach($data as $row) {
                                if ($identifiant==$row['Identifiant'] && $motDePasse==$row['MotDePasse']) {
                                    header('location:Accueil.php');
                                    exit();
                                }
                                
                            }
                            echo "<p style=\"text-align: center;font-size:1.5em; marigin-left: 15px; color: red;\">Vos identifiants sont incorrect !</p>";
                        }catch( PDOException $e){
                            echo'ERROR:'.$e->getMessage();
                        }
                    }
        ?>

            </form>
    </div>
    
</body>
</html>