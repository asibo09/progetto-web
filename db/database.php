<?php

class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if($this->db->connect_error){
            die("Connessione fallita al db");
        }
    }

    // Recupera l'utente per l'intestazione del profilo
public function getUserById($idUtente) {
    $stmt = $this->db->prepare("SELECT * FROM Utente WHERE id_utente = ?");
    $stmt->bind_param("i", $idUtente);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Recupera i dati testuali di tutti gli annunci dell'utente
public function getAnnunciByUserId($idUtente) {
    $stmt = $this->db->prepare("SELECT * FROM Alloggio WHERE id_proprietario = ? ORDER BY data_pubblicazione DESC");
    $stmt->bind_param("i", $idUtente);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Recupera tutte le foto di un singolo alloggio per il carosello
public function getFotoByAlloggioId($idAlloggio) {
    $stmt = $this->db->prepare("SELECT percorso_immagine FROM Foto WHERE id_alloggio = ?");
    $stmt->bind_param("i", $idAlloggio);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Recupera alloggi salvati come preferiti da un utente
public function getPreferitiByUserId($idUtente) {
    $query = "SELECT Alloggio.* FROM Preferiti 
              JOIN Alloggio ON Preferiti.id_alloggio = Alloggio.id_alloggio 
              WHERE Preferiti.id_utente = ? 
              ORDER BY Preferiti.data_preferito DESC";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $idUtente);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Recupera i dettagli dell'alloggio e del proprietario
public function getFullAnnuncioById($idAlloggio) {
    $query = "SELECT Alloggio.*, Utente.nome, Utente.cognome, Utente.email, Utente.cellulare, Utente.data_registrazione as data_reg_utente 
              FROM Alloggio 
              JOIN Utente ON Alloggio.id_proprietario = Utente.id_utente 
              WHERE Alloggio.id_alloggio = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $idAlloggio);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Recupera le stanze specifiche di un alloggio
public function getStanzeByAlloggioId($idAlloggio) {
    $stmt = $this->db->prepare("SELECT * FROM Stanza WHERE id_alloggio = ?");
    $stmt->bind_param("i", $idAlloggio);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Verifica se l'alloggio è nei preferiti
public function isFavorite($idUtente, $idAlloggio) {
    $stmt = $this->db->prepare("SELECT * FROM Preferiti WHERE id_utente = ? AND id_alloggio = ?");
    $stmt->bind_param("ii", $idUtente, $idAlloggio);
    $stmt->execute();
    return $stmt->get_result()->num_rows > 0;
}

// Aggiunge un record alla tabella Preferiti
public function addFavorite($idUtente, $idAlloggio) {
    $stmt = $this->db->prepare("INSERT INTO Preferiti (id_utente, id_alloggio) VALUES (?, ?)");
    $stmt->bind_param("ii", $idUtente, $idAlloggio);
    return $stmt->execute();
}

// Rimuove un record dalla tabella Preferiti
public function removeFavorite($idUtente, $idAlloggio) {
    $stmt = $this->db->prepare("DELETE FROM Preferiti WHERE id_utente = ? AND id_alloggio = ?");
    $stmt->bind_param("ii", $idUtente, $idAlloggio);
    return $stmt->execute();
}

public function insertSegnalazione($id_segnalatore, $id_alloggio, $id_utente_target, $categoria, $descrizione) {
    $query = "INSERT INTO Segnalazione (id_utente_segnalatore, id_alloggio_segnalato, id_utente_segnalato, categoria, descrizione) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("iiiss", $id_segnalatore, $id_alloggio, $id_utente_target, $categoria, $descrizione);
    
    return $stmt->execute();
}
}

?>