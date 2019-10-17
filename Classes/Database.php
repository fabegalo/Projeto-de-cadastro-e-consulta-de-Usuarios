<?php

    //Critical section dont touch!!!

class Database {
        
    private $hostname = 'us-cdbr-iron-east-05.cleardb.net';
    private $dbName = 'heroku_b481894670aeac7';
    private $username = 'baaf8787ff1507';
    private $senha = '7ec630fc';

    public function dbConnect()
    {
        try {
            $con = new \PDO("mysql:host=$this->hostname;dbname=$this->dbName", "$this->username", "$this->senha");
            $con->exec("SET @@auto_increment_increment=1;");
            return $con;
        }
    
        catch (PDOException $e) {
            print "Erro!:" . $e->getMessage() . "<br>";
        }
    }

    public function dbCheck($stmt)
    {
        $num = $stmt->rowCount();
        return $num;
    }

    public function getResult($stmt)
    {
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function dbQuery($sqlQuery)
    {
        $con = $this->dbConnect();
        //print_r($sqlQuery);

        try {
            $stmt = $con->query($sqlQuery) or die("ERROR: Não Foi possivel realizar o cadastro");
        }
        
        catch (PDOException $e) {
            print "Erro!:deu ruim na model, chama a microsoft!!" . $e->getMessage() . "<br>";
        }
        
        
        $this->dbClose($con);
        return $stmt;
    }

    public function dbClose($con)
    {
        unset($con);
        if (!empty($con)){
            echo "deu ruim na model, chama a microsft! a coneção não fechou nao";
        }
    }
        // ESPERO MESMO Q VC SAIBA O Q TA FAZENDO!!
    public function getAll($table, $column, $where = 0)
    {
        $sqlQuery = "SELECT {$column} FROM {$table}";
        if (!empty($where)){
            $sqlQuery .= " WHERE {$where}";
        }
        
        $stmt = $this->dbQuery($sqlQuery);
        return $stmt;
    }

    public function update($table, $column, $value, $where)
    {
        if (empty($where)){
            echo "TA FAZENDO MERDA AI Ó, UPDATE SEM WHERE, CHAMA A MICROSOFT"; 
            die();                              
        }

        $sqlQuery = "UPDATE {$table}
                        SET {$column} = {$value}
                        WHERE {$where}";
        
        $stmt = $this->dbQuery($sqlQuery);   
        return $stmt;
    }

    public function dbInsert($table, $columns, $values)
    {
        $sqlQuery = "INSERT INTO {$table} ($columns) VALUES ($values)";
    

        $stmt = $this->dbQuery($sqlQuery);
        return $stmt;
    }
        
}