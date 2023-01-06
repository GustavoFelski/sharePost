<?php
    /*
     * PDO Database Class
     * Connect to database
     * Create prepared statements
     * Bind Values
     * Return rows and results
     */

    class Database {
        
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbName = DB_NAME;

        private $dbh;
        private $stmt;
        private $erro;

        public function __construct()
        {
            //Set DNS
            $dns = 'mysql:host='.$this->host.';dbname='. $this->dbName;
            $options = array(
                PDO::ATTR_PERSISTENT => true, //this option Incresses performase making the connection established with Database persistent
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // this option alow us to handel exceptions in a elegant way   
            );
            
            //Create a PDO instance
            try{
                $this->dbh = new PDO($dns, $this->user, $this->pass, $options);
            }catch(PDOException $e){
                $this->erro = $e->getMessage();
                echo $this->erro;
            }
        }

        // Create a statment with query
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }
        /* Bind Values function 
        * $param is each table we going to do the transaction
        * $value is the value and can be NULL,INT,STR,BOOL, etc...
        * $type This is what do we have to bind as $value
        */
        public function bind($param,$value,$type=null){
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            $this->stmt->bindValue($param,$value,$type);
        }
        //execute the prepared statement 
        public function execute(){
            return $this->stmt->execute();
        }

        //Get result set array of records as obj
        public function resultSetArray(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
         //Get single of record
         public function resultSetSingle(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }
        // Get row count
        public function rowCount(){
            return $this->stmt->rowCount();
        }

    }