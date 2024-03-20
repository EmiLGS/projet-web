<?php
/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
echo "Hello World !";
set_include_path("./src");

/* Inclusion des classes utilisées dans ce fichier */

/*------------------ METTRE SA BDD ---------------*/
require_once('../mysql_config.php');
/*----------------- METTE SA BDD ----------------------*/
require_once("Router.php");
require_once("model/ProgrammingLanguageStorageMySQL.php");

/*
* Cette page est simplement le point d'arrivée de l'internaute
* sur notre site. On se contente de créer un routeur
* et de lancer son main.
*/

try {
    $pdo = new PDO("mysql:dbname=" . MYSQL_DB .";host=" . MYSQL_HOST . ":" . MYSQL_PORT, MYSQL_USER, MYSQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die($e->getMessage());
}
$programmingLanguageStorage = new ProgrammingLanguageStorageMySQL($pdo);
$router = new Router();
$router->main($programmingLanguageStorage);
?>