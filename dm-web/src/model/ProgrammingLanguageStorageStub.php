<?php
require_once( 'model/ProgrammingLanguageStorage.php' );
require_once( 'model/ProgrammingLanguage.php' );
class ProgrammingLanguageStorageStub implements ProgrammingLanguageStorage {
    private array $programmingLanguagesTab;

    public function __construct(){
        $this->programmingLanguagesTab = array(
            'html' => new ProgrammingLanguage("HTML","Tim Berners-Lee",1990,"../upload/ey5m6hjrbW.png"),
            'css' => new ProgrammingLanguage('CSS', 'Chris Lilley',1997,"../upload/ey5m6hjrbW.png"),
            'php' => new ProgrammingLanguage('PHP', 'Rasmus Lerdorf',1994,"../upload/ey5m6hjrbW.png"),
        );
    }
    public function read($id){
            if ( $this->programmingLanguagesTab[ $id ] ){
                return $this->programmingLanguagesTab[ $id ];
            }
        return NULL;
    }
    public function readAll(){
        return $this->programmingLanguagesTab;
    }
    public function create(ProgrammingLanguage $programmingLanguage){
        $key = strtolower($programmingLanguage->name);
        $this->programmingLanguagesTab[$key] = $programmingLanguage;
        return $key;
    }
    public function delete($id){
        unset($this->programmingLanguagesTab[$id]);
    }
    public function update($id,$programmingLanguage){
        $language = $this->programmingLanguagesTab[$id];
        $language->setName($programmingLanguage->getName());
        $language->setCreator($programmingLanguage->getCreator());
        $language->setCreationDate($programmingLanguage->getCreationDate());
    }
}