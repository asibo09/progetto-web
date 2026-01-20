<?php

class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if($this->db->connect_error){
            die("Connessione fallita al db");
        }
    }

    public function insertSegnalazione($id_segnalatore, $id_alloggio, $id_utente_target, $categoria, $descrizione) {
        $query = "INSERT INTO Segnalazione (id_utente_segnalatore, id_alloggio_segnalato, id_utente_segnalato, categoria, descrizione) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiiss", $id_segnalatore, $id_alloggio, $id_utente_target, $categoria, $descrizione);
    
        return $stmt->execute();
    }
}

?>