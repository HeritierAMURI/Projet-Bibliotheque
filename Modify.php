
<?php 
    $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
    // Paramètrage des erreurs et exceptions à la connexion. 
    $maVariable->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    if (isset($_POST["modifier"])) {                     
        $nom = htmlentities($_POST["nom"]);
        $prenom = htmlentities($_POST["prenom"]);
        $caution = htmlentities($_POST["caution"]);
        $adresse = htmlentities($_POST["adresse"]);
        $numeroAbonne = htmlentities($_POST["numeroAbonne"]);

        $maj=$maVariable->prepare("UPDATE abonne SET Nom=:nom, Prenom=:prenom, Caution=:caution, Adresse=:adresse WHERE NumeroAbonne=:numeroAbonne");
        $execution =  $maj->execute([
        "nom"=> $nom,
        "prenom"=> $prenom,
        "caution"=> $caution,
        "adresse"=> $adresse,
        "numeroAbonne"=> $numeroAbonne
        ]);
        if ($execution) {
            header('Location:Abonne.php');
        }
    }

    if (isset($_POST["modifierLivre"])) {                     
        $titre = htmlentities($_POST["titre"]);
        $centre = htmlentities($_POST["centre"]);
        $editeur = htmlentities($_POST["editeur"]);
        $etat = htmlentities($_POST["etat"]);
        $dateAchat = htmlentities($_POST["dateAchat"]);
        $numeroLivre = htmlentities($_POST["numeroLivre"]);

        $maj=$maVariable->prepare("UPDATE livre SET Titre=:titre, Centre=:centre, Editeur=:editeur, Etat=:etat, DateAchat=:dateAchat, NumeroLivre=:numeroLivre WHERE NumeroLivre=:numeroLivre");
        $traitement =  $maj->execute([
        "titre"=> $titre,
        "centre"=> $centre,
        "editeur"=> $editeur,
        "etat"=> $etat,
        "dateAchat"=> $dateAchat,
        "numeroLivre"=> $numeroLivre
        ]);
        if ($traitement) {
            header('Location:Livre.php');
        }
    }
?>