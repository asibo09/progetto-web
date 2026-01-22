<?php

class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connessione fallita al db");
        }
    }
    public function lastFourSearch($userEmail)
    {
        $query = "SELECT A.*, R.data_ricerca
                  FROM Alloggio A
                  JOIN Ricerca_alloggio R
                    ON A.id_alloggio = R.id_alloggio
                   AND A.email_proprietario = R.email_proprietario
                  WHERE R.email_affittuario = ?
                  ORDER BY R.data_ricerca DESC
                  LIMIT 4";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return [];
        }
        if (!$stmt->bind_param("s", $userEmail)) {
            $stmt->close();
            return [];
        }
        if (!$stmt->execute()) {
            $stmt->close();
            return [];
        }
        // Prefer get_result if available
        $result = $stmt->get_result();
        if ($result !== false) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $rows;
        }
        // Fallback if get_result is not available
        $meta = $stmt->result_metadata();
        if (!$meta) {
            $stmt->close();
            return [];
        }
        $fields = [];
        $row = [];
        while ($field = $meta->fetch_field()) {
            $fields[] = &$row[$field->name];
        }
        $meta->free();
        call_user_func_array([$stmt, 'bind_result'], $fields);
        $results = [];
        while ($stmt->fetch()) {
            $record = [];
            foreach ($row as $key => $val) {
                $record[$key] = $val;
            }
            $results[] = $record;
        }
        $stmt->close();
        return $results;
    }

    public function insertUser($nome, $cognome, $email, $password, $cellulare, $eta, $ruolo)
    {
        $query = "INSERT INTO Utente (nome, cognome, email, password, cellulare, eta, ruolo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("sssssis", $nome, $cognome, $email, $password, $cellulare, $eta, $ruolo);

        try {
            $result = $stmt->execute();
        } catch (Exception $e) {
            // Log dell'errore se necessario, o gestiscilo
            $result = false;
        }

        $stmt->close();
        return $result;
    }

    public function checkLogin($email, $password)
    {
        $query = "SELECT email, password FROM Utente WHERE email = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function myApartments($email)
    {
        $query = "SELECT a.* FROM Utente u JOIN Alloggio a ON u.id_utente = a.id_proprietario WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function myApartamentsRented($email)
    {
        $query = "SELECT a.* 
                  FROM Utente u 
                  JOIN Prenotazione p ON u.id_utente = p.id_affittuario 
                  JOIN Stanza s ON p.id_stanza = s.id_stanza 
                  JOIN Alloggio a ON s.id_alloggio = a.id_alloggio 
                  WHERE u.email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>