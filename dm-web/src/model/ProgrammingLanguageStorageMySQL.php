<?php
require_once( 'model/ProgrammingLanguageStorage.php' );
class ProgrammingLanguageStorageMySQL implements ProgrammingLanguageStorage {
    private $pdo;
    /**
     * Create a new Sql storage instance
     * 
     * @param $pdo is a connection to SQL database
     */
    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    /**
     * Found and create Programming Language in SQL database the line with the $id as id or return null for inexistant.
     * 
     * @param Unsigned Int $id
     * 
     * @return null
     * @return ProgrammingLanguage
     */
    public function read($id){
        $request = "SELECT * FROM programming_languages WHERE id=?;";
        $stmt = $this->pdo->prepare($request);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result == false) {
            return null;
        }
        return new ProgrammingLanguage($result['name'], $result['creator'], $result['creationDate'],$result['logo']);
    }

    /**
     * Get all line from SQL Database.
     * @return Array
     */
    public function readAll(){
        $request = "SELECT * FROM programming_languages; ";
        $stmt = $this->pdo->query($request);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $languages = [];
        foreach($results as $key => $values){
            $languages[$values['id']] = new ProgrammingLanguage($values['name'],$values['creator'], $values['creationDate'], $values['logo']);
        }
        return $languages;
    }

    /**
     * Insert id, name, creator, creationDate and logo (as logo name) in the SQL Database. And with all values insert get the Programming Language created id's.
     * 
     * @param ProgrammingLanguage
     * 
     * @return Integer $id
     */
    public function create(ProgrammingLanguage $data){
        $insert = [$data->getName(),$data->getCreator(),$data->getCreationDate(),$data->getLogo()];
        $request = "INSERT INTO programming_languages(name,creator,creationDate,logo) VALUES (?, ?, ?,?);";
        $stmt = $this->pdo->prepare($request);
        $stmt->execute($insert);
        /* GET ID TO SHOW AFTER CREATION */
        $request = "SELECT id FROM programming_languages WHERE name=? AND creator=? AND creationDate=? AND logo=?;";
        $stmt = $this->pdo->prepare($request);
        $stmt->execute($insert);
        return $stmt->fetch()['id'];
    }

    /**
     * Get the logo name and delete the line of the ProgrammingLanguage values in SQL Database. With logo name, delete the picture from upload folder.
     * 
     * @param Unsigned Integer $id
     */
    public function delete($id){
        $request = "SELECT logo FROM programming_languages WHERE id=?;";
        $stmt = $this->pdo->prepare($request);
        $stmt->execute([$id]);
        /* DELETE PICTURE IN UPLOAD FOLDER */
        $logoName = $stmt->fetch()['logo'];
        unlink("upload/" . $logoName);
        // DELETE IN TABLE //
        $request = "DELETE FROM programming_languages WHERE id=?;";
        $stmt = $this->pdo->prepare($request);
        $stmt->execute([$id]);
    }

    /**
     * Update values line of an existing prgrammingLanguage and delete the old picture in the upload folder
     * @param Unsigned integer $id
     * @param ProgammingLanguage $programmingLanguage
     */
    public function update($id,$programmingLanguage){
        $request = "SELECT logo FROM programming_languages WHERE id=?;";
        $stmt = $this->pdo->prepare($request);
        $stmt->execute([$id]);
        /* DELETE PICTURE IN UPLOAD FOLDER */
        $logoName = $stmt->fetch()['logo'];
        unlink("upload/" . $logoName);
        /* UPDTAE IN TABLE */
        $request = "UPDATE programming_languages SET name=?, creator=?, creationDate=?, logo=? WHERE id=?;";
        $stmt = $this->pdo->prepare($request);
        $stmt->execute([$programmingLanguage->getName(),$programmingLanguage->getCreator(),$programmingLanguage->getCreationDate(), $programmingLanguage->getLogo(),$id]);
    }
}