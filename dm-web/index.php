<?php
/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
set_include_path("./src");

/* Inclusion des classes utilisées dans ce fichier */

/*------------------ METTRE SA BDD ---------------*/
# Définir le mot de passe root pour MySQL
// const MYSQL_ROOT_PASSWORD="root";

# Créer la base de données et l'utilisateur
const MYSQL_DATABASE="database";
const MYSQL_USER="root";
const MYSQL_PASSWORD="root";
const MYSQL_HOST = "172.17.0.2";
/*----------------- METTE SA BDD ----------------------*/
require_once("Router.php");
require_once("model/ProgrammingLanguageStorageMySQL.php");

/*
* Cette page est simplement le point d'arrivée de l'internaute
* sur notre site. On se contente de créer un routeur
* et de lancer son main.
*/

try {
    $pdo = new PDO("mysql:dbname=" . MYSQL_DATABASE .";host=" . MYSQL_HOST . ":" . "3306", MYSQL_USER, MYSQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die($e->getMessage());
}
$programmingLanguageStorage = new ProgrammingLanguageStorageMySQL($pdo);
$router = new Router();
$router->main($programmingLanguageStorage);
?>