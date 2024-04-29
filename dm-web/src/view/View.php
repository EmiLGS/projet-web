<?php
class View{
    private $squelette;
    private $router;
    private $feedback;
    private $content;
    private $programmingLanguages;
    private $name;
    private $creator;
    private $creationDate;
    private $menu;
    private $seeableCRUDButton=false;
    // Attribute from programming language
    private $title;

    /**
     * Create a View instance initialize link to the navbar.
     * 
     * @param Router $router
     * @param Array $feedback
     * 
     */
    public function __construct(Router $router, $feedback) {
        $this->router = $router;
        $this->menu = [
            'home' => $this->router->getIndexURL(),
            'list' => $this->router->getListProgrammingLanguageURL(),
            'create' => $this->router->getProgrammingLanguageCreationURL(),
            'about' => $this->router->getAboutURL(),
        ];
        $this->feedback = $feedback;
    }

    /**
     * include the right BoneView (Crud or classic)
     */
    public function render()
    {
        include $this->squelette ?? "ViewSquelette.php";
    }

    /**
     * First assigment page created to test View.
     */
    public function makeTestPage()
    {
        $this->title = 'Mon incroyable titre';
        $this->content = " Un contenue INCROYABLE";
        $this->squelette = "ViewSquelette.php";
    }

    /**
     * Show the page of a ProgrammingLanguage.
     * 
     * @param ProgrammingLanguage $programmingLanguage
     */
    public function makeProgrammingLanguagePage($programmingLanguage)
    {
        $this->title = $programmingLanguage->getName();
        $this->content = '<img class="logo" src="/upload/' . $programmingLanguage->getLogo() . '"/> <br/>';
        $this->content .= $programmingLanguage->getName() . " est un langage de programmation développé par " . $programmingLanguage->getCreator() . ", sorti en " . $programmingLanguage->getCreationDate();
        $this->squelette = "ViewSquelette.php";
        // Boolean, used to show modify and delete action button
        $this->seeableCRUDButton = true;
    }

    /**
     * If id is unknown in Database, show a unknown programming page.
     */
    public function makeUnknownProgrammingLanguagePage()
    {
        $this->title = 'Langage de programming introuvable';
        $this->content = " Langage de programmation inconnue dans notre base";
        $this->squelette = "ViewSquelette.php";
    }

    /**
     * Same as before but for error.
     */
    public function makeErrorPage(){
        $this->title = 'Langage de programming introuvable';
        $this->content = " Langage de programmation inconnue dans notre base";
        $this->squelette = "ViewSquelette.php";
    }

    /**
     * Show a home page as first page and principal page.
     */
    public function makeWelcomeProgrammingLanguagePage()
    {
        $this->title = 'Bienvenue';
        $this->content = 'Veuillez choisir un langage de programmation !';
        $this->squelette = "ViewSquelette.php";
    }

    /**
     * Show the list of all ProgrammingLanguage.
     * @param Array of ProgrammingLanguage
     */
    public function makeListPage(array $programmingLanguages)
    {
        $this->title = "Liste des langages";
        $this->content = "Liste des langages :";
        $this->programmingLanguages = $programmingLanguages;
        $this->squelette = "ViewSquelette.php";
    }

    /**
     * Show the create page to create a new ProgrammingLanguage 
     */
    public function makeProgrammingLanguageCreationPage(){
        $this->title = "Création d'un nouveau langage";
        $this->squelette = "ViewCRUDSquelette.php";
        key_exists('currentNewLanguage', $_SESSION) ? $this->feedback = $_SESSION['currentNewLanguage']->getERROR() : $this->feedback = [];
        /*  Get existing value from $data */
        key_exists('currentNewLanguage', $_SESSION) ? $data = $_SESSION['currentNewLanguage']->getData() : $data = [];
        $this->name = $data['name'] ?? "";
        $this->creator = $data['creator'] ?? "";
        $this->creationDate = $data['creationDate'] ?? "";
    }

    /**
     * Show a confirmation page to delete a existing ProgrammingLanguage.
     * @param ID of the ProgrammingLanguage
     */
    public function makeProgrammingLanguageDeletionPage($id){
        $this->title = "Supprimer?";
        $this->content = "Êtes vous sûr de vouloir supprimer ce langage";
        $this->squelette = "ViewSquelette.php";
    }

    /**
     * Show the crud page with last values to modify the ProgrammingLanguage selected.
     */
    public function makeProgrammingLanguageModificationPage(){
        $this->title = "Modification du langage";
        $this->squelette = "ViewCRUDSquelette.php";
        key_exists('currentModifyLanguage', $_SESSION) ? $this->feedback = $_SESSION['currentModifyLanguage']->getError() : $this->feedback = [];
        /*  Get existing value from $data */
        key_exists('currentModifyLanguage', $_SESSION) ? $data = $_SESSION['currentModifyLanguage']->getData() : $data = [];
        $this->name = $data->getName() ?? "";
        $this->creator = $data->getCreator() ?? "";
        $this->creationDate = $data->getCreationDate() ?? "";
    }

    /**
     * Show the About Page.
     */
    public function makeAboutPage(){
        $this->title = "À propos";
        $this->content = "Langlois Emilien, numéro étudiant: 22002270<br>";
        $this->content  .=  "L'ensemble des points obligatoires ont étés codé. Pour la partie optionnel, j'ai réalisé l'insertion de fichier (pour ma part il s'agit d'image pour embellir mon sujet/objet) ainsi que le PATH_INFO. 
                            J'ai implémenté une partie AJAX afin de vérifier en temps réel de la saisie lorsque le bouton est pressée.
                            Il permet sans recharger la page de vérifier que l'utilisateur envoie de bonne information avant de tenter toutes sauvegarde dans la bdd.
                            Je l'ai actuellement désactivé afin d'utiliser au maximum le Builder cependant vous pouvez y accéder dans le dossier checker (partie js et php) dans le src.
                            J'ai utilisé BootStrap afin d'avoir un style plutôt basique et passe partout avec évidemment quelques modifications personelles.
                            J'ai fait le choix de laisser lors de la mise à jour d'un langage existant, l'ancien si il y a une erreur. Le code est cependant disponible pour remettre le nouveau après erreur.
                            Lors du téléchargement de mon ode sur git, veuillez sélectionner le chemin vers le fichier";
        $this->squelette = "ViewSquelette.php";
    }
    /* ------------------------ DISPLAYER  ------------------------ */

    /**
     * Redirect user if ProgrammingLanguage is successfully created with POSTredirect function to the new ProgrammingLanguage.
     * @param ID $id
     */
    public function displayProgrammingLanguageCreationSuccess($id){
        $url = $this->router->getProgrammingLanguageURL($id);
        $this->router->POSTredirect($url,$this->feedback,303);
    }

    /**
     * Redirect user if Deletion successfully worked and show the name of the Language Deleted on the welcome page.
     * @param String name
     */
    public function displayProgrammingLanguageDeletionSuccess($name){
        $this->title = "Redirection";
        $this->content = "";
        $url = $this->router->getIndexURL();
        $this->router->POSTredirect($url,[0 => "Suppression du language $name réussis !"],303);
    }

    /**
     * Redirect user to the creation page and show the error he made with a text.
     */
    public function displayProgrammingLanguageCreationFailure(){
        $this->title = "Redirection";
        $this->content = "";
        $url = $this->router->getProgrammingLanguageCreationURL();
        $this->router->POSTredirect($url,$this->feedback,303);
    }

    /**
     * Redirect user to the home page and print the name of the modifiate ProgrammingLanguage
     * @param String name
    */
    public function displayProgrammingLanguageModificationSuccess($name){
        $this->title = "Redirection";
        $this->content = "";
        $url = $this->router->getIndexURL();
        $this->router->POSTredirect($url,[0 => "Modification du language $name réussis !"],303);
    }

    /**
     * Redirect user to the modification (same as create) page, with the actual values of the ProgrammingLanguage before the first modification.
     *
     */
    public function displayProgrammingLanguageModificationFailure($id){
        $this->title = "Redirection";
        $this->content = "";
        $url = $this->router->getProgrammingLanguageModificationURL($id);
        $this->router->POSTredirect($url,$this->feedback,303);
    }
}