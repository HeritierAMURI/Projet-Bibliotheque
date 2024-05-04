// Fichier de suppression
<?php 
    // Pour supprimer un abonné
    if (isset($_GET ['idAbonne'])) {
        $idAbonne =  $_GET ['idAbonne'];
        echo $idAbonne; 
        // Dans la table emprunt
        try {
            $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
            $req=$maVariable->prepare("DELETE FROM emprunt WHERE NumeroAbonne = $idAbonne;");
            $req->execute();
            header('location:abonne.php');
        } catch( PDOException $e){
            echo'ERROR:'.$e->getMessage();
        }  
        // Dans la table abonne
        try {
            $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
            $req=$maVariable->prepare("DELETE FROM abonne WHERE NumeroAbonne = $idAbonne;");
            $req->execute();
            header('location:abonne.php');
        } catch( PDOException $e){
            echo'ERROR:'.$e->getMessage();
        }    
    }
    // Pour supprimer un livre
    if (isset($_GET ['idLivre'])) {
        $idLivre =  $_GET ['idLivre'];
        echo $idLivre;
        //Dans la table auteurlivre
        try {
            $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
            $req=$maVariable->prepare("DELETE FROM auteurlivre WHERE NumeroLivre = $idLivre;");
            $req->execute();
            header('Location:livre.php');
        } catch( PDOException $e){
            echo'ERROR:'.$e->getMessage();
        }
        //Dans la table emprunt
        try {
            $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
            $req=$maVariable->prepare("DELETE FROM emprunt WHERE NumeroLivre = $idLivre;");
            $req->execute();
            header('Location:livre.php');
        } catch( PDOException $e){
            echo'ERROR:'.$e->getMessage();
        } 
        //Dans la table livre 
        try {
            $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
            $req=$maVariable->prepare("DELETE FROM livre WHERE NumeroLivre = $idLivre;");
            $req->execute();
            header('Location:livre.php');
        } catch( PDOException $e){
            echo'ERROR:'.$e->getMessage();
        }    
    }
    // Pour supprimer un auteur
    if (isset($_GET ['idAuteur'])) {
        $idAuteur =  $_GET ['idAuteur'];
        echo $idAuteur;  
        try {
            $maVariable=new PDO('mysql:host=localhost;dbname=projetbibliotheque',"root","");
            $req=$maVariable->prepare("DELETE FROM auteurlivre WHERE NumeroLivre = $idAuteur;");
            $req->execute();
            header('location:Auteur.php');
        } catch( PDOException $e){
            echo'ERROR:'.$e->getMessage();
        }    
    }
?>