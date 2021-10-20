<?php
// ini_set("display_errors",0);

class FormValidator {
    
    public string $validationResult;

    function __construct() {
      $this->validationResult="";
    }
     function validateFormField($typeOfFieldContent, $value) {
        
        

        switch($typeOfFieldContent) {
          
            case "email" :
              
              try {

                $emailInputLength=strlen($value);
                $this->validationResult= filter_var($value,FILTER_VALIDATE_EMAIL);

              if ($emailInputLength ==0) {
                
                throw new Exception("Email input must not be empty");
              } else if ($this->validationResult == false) {
                
                throw new Exception("Email not valid");
              } 
              } catch (Exception $e) {
                error_log(sprintf("[%s] ".$e->getMessage(),date('Y-m-d H:i:s')),3,"loginErrors.log");
              }
              break;

            case "password":
                
              try {
                $pwdLength=strlen($value);
                
                if ($pwdLength <3) {
                    
                   throw new Exception("Password must be at least 8 characters");
                    
                } else if($pwdLength ==0) {
                    
                   throw new Exception("Password input must not be empty");
                } else {
                  $this->validationResult=$value;
                }

              } catch (Exception $e) {
                  error_log(sprintf("[%s] ".$e->getMessage(),date('Y-m-d H:i:s')),3,"loginErrors.log");
              }
                
                break;
        }
    return $this->validationResult;
    }
}

