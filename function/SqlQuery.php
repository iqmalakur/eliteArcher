<?php
    class SqlQuery{
        public function __construct($host, $username, $password, $db){
            $this->conn = mysqli_connect($host, $username, $password, $db);
        }

        public function getSingle($query){
            $result = mysqli_query($this->conn, $query);
            return mysqli_fetch_assoc($result);
        }

        public function getResult($query){
            $result = mysqli_query($this->conn, $query);
            $rows = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }

            return $rows;
        }

        public function getResultSpecific($table, $col, $val){
            return $this->getResult("SELECT * FROM $table WHERE $col='$val'");
        }

        public function getSingleSpecific($table, $col, $val){
            return $this->getSingle("SELECT * FROM $table WHERE $col='$val'");
        }

        public function insert($table, $value, $col="default"){
            if ($col == "default") {
                mysqli_query($this->conn, "INSERT INTO $table VALUES ($value)");
            }
            else {
                mysqli_query($this->conn, "INSERT INTO $table ($col) VALUES ($value)");
            }

            return mysqli_affected_rows($this->conn);
        }
        
        public function delete($table, $cond){
            mysqli_query($this->conn, "DELETE FROM $table WHERE $cond");
            return mysqli_affected_rows($this->conn);
        }
        
        public function update($table, $cond, $update){
            mysqli_query($this->conn, "UPDATE $table SET $update WHERE $cond");
            return mysqli_affected_rows($this->conn);
        }

        public function count($table, $addictional="", $as='count', $addcol="default"){
            if ($addcol == "default") {
                $result = $this->getSingle("SELECT COUNT(*) AS $as FROM $table $addictional");
            }
            else{
                $result = $this->getResult("SELECT $addcol, COUNT(*) AS $as FROM $table $addictional");
            }

            return $result;
        }

        public function sum($table, $col, $addictional="", $as='sum', $addcol="default"){
            if ($addcol == "default") {
                $result = $this->getSingle("SELECT SUM($col) AS $as FROM $table $addictional");
            }
            else{
                $result = $this->getResult("SELECT $addcol, SUM($col) AS $as FROM $table $addictional");
            }

            return $result;
        }

        public function avg($table, $col, $addictional="", $as='avg', $addcol="default"){
            if ($addcol == "default") {
                $result = $this->getSingle("SELECT AVG($col) AS $as FROM $table $addictional");
            }
            else{
                $result = $this->getResult("SELECT $addcol, AVG($col) AS $as FROM $table $addictional");
            }

            return $result;
        }

        public function max($table, $col, $addictional="", $as='max', $addcol="default"){
            if ($addcol == "default") {
                $result = $this->getSingle("SELECT MAX($col) AS $as FROM $table $addictional");
            }
            else{
                $result = $this->getResult("SELECT $addcol, MAX($col) AS $as FROM $table $addictional");
            }

            return $result;
        }

        public function min($table, $col, $addictional="", $as='min', $addcol="default"){
            if ($addcol == "default") {
                $result = $this->getSingle("SELECT MIN($col) AS $as FROM $table $addictional");
            }
            else{
                $result = $this->getResult("SELECT $addcol, MIN($col) AS $as FROM $table $addictional");
            }

            return $result;
        }

        public function getCount($table, $addictional=""){
            return $this->count($table, $addictional)['count'];
        }

        public function getSum($table, $col, $addictional=""){
            return $this->sum($table, $col, $addictional)['sum'];
        }

        public function getAvg($table, $col, $addictional=""){
            return $this->avg($table, $col, $addictional)['avg'];
        }

        public function getMax($table, $col, $addictional=""){
            return $this->max($table, $col, $addictional)['max'];
        }

        public function getMin($table, $col, $addictional=""){
            return $this->min($table, $col, $addictional)['min'];
        }
    }
    
?>