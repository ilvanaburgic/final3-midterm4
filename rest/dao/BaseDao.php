<?php

class BaseDao {

    private $conn;

    /**
    * constructor of dao class
    */
    public function __construct(){
        try {
            /** TODO
            * List parameters such as servername, username, password, schema. Make sure to use appropriate port
            */
            $username = "doadmin";
            $password = "AVNS_z6PG_c6BSn-5dB0CG5S";
            $host = "db-mysql-nyc1-13993-do-user-3246313-0.b.db.ondigitalocean.com";
            $port = "25060";
            $database = "final-midterm2-2023";

            // Options array for enabling SSL mode
            $options = array(
                PDO::MYSQL_ATTR_SSL_CA => '/Users/ilvanaburgic/Music/final3-midterm4/IP2LOCATION.json',
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
            );

            /** TODO
            * Create new connection
            */
            $dsn = "mysql:host=$host;port=$port;dbname=$database";
            $this->conn = new PDO($dsn, $username, $password, $options);

            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
?>
