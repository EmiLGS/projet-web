<?php
    $request = explode('/',$_SERVER['PATH_INFO']);
    if ( $request[1] === 'nouveau' ){
        $buttonText = "Créer";
        $redirect = $this->router->getProgrammingLanguageSaveURL();
    }
    else {
        $buttonText = "Modifier";
        $redirect = $this->router->getProgrammingLanguageSaveModificationURL($request[1]);
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/skin/dom.css">
        <link href="/skin/bootstrap.min.css" type="text/css" rel="stylesheet">
        <script src="/skin/bootstrap.bundle.min.js"></script>
        <title>Languages de programmation</title>
        <!--
            <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
            <script src="src/checker/check.js"></script>
        -->
    </head>
    <body>
        <?php include('layouts/navbar.php') ?>
        <h1> <?php $this->title ?> </h1>
        <div class="error-feedback">
            <h4>
                <?php
                    if (key_exists(0,$this->feedback)){
                        echo($this->feedback[0]);
                    }
                ?>
            </h4>
        </div>

        <form method="post" action="<?php echo $redirect?>" enctype="multipart/form-data">
            <div class="error-feedback">
                <h4>
                    <?php
                        if (key_exists(1,$this->feedback)){
                            echo($this->feedback[1]);
                        }
                    ?>
                </h4>
            </div>
            <div class="input-group mb-3">
                <label for="name" class="input-group-text">Langage de programmation  </label>
                <input type="text" name="name" class="form-control" value="<?php echo($this->name) ?>" id="name" required >
            </div>

            <div class="error-feedback">
                <h4>
                    <?php
                        if (key_exists(2,$this->feedback)){
                            echo($this->feedback[2]);
                        }
                    ?>
                </h4>
            </div>
            <div class="input-group mb-3">
                <label for="creator"class="input-group-text">Créateur  </label>
                <input type="text" name="creator" class="form-control" value="<?php echo($this->creator) ?>" id="creator" required >
            </div>

            <div class="error-feedback">
                <h4>
                    <?php
                        if (key_exists(3,$this->feedback)){
                            echo($this->feedback[3]);
                        }
                    ?>
                </h4>
            </div>

            <div class="input-group mb-3">
                <label for="creationDate" class="input-group-text">Date de mise en ligne  </label>
                <input type="number" name="creationDate" class="form-control" value="<?php echo($this->creationDate) ?>" id="creationDate" required min="1" >
            </div>

            <div class="error-feedback">
                <h4>
                    <?php
                        if (key_exists(4,$this->feedback)){
                            echo($this->feedback[4]);
                        }
                    ?>
                </h4>
            </div>

            <div class="input-group mb-3">
                <label for="logo" class="input-group-text"> Logo </label>
                <input type="file" name="logo" class="form-control input" required />
            </div>

            <button type="submit" class="btn btn-success crud"> <?php echo $buttonText ?></button>

        </form>
    </body>
</html>