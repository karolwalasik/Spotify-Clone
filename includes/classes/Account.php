<?php

class Account{

    public function __construct(){

    }

        public function register(){
        $this->validateUsername($username);
        $this->validateFirstName($firstName);
        $this->validateLastName($lastName);
        $this->validateEmail($email,$emailC);
        $this->validatePasswords($password,$passwordC);


        }

        private function validateUsername($un){
                echo 'std';
        }
        
        private function validateFirstName($fn){
            
        }
        
        private function validateLastName($ln){
            
        }
        
        private function validateEmail($em,$em2){
            
        }
        
        private function validatePasswords($pw,$pw2){
            


    }
}

?>