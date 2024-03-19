<?php
    key_exists('PATH_INFO',$_SERVER) ? $request = explode('/',$_SERVER['PATH_INFO']) : $request = [];
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/project/dm-web/skin/dom.css">
        <link href="/project/dm-web/skin/bootstrap.min.css" type="text/css" rel="stylesheet">
        <script src="/project/dm-web/skin/bootstrap.bundle.min.js"></script>
        <title>Languages de programmations</title>
    </head>
    <body>
        <?php
            include('layouts/navbar.php');
        ?>
        <div class="box-feedback">
            <h3 class="feedback"> <?php echo $this->feedback[0] ?? "" ?></h3>
        </div>
        <h1> <?php echo $this->title ?> </h1>
        <div class="center">
            <p class="lead"> <?php echo $this->content ?></p>
        </div>
        <ul class="list-group list-group-flush">
            <?php
            if (key_exists(1,$request) && $request[1] === "list") {
                if (!empty($this->programmingLanguages)) {
                    foreach ($this->programmingLanguages as  $key => $programmingLanguage) {
                        echo('<li class="list-group-item-md">' . '<a class="link-list" href="' . $this->router->getProgrammingLanguageURL($key) . '"><h3>' . $programmingLanguage->getName() . '</h3></a> <img class="logo-list" src="/project/dm-web/upload/' . $programmingLanguage->getLogo() . '"/> </li>');
                    }
                }
                else {
                    echo "<h3> Il n'existe aucun langage de créé </h3>";
                }
            }
            ?>
        </ul>
        <div class="action">
        <?php
        /* DELETE AND EDIT BOUTON */
        if ($this->seeableCRUDButton) {
            echo '<a class="btn btn-danger" href="' . $this->router->getProgrammingLanguageAskDeletionURL($request[1]) . '">Supprimer</a>';
        }
        if ($this->seeableCRUDButton) {
            echo '<a class="btn btn-warning" href="' . $this->router->getProgrammingLanguageModificationURL($request[1]) . '">Modifier</a>';
        }
        /* YES NO BUTTON */
        if (key_exists(2, $request)) {
            if ($request[2] && $request[2] === "supprimer") {
                echo '<a class="btn btn-danger" href="' . $this->router->getProgrammingLanguageDeletionURL($request[1]) . '">Oui</a>';
            }
            if ($request[2] && $request[2] === "supprimer") {
                echo '<a class="btn btn-success" href="' . $this->router->getProgrammingLanguageURL($request[1]) . '">Non</a>';
            }
        }
        ?>
        </div>
    </body>
</html>