<?php
/* CREATION D'UN AJAX POUR VÉRIFIER SI TOUS EST RESPECTÉ */
if (key_exists("name",$_POST) && key_exists("creator",$_POST) && key_exists("creationDate",$_POST)){
    if (str_replace(' ','',$_POST["name"]) === "" && str_replace(' ','',$_POST["creator"]) === "" && $_POST["creationDate"] < 1){
        http_response_code(500);
        echo("Veuillez renseigner les champs Nom et Createur et insérer un valeur positif pour la Date de création");
    }
    else if (str_replace(' ','',$_POST["name"]) === "" ){
        http_response_code(500);
        echo("Le nom du langage ne peut être vide");
    }
    else if (str_replace(' ','',$_POST["creator"]) === ""){
        http_response_code(500);
        echo("Le nom du createur ne peut être vide");
    }
    else if ($_POST["creationDate"] < 1){
        http_response_code(500);
        echo("L'année de création doit être positive");
    }
    else {
        $_SESSION["name"] = strip_tags($_POST["name"]);
        $_SESSION["creator"] = strip_tags($_POST["creator"]);
        $_SESSION["creationDate"] = strip_tags($_POST["creationDate"]);
        echo(json_encode("Création du langages"));
    }
}