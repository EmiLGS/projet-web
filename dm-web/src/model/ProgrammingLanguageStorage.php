<?php
interface ProgrammingLanguageStorage {
    public function read($id);
    public function readAll();
    public function create(ProgrammingLanguage $data);
    public function delete($id);
    public function update($id,$programmingLanguage);
}