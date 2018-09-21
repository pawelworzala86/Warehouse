<?php

namespace App;

use PDO;

class Database {

    public $dbh;
    public $errorMsg;
    private $sql;

    public function __construct($host, $name, $user, $password) {
        $this->dbh = new PDO("mysql:host=" . $host . ";dbname=" . $name, $user, $password);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $this->execute('SET NAMES UTF8');
    }

    public function execute($command, $param = null) {
        $this->setLastSQL($command);
        try {
            $sth = $this->dbh->prepare($command);
            if (isset($param)) {
                if (!is_array($param))
                    $param = [$param];
                $ret = $sth->execute($param);
            } else
                $ret = $sth->execute();
            return $ret;
        } catch (\PDOException $e) {
            $this->setErrorMsg($e->getMessage());
        }
    }

    public function getOne($command, $param = null) {
        $this->setLastSQL($command);
        try {
            $sth = $this->dbh->prepare($command);
            if (isset($param)) {
                if (!is_array($param))
                    $param = [$param];
                $sth->execute($param);
            } else
                $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            ;
            if (isset($result[0]))
                return $result[0];
            else
                return null;
        } catch (\PDOException $e) {
            $this->setErrorMsg($e->getMessage());
        }
    }

    public function getAll($command, $param = null) {
        $this->setLastSQL($command);
        try {
            $sth = $this->dbh->prepare($command);
            if (isset($param)) {
                if (!is_array($param))
                    $param = [$param];
                $sth->execute($param);
            } else
                $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->setErrorMsg($e->getMessage());
        }
    }

    public function getRow($command, $param = null) {
        $this->setLastSQL($command);
        try {
            $sth = $this->dbh->prepare($command);
            if (isset($param)) {
                if (!is_array($param))
                    $param = [$param];
                $sth->execute($param);
            } else
                $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            $this->setErrorMsg($e->getMessage());
        }
    }

    public function errorMsg() {
        return $this->errorMsg;
    }

    public function insertId() {
        return $this->dbh->lastInsertId();
    }
    
    private function setErrorMsg($errorMsg){
        if(DEBUG){
            echo $this->sql;
            die($errorMsg);
        }
        $this->errorMsg = $errorMsg;
    }

    private function setLastSQL($sql){
        $this->sql = $sql;
    }

}
