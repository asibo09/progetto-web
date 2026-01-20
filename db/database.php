<?php

 class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if($this->db->connect_error){
            die("Connessione fallita al db");
        }
    }

    // Esempio: recupera le ricerche (searches) relative a un utente specifico
    public function getUserSearches($userId, $limit = 4){
        $userId = (int)$userId;
        $limit = (int)$limit;
        // bind del limit in alcune versioni non è supportato, quindi lo interpoliamo in sicurezza dopo il cast
        $query = "SELECT * FROM searches WHERE user_id = ? ORDER BY created_at DESC LIMIT $limit";
        $stmt = $this->db->prepare($query);
        if(!$stmt) return [];
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    // (opzionale) Mantengo placeholder per la funzione originale
    public function getFourRandomSearchs($n=2){
        $n = (int)$n;
        $query = "SELECT * FROM searches ORDER BY RAND() LIMIT $n";
        $res = $this->db->query($query);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }
 }

 ?>