<?php
/*
 * PDO database class
 * functionality :
 *  1. connect to the database
 *  2. create prepared statement
 *  3. Binding values
 *  4. return records
 */

class Database{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;
    private $dataBaseHandler;
    private $statement;
    private $error;

    public function __construct()
    {
        //set DSN
        $dsn = 'mysql:host='. $this->host . ';dbname='. $this->dbname;

        /* PDO::ATTR_PERSISTENT :
         * Many web applications will benefit from making persistent connections
         *  to database servers. Persistent connections are not closed
         * at the end of the script, but are cached and re-used when another script
         *  requests a connection using the same credentials.
         * The persistent connection cache allows you to avoid the overhead of
         * establishing a new connection every time a script needs to talk to a database,
         * resulting in a faster web application
         *
         * PDO::ATTR_ERRMODE: Error reporting.
         * PDO::ERRMODE_EXCEPTION: Throw exceptions.
         */

        $options=array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        // create PDO object
        try{
            $this->dataBaseHandler = new PDO($dsn,$this->user,$this->password,$options);

        } catch(PDOException $err){
            $this->error = $err->getMessage();
            echo $this->error;

        }
    }

    /* ================================= Prepare statement with query ============================== */
    public function query($sql){
        $this->statement = $this->dataBaseHandler->prepare($sql);

    }

    /* ============================================= Bind value =================================== */
    public function bind($param,$value,$type = null){
       // PDOStatement::bindValue — Binds a value to a parameter
       // e.g : $sth->bindValue(':calories', $calories, PDO::PARAM_INT);
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
        $this->statement->bindValue($param,$value,$type);
    }

    /* ============================== Exacute the prepared statement =================================== */
    public function execute(){
        return $this->statement->execute();

    }

    /* ============================ get result set as array of objects =================================== */
    //PDO::FETCH_OBJ: returns an anonymous object with property names
    //that correspond to the column names returned in your result set
    public function resultSet(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    /* ============================================= Get single record as object =================================== */
    public function single(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);

    }

    /* ============================================= Get row count =================================== */
    public function rowCount(){
        return $this->statement->rowCount();
    }
}