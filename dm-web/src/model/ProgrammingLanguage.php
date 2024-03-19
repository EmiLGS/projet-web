<?php
class ProgrammingLanguage {
    protected $name;
    protected $creator;
    protected $creationDate;
    protected $logo;

/**
 * Create a Programming Language instance.
 * @param $name is the name of the language, $creator his creator, $creationDate his date of creation and $logo his representation.
 *
*/
    function __construct($name,$creator,$creationDate,$logo){
        $this->name = $name;
        $this->creator = $creator;
        $this->creationDate = $creationDate;
        $this->logo = $logo;
    }


/**
 * Give the name of the language.
 *
 * @return String
 */
    function getName(){
        return $this->name;
    }


/**
 * Give the creator name.
 *
 * @return String
 */
    function getCreator(){
        return $this->creator;
    }


/**
 * Give the date of creation.
 *
 * @return Integer
 */
    function getCreationDate(){
        return $this->creationDate;
    }


/**
 * Give the logo.
 */
    function getLogo(){
        return $this->logo;
    }

/**
 * Set a new name.
 */
    function setName($name){
        $this->name = $name;
    }


/**
 * Set a new creator.
 */
    function setCreator($creator){
        $this->creator = $creator;
    }


/**
 * Set a new Creation date.
 */
    function setCreationDate($creationDate){
        $this->creationDate = $creationDate;
    }

}