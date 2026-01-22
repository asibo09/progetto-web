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

//aggiunge un nuovo alloggio
public function inserisciAlloggio($idProprietario, $d) {
    $query = "INSERT INTO Alloggio (
        id_proprietario, tipo_immobile, superficie_totale, totale_piani_edificio, piano_alloggio, 
        has_ascensore, tipo_riscaldamento, has_cucina, nr_camere_letto, nr_locali_totali, 
        nr_bagni_totali, comune, indirizzo, civico, isZonaCampus, isZonaCentro, 
        isZonaStazione, isZonaAltro, distanza_campus_km, distanza_centro_km, 
        max_persone, nr_coinquilini_attuali, genere_inquilini, occupazione_inquilini, 
        proprietario_vive_casa, accetta_animali, accetta_fumatori, accetta_coppie, 
        prezzo_mensile_alloggio, cauzione, costo_utenze_mensile, disponibile_dal, 
        permanenza_minima_mesi, utenza_acqua, utenza_internet, utenza_gas, utenza_luce, descrizione
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->db->prepare($query);
    
    //map dei tipi
    $tipi = "isiiiisiiiis s iiiiidd i i ss iiii ddd s i iiii s";
    $tipi = str_replace(' ', '', $tipi);
    
    $stmt->bind_param($tipi, 
        $idProprietario,        
        $d['tipo_immobile'],    
        $d['superficie_totale'],
        $d['totale_piani'],     
        $d['piano'],            
        $d['has_ascensore'],   
        $d['riscaldamento'],    
        $d['has_cucina'],      
        $d['nr_camere'],        
        $d['nr_locali'],        
        $d['nr_bagni'],         
        $d['comune'],           
        $d['indirizzo'],       
        $d['civico'],         
        $d['z_campus'],         
        $d['z_centro'],         
        $d['z_stazione'],      
        $d['z_altro'],          
        $d['dist_campus'],     
        $d['dist_centro'],      
        $d['max_persone'],      
        $d['coinquilini'],      
        $d['genere'],           
        $d['occupazione'],      
        $d['vive_casa'],      
        $d['animali'],          
        $d['fumatori'],       
        $d['coppie'],           
        $d['prezzo_alloggio'],  
        $d['cauzione'],         
        $d['utenze_euro'],     
        $d['data_dispo'],       
        $d['perm_min'],         
        $d['u_acqua'],          
        $d['u_internet'],       
        $d['u_gas'],           
        $d['u_luce'],           
        $d['descrizione']     
    );

    if($stmt->execute()) return $stmt->insert_id;
    
    die("Errore SQL: " . $this->db->error);
}

//aggiunge una nuova stanza per un alloggio
public function inserisciStanza($idAlloggio, $mq, $prezzo, $singoli, $matrimoniali, $bagno, $balcone) {
    $query = "INSERT INTO Stanza (id_alloggio, metratura_stanza, prezzo_stanza, nr_letti_singoli, nr_letti_matrimoniali, tipo_bagno, has_balcone, stato) 
              VALUES (?, ?, ?, ?, ?, ?, ?, 'Disponibile')";
    
    $stmt = $this->db->prepare($query);
    
    // map tipi:
    $stmt->bind_param("iidiisi", $idAlloggio, $mq, $prezzo, $singoli, $matrimoniali, $bagno, $balcone);
    
    return $stmt->execute();
}

public function inserisciFoto($idAlloggio, $percorso, $isCopertina = 0) {
    $query = "INSERT INTO Foto (id_alloggio, percorso_immagine, is_copertina) VALUES (?, ?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("isi", $idAlloggio, $percorso, $isCopertina);
    return $stmt->execute();
}

public function insertSegnalazione($id_segnalatore, $id_alloggio, $id_utente_target, $categoria, $descrizione) {
    $query = "INSERT INTO Segnalazione (id_utente_segnalatore, id_alloggio_segnalato, id_utente_segnalato, categoria, descrizione) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("iiiss", $id_segnalatore, $id_alloggio, $id_utente_target, $categoria, $descrizione);
    
    return $stmt->execute();
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