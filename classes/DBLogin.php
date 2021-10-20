<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class DBLogin {
    public string $databaseDSN;
    public string $user;
    public string $password;
    public string $pdo;
    
    
    public function __construct($dbUrl,$u,$p) {
        $this->databaseDSN = $dbUrl;
        $this->user=$u;
        $this->password=$p;
    }
    function insertData($aUser,$aPwd) {
       // echo "dati d'accesso: ".$this->databaseDSN." | ".$this->user." | ".$this->password;
        
        try {
            $pdo= new PDO($this->databaseDSN, $this->user,$this->password);
            
            $sqlInsert="Insert into login(username,password) values(:aUser,:aPwd)";

            
            $stmt=$pdo->prepare($sqlInsert);
            $stmt->bindParam(':aUser',$aUser);
            $stmt->bindParam(':aPwd',$aPwd);

            
            $stmt->execute();

                   

        // Create the logger
        $logger = new Logger('my_logger');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::INFO));
        $logger->info("L'utente ".$aUser." ha effettuato l'accesso al sito. ");


        } catch(Exception $e) {
            echo $e->getMessage();
        }
        
    }

}