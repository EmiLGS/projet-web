<?php
require_once("model/ProgrammingLanguageBuilder.php");
class Controller {
    private View $view;
    private  ProgrammingLanguageStorageMySQL $storage;

/**
 * Construct a controller.
 *
 * @param View $view
 * @param ProgrammingLanguageStorageMySQL $storage
 *
 */
// Remttre StorageSQL Quand ça fonctionnera
    function __construct(View $view,ProgrammingLanguageStorageMySQL $storage){
        $this->view = $view;
        $this->storage = $storage;
    }


/*----------------- BASIQUE CONTROLLER SHOW FUNCTION ------------------------*/


/**
 * Check if the Programming Language exists and send request to create the view else send request to create unknown site page view.
 *
 * @param $id the id of the programming Language asked to show.
 */
    public function showInformation($id) {
        if($this->storage->read($id)){
            $this->view->makeProgrammingLanguagePage($this->storage->read($id));
        }
        else {
            $this->view->makeUnknownProgrammingLanguagePage();
        }
    }
/**
 * Send request to create about view page.
 */
    public function showAbout(){
        $this->view->makeAboutPage();
    }

/**
 * Send request to create list view page.
 */
    public function showList(){
        $this->view->makeListPage($this->storage->readAll());
    }

/**
 * Send request to create create or modify view page.
 */

    public function showCRUD(){
        $this->view->makeProgrammingLanguageCreationPage($this->NewProgrammingLanguage());
    }


/*------------------ CONTROLLER ACTION FUNCTION -----------------------*/

/**
 * Send request to create the confirmation delete view page.
 *
 * @param $id the id of the programming Language asked to Delete.
 */


public function showDeletion($id){
        $this->view->makeProgrammingLanguageDeletionPage($id);
    }


/**
 * Instantiates a new Builder or gives the actual Language Builder already created, saved in $_SESSION.
 * 
 * @return ProgrammingLanguageBuilder
*/

    public function NewProgrammingLanguage(){
        if (key_exists('currentNewLanguage',$_SESSION)){
            return $_SESSION['currentNewLanguage'];
        }
        else if(key_exists('currentModifyLanguage',$_SESSION)){
            return $_SESSION['currentModifyLanguage'];
        }
        else{
            return new ProgrammingLanguageBuilder([]);
        }
    }


/**
 * Create and save the new Programming Language if values from POST form are Valid else go back to the Creation Page with the Failure.
 *
 * @param Array $data contains values to create a new Programming Language
 *
*/

    public function saveNewProgrammingLanguage($data){
        $builder = new ProgrammingLanguageBuilder($data);
        unset($_SESSION['currentNewLanguage']);
        if ( $builder->isValid()){
            $newProgrammingLanguage = $builder->createProgrammingLanguage();
            $id = $this->storage->create($newProgrammingLanguage);
            $this->view->displayProgrammingLanguageCreationSuccess($id);
        }
        else {
            $_SESSION['currentNewLanguage'] = $builder;
            $this->view->displayProgrammingLanguageCreationFailure();
        }
    }


/**
 * Delete the language thanks to the id given and create deletion success view.
 *
 * @param $id refere to the programming language to delete.
 */

    public function DeleteProgrammingLanguage($id){
        $language = $this->storage->read($id);
        $this->storage->delete($id);
        $this->view->displayProgrammingLanguageDeletionSuccess($language->getName());
    }


/**
 * Find the language to modify and create the view with form to modify it.
 *
 * @param $id refere to the programming language to modify.
 */

    public function ModifyProgrammingLanguage($id){
        if ( !key_exists( 'currentModifyLanguage', $_SESSION ) ){
            $language = $this->storage->read($id);
            $_SESSION['currentModifyLanguage'] = new ProgrammingLanguageBuilder($language);
        }
        $this->view->makeProgrammingLanguageModificationPage();
    }


/**
 * Create a new Programming Language from the original Programming Language and save in place of the last one. Create a Success view if is valid
 * else go back to the form with the error.
 *
 * @param $id refere to the programming language modified to save.
 * @param Array $data contains values to modify a new Programming Language
 */

    public function saveModifyProgrammingLanguage($id,$data){
        unset( $_SESSION['currentModifyLanguage'] );
        $builder = new ProgrammingLanguageBuilder( $data );
        if ( $builder->isValid()){
            $newProgrammingLanguage = $builder->createProgrammingLanguage();
            $this->storage->update($id,$newProgrammingLanguage);
            $this->view->displayProgrammingLanguageModificationSuccess($newProgrammingLanguage->getName());
        }
        else {
            $_SESSION['currentModifyLanguage'] = $builder;
            $this->view->displayProgrammingLanguageModificationFailure($id);
        }
    }
}