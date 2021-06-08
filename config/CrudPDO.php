<?php
session_start();

require_once 'database.php';

class CrudPDO
{
    private $db;
    private $dbhost = DBHOST;
    private $dbuser = DBUSER;
    private $dbpass = DBPASS;
    private $dbname = DBNAME;




    function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname . ';charset=utf8', $this->dbuser, $this->dbpass);
//             echo "Bağlantı Başarılı";
        } catch (Exception $e) {
            die("Bağlantı Başarısız:" . $e->getMessage());
        }
    }

    public function qSql($sql, $options = [])
    {

        try {

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt;

        } catch (Exception $e) {

            return ['status' => FALSE, 'error' => $e->getMessage()];

        }
    }




}