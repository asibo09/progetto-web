<?php

 class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if($this->db->connect_error){
            die("Connessione fallita al db");
        }
    }
    public function lastFourSearch($userEmail){
        $query = "SELECT A.*, R.data_ricerca
                  FROM Alloggio A
                  JOIN Ricerca_alloggio R
                    ON A.id_alloggio = R.id_alloggio
                   AND A.email_proprietario = R.email_proprietario
                  WHERE R.email_affittuario = ?
                  ORDER BY R.data_ricerca DESC
                  LIMIT 4";
        $stmt = $this->db->prepare($query);
        if(!$stmt){
            return [];
        }
        if(!$stmt->bind_param("s", $userEmail)){
            $stmt->close();
            return [];
        }
        if(!$stmt->execute()){
            $stmt->close();
            return [];
        }
        // Prefer get_result if available
        $result = $stmt->get_result();
        if($result !== false){
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $rows;
        }
        // Fallback if get_result is not available
        $meta = $stmt->result_metadata();
        if(!$meta){
            $stmt->close();
            return [];
        }
        $fields = [];
        $row = [];
        while($field = $meta->fetch_field()){
            $fields[] = &$row[$field->name];
        }
        $meta->free();
        call_user_func_array([$stmt, 'bind_result'], $fields);
        $results = [];
        while($stmt->fetch()){
            $record = [];
            foreach($row as $key => $val){
                $record[$key] = $val;
            }
            $results[] = $record;
        }
        $stmt->close();
        return $results;
    }

    public function insertAffittuario($email, $nome, $cognome, $cellulare, $password, $eta) {
        $query = "INSERT INTO Affittuario (email, nome, cognome, cellulare, password, eta) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("sssssi", $email, $nome, $cognome, $cellulare, $password, $eta);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
 }


    
 //mettere query

 ?>