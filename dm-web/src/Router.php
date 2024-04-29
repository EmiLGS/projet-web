<?php
require_once('view/View.php');
require_once('controller/Controller.php');
session_start();

class Router {


/**
 * Lead the user to the wished url.
 *
 * Look the PATH_INFO request and lead the user where he wants with a controller function.
 * @param  ProgrammingLanguageStorageySQL
 *
 */

    public function main( $programmingLanguageStorage ){
        $view = new View($this, $_SESSION['feedback'] ?? []);
        $_SESSION["feedback"] = [];
        key_exists('PATH_INFO',$_SERVER) ? $request = explode('/',$_SERVER['PATH_INFO']) : $request = [];
        $controller = new Controller($view,$programmingLanguageStorage);
            if ( key_exists( 1, $request ) && $request[1] === "nouveau" )
            {
                $controller->showCRUD();
            }
            else if ( key_exists( 1,$request ) && $request[1] === "sauverNouveau" )
            {
                // $data will contains all value from post form //
                $data = [];
                if ( $_POST ) {
                    foreach ( $_POST as $key => $value ){
                        if ( $key === 'name' || $key === 'creator' || $key === 'creationDate' ){
                            $data[$key] = $value;
                        }
                    }
                }
                if ( $_FILES && key_exists( 'logo', $_FILES ) && $_FILES['logo']['error'] == 0 ){
                    $data['logo'] = $_FILES['logo'];
                }
                $controller->saveNewProgrammingLanguage($data);
            }
            else if ( key_exists(2,$request) && $request[2] === "supprimer" && $programmingLanguageStorage->read($request[1]) )
            {
                $controller->showDeletion($request[1]);
            }
            else if ( key_exists(2,$request) && $request[2] === "suppressionConfirmer" && $programmingLanguageStorage->read( $request[1] ) )
            {
                $controller->DeleteProgrammingLanguage($request[1]);
            }
            else if (key_exists(2,$request) && $request[2] === "modifier" && $programmingLanguageStorage->read($request[1]) )
            {
                $controller->ModifyProgrammingLanguage($request[1]);
            }
            else if (key_exists(2,$request) && $request[2] === "sauverModification" && $programmingLanguageStorage->read($request[1]) )
            {
                $data = [];
                if ( $_POST ) {
                    foreach ( $_POST as $key => $value ){
                        if ( $key === 'name' || $key === 'creator' || $key === 'creationDate' ){
                            $data[$key] = $value;
                        }
                    }
                }
                if ( $_FILES && key_exists( 'logo', $_FILES ) && $_FILES['logo']['error'] == 0 ){
                    $data['logo'] = $_FILES['logo'];
                }
                // if (key_exists('currentModifyLanguage',$_SESSION)){
                //     $language = $_SESSION['currentModifyLanguage']->getData();
                //     $data['name'] = $language->getName();
                //     $data['creator'] = $language->getCreator();
                //     $data['creationDate'] = $language->getCreationDate();
                //     if ( $_FILES && key_exists( 'logo', $_FILES ) && $_FILES['logo']['error'] == 0 ){
                //         $data['logo'] = $_FILES['logo'];
                //     }
                    $controller->saveModifyProgrammingLanguage($request[1],$data);
                // }
            }
            else if (key_exists(1,$request) && $request[1] === "list" )
            {
                $controller->showList();
            }
            else if ($request && $request[1] === 'about' )
            {
                $controller->showAbout();
            }
            else if ( key_exists(2,$request) && $request[2] === "afficher" )
            {
                $controller->showInformation($request[1]);
            }
            else 
            {
                $view->makeWelcomeProgrammingLanguagePage();
            }
            $view->render();
    }


/* ------------------ URL REDIRECTION ---------------------- */

/**
 * Redirect POST request to a GET REQUEST after action (primarily used by Displayer in Controller).
 *
 * @param String $url is the link where redirection need to be in GET action.
 * @param String $feedback is the success or error message send by the website after the POST action.
 *
 */


    function POSTredirect($url, $feedback,$code_error){
        $_SESSION["feedback"] = $feedback;
        header("Location: $url",true,$code_error);
    }


/**
 * Give the relative path to the welcome page.
 *
 * @return String url
 */


    public function getIndexURL(){
        return '/index.php';
    }


/**
 * Give the relative path to the about page.
 *
 * @return String url
 */


    public function getAboutURL(){
        return $this->getIndexURL() . "/about";
    }


/**
 * Give the relative path to the list page.
 *
 * @return String url
 */


    public function getListProgrammingLanguageURL(){
        return $this->getIndexURL() . "/list";
    }


/**
 * Give the relative path to the Programming Language page asked.
 * @param $id is the reference id to the Programming Language.
 * @return String url
 */


    public function getProgrammingLanguageURL($id){
        return $this->getIndexURL() ."/$id/afficher";
    }


/*-------------------------- CRUD ---------------------------------*/


/**
 * Give the relative path to the creation action page.
 *
 * @return String url
 */


    public function getProgrammingLanguageCreationURL(){
        return $this->getIndexURL() . "/nouveau";
    }


/**
 * Give the relative path to the verification creation action page.
 *
 * @return String url
 */


    public function getProgrammingLanguageSaveURL(){
        return $this->getIndexURL() . '/sauverNouveau';
    }


/**
 * Give the relative path to the delete action page.
 *
 * @return String url
 */


    public function getProgrammingLanguageAskDeletionURL($id){
        return $this->getIndexURL()  . "/$id/supprimer";
    }


/**
 * Give the relative path to the delete confirmation action page.
 *
 * @return String url
 */


    public function getProgrammingLanguageDeletionURL($id){
        return $this->getIndexURL() . "/$id/suppressionConfirmer";
    }


/**
 * Give the relative path to the edit action page.
 *
 * @return String url
 */


    public function getProgrammingLanguageModificationURL($id){
        return $this->getIndexURL() . "/$id/modifier";
    }


/**
 * Give the relative path to the edit verification action page.
 *
 * @return String url
 */


    public function getProgrammingLanguageSaveModificationURL($id){
        return $this->getIndexURL() . "/$id/sauverModification";
    }

}