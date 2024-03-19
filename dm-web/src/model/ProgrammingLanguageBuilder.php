<?php
require_once('ProgrammingLanguage.php');
class ProgrammingLanguageBuilder {
    private $data;
    private $error;


/**
 * Create a Programming Language Builder instance.
 * @param $name is the name of the language, $creator his creator, $creationDate his date of creation and $logo his representation.
 *
*/
    function __construct($data,$error = []){
        $this->data = $data;
        $this->error = $error;
    }

/**
 * Give access to the builder data's
 * @return Array
 *
*/
    function getData(){
        return $this->data;
    }
/**
 * Give access to the builder error's
 * @return Array
 *
*/
    function getError(){
        return $this->error;
    }

/**
 * Create a Programming Language with values in $this->data, Generate random name for the logo to avoid clone name and delete special character for basic string.
 * @return ProgrammingLanguage
 *
*/
    function createProgrammingLanguage(){
        $fileInfo = pathinfo($_FILES['logo']['name']);
        $extension = $fileInfo['extension'];
        $randName = $this->randString() . "." . $extension;
        move_uploaded_file($_FILES['logo']['tmp_name'], 'upload/' . $randName );
        return new ProgrammingLanguage( htmlspecialchars( $this->data['name'] ), htmlspecialchars( $this->data['creator'] ), htmlspecialchars( $this->data['creationDate'] ), $randName );
    }

/**
 * Check if all values are correct, non-empty string, positif Int, correct extension image and small image size. Else attribute to $this->error a code (key) and a description (value)
 * @return Boolean
 *
*/
    function isValid(){
        if (key_exists("name",$this->data) && key_exists("creator",$this->data) && key_exists("creationDate",$this->data) && key_exists('logo',$this->data)){
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
            $fileInfo = pathinfo($_FILES['logo']['name']);
            $extension = $fileInfo['extension'];
            if (str_replace(' ','',$this->data["name"]) === "" && str_replace(' ','',$this->data["creator"]) === "" && $this->data["creationDate"] < 1){
                $this->error[0] = "Veuillez renseigner les champs Nom et Createur et insérer un valeur positif pour la Date de création";
                return false;
            }
            else if ( str_replace(' ','',$this->data["name"]) === "" && str_replace(' ','',$this->data["creator"]) === "" ){
                $this->error[0] = "Le nom du langage et du createur ne peut être vide";
                return false;
            }
            else if (str_replace(' ','',$this->data["name"]) === "" ){
                $this->error[1] = "Le nom du langage ne peut être vide";
                return false;
            }
            else if (str_replace(' ','',$this->data["creator"]) === ""){
                $this->error[2] = "Le nom du createur ne peut être vide";
                return false;
            }
            else if ($this->data["creationDate"] < 1){
                $this->error[3] = "L'année de création doit être positive";
                return false;
            }
            else if ( !in_array( $extension, $allowedExtensions ) ){
                $this->error[4] = "Mauvais format d'image";
                return false;
            }
            else if ( $this->data['logo']['size']  > 500000 ){
                $this->error[4] = "Taille de l'image trop grande";
                return false;
            }
            else {
                return true;
            }
        }
        $this->error[0] = "Tous les champs ne sont pas remplis !";
        return false;
    }


    /**
     * Generate random name assign to logo to avoid dangerous name or vulgar name.
     *
     * @param $length size of the name, $charset list of character autorize.
     *
     * @return String randomize.
     */

    function randString($length=10, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'){
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
        return $str;
    }
}