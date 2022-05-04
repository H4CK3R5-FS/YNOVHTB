<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 12:47:27
 */

class Validator{

    private $data;
    private $errors = [];
    private $directory = "recent/challenges";

    public function __construct($data)
    {
        $this->data = $data;
    }

    private function getField($field)
    {
        if (!isset($this->data[$field])) {
            return null;
        }
        return $this->data[$field];
    }

    public function isEqual($field, $field1)
    {
        if(password_verify($field, $field1)): return true; endif;
        $this->errors[$field] = 'Votre ancient mot de passe n\'est pas valide!';
        return false ;
    }

    public function checked($field, $value)
    {
        return ($this->getField($field) == $value)? true : false ;
    }

    public function isAlphaOrEmail($field, $errorMsg)
    {
        if (!filter_var($this->getField($field), FILTER_VALIDATE_EMAIL) and !preg_match('/^[a-zA-Z0-9_\s]+$/', $this->getField($field))) 
        {
            $this->errors[$field] = $errorMsg;
            return false;
        }
        return true;
    }

    public function isAlpha($field, $errorMsg)
    {
        if (!preg_match('/^[a-zA-Z0-9_\ ]+$/', $this->getField($field))) {
            $this->errors[$field] = $errorMsg;
            return false;
        }
        return true;
    }

    public function isNum($field, $errorMsg)
    {
        if (!is_numeric($this->getField($field))) {
            $this->errors[$field] = $errorMsg;
            return false;
        }
        return true;
    } 

    public function isUniq($field, $db, $table, $errorMsg, $toLower = false)
    {
        $record = $db->query("SELECT id FROM $table WHERE $field = ?", [($toLower)? strtolower($this->getField($field)): $this->getField($field)])->fetch();
        if ($record) {
            $this->errors[$field] = $errorMsg;
            return false;
        }
        return true;
    }

    public function isHere($field, $db, $table, $errorMsg)
    {
        $record = $db->query("SELECT id FROM $table WHERE $field = ?", [$this->getField($field)])->fetch();
        if ($record) {
            return true;
        }
        $this->errors[$field] = $errorMsg;
        return false;
    }


    public function isEmail($field, $errorMsg)
    {
        if (!filter_var($this->getField($field), FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = $errorMsg;
            return false;
        }
        return true;
    }

    public function isSized($field, $minSize, $maxSize)
    {
        if(!(strlen(trim($this->getField($field))) >= $minSize)){
            $this->errors[$field] = $field." is too short !";
            return false;
        }   
        if(!(strlen(trim($this->getField($field))) <= $maxSize)){
            $this->errors[$field] = $field." is too long !";
            return false;
        }   
        return true;
    }

    public function isConfirmed($field, $errorMsg)
    {
        $value = $this->getField($field);
        if (empty($value) || $value != $this->getField($field .'_confirm')) {
            $this->errors[$field] = $errorMsg;
            return false;
        }
        return true;
    }

    public function getDirectory(){
        return $this->directory;
    }

    public function isErrorOk($field){
        switch ($this->data) {
            case UPLOAD_ERR_OK: break;
            case UPLOAD_ERR_NO_FILE: 
                $this->errors[$field] = 'No file sent !';break;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE: 
                $this->errors[$field] = 'Exceeded filesize limit !';break;
            default: 
                return True;
        }
    }

    public function moveFile($tmpName, $filename){
        $fileExtension = explode('.', $this->getField($filename))[1];
        $newName = "challenge-".uniqid();
        if(move_uploaded_file($this->getField($tmpName), $this->getDirectory()."/".basename($newName.".".$fileExtension))){
            return $this->getDirectory()."/".basename($newName.".".$fileExtension);
        }
        return null;
    }

    public function isChecked($field, $errorMsg){
        if(null != $this->getField($field) and $this->getField($field) === 'condition--OK'){
            return true;
        }
        return false;
    }

    public function isValid()
    {
        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    
}