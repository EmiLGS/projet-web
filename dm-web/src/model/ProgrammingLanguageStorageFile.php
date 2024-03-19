<?php
require_once('lib/ObjectFileDB.php');
require_once('model/ProgrammingLanguageStorageStub.php');
require_once( 'model/ProgrammingLanguageStorage.php' );

class ProgrammingLanguageStorageFile implements ProgrammingLanguageStorage {
    private $db;
    public function __construct($file){
        $this->db = new ObjectFileDB($file);
    }

    public function reinit(){
        $this->db->deleteAll();
        $programmingLanguages = new ProgrammingLanguageStorageStub;
        foreach ( $programmingLanguages->readAll() as $programmingLanguage){
            $this->db->insert($programmingLanguage);
        }
    }
    public function read($id){
        if ($this->db->fetch($id)){
            return $this->db->fetch($id);
        }
        return NULL;
    }
    public function readAll(){
        return $this->db->fetchAll();
    }
    public function create(ProgrammingLanguage $programmingLanguage){
        $id = $this->db->insert($programmingLanguage);
        return $id;
    }
    public function delete($id){
        $this->db->delete($id);
    }
    public function update($id,$programmingLanguage){
        $this->db->update($id,$programmingLanguage);
    }
}