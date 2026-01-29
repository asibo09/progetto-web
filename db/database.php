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



    public function lastFourSearch($id_studente)
    {
        $query = "SELECT A.descrizione
                  FROM Ricerca_alloggio R JOIN Alloggio A ON R.id_alloggio = A.id_alloggio
                  WHERE R.id_studente = ?
                  ORDER BY R.data_ricerca DESC
                  LIMIT 4";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_studente);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result !== false) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $rows;
        }
        $stmt->close();
        return [];
    }
        
    public function search($luogo, $nmesi, $npersone, $prezzo_max = null, $tipologia = [], $zona = [], $extra_filters = [])
    {
        $query = "SELECT * FROM Alloggio WHERE comune LIKE ? AND permanenza_minima_mesi <= ? AND max_persone <= ?";
        // Use CONCAT to allow partial matches for location
        $luogo_param = "%" . $luogo . "%";
        $params = ['sii', $luogo_param, $nmesi, $npersone];

        if ($prezzo_max !== null && $prezzo_max > 0) {
            $query .= " AND prezzo_mensile_alloggio <= ?";
            $params[0] .= 'i';
            $params[] = $prezzo_max;
        }

        if (!empty($tipologia)) {
            $placeholders = implode(',', array_fill(0, count($tipologia), '?'));
            $query .= " AND tipo_immobile IN ($placeholders)";
            $params[0] .= str_repeat('s', count($tipologia));
            foreach ($tipologia as $tipo) {
                $params[] = $tipo;
            }
        }

        if (!empty($zona)) {
            $zona_clauses = [];
            foreach ($zona as $z) {
                // Ensure the column name is safe
                if (in_array($z, ['isZonaCampus', 'isZonaCentro', 'isZonaStazione'])) {
                    $zona_clauses[] = "$z = 1";
                }
            }
            if (!empty($zona_clauses)) {
                $query .= " AND (" . implode(' OR ', $zona_clauses) . ")";
            }
        }

        // Add simple boolean filters from $extra_filters
        foreach ($extra_filters as $filter_name => $filter_value) {
            // whitelist the allowed filter names to prevent SQL injection
            if (in_array($filter_name, ['has_ascensore', 'accetta_animali', 'utenza_internet', 'utenza_acqua'])) {
                $query .= " AND $filter_name = ?";
                $params[0] .= 'i';
                $params[] = (int) $filter_value;
            }
        }


        $stmt = $this->db->prepare($query);

        // Remove the type definition string before binding
        $bind_params = array_slice($params, 1);
        $stmt->bind_param($params[0], ...$bind_params);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result !== false) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function fotoAlloggio($id_alloggio)
    {
        $query = "SELECT F.*
                  FROM Alloggio A JOIN Foto F ON A.id_alloggio = F.id_alloggio
                  WHERE F.id_alloggio = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_alloggio);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result !== false) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $rows;
        }
        $stmt->close();
        return [];
    }

    public function trova_stanze_utente_per_subaffitto($emailAffittuario)
    {
        $query = "SELECT A.id_alloggio, S.id_stanza
                  FROM Utente U JOIN Prenotazione P ON U.id_utente = P.id_affittuario JOIN Stanza S ON P.id_stanza = S.id_stanza JOIN Alloggio A on A.id_alloggio = S.id_alloggio
                  WHERE U.email = ?
                  AND P.stato = 'Confermata'";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $emailAffittuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result !== false) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $rows;
        }
        $stmt->close();
        return [];
    }

    public function richiedi_subaffitto_stanza($id_mittente, $id_stanza, $messaggio)
    {
        $query = "INSERT INTO Richiesta_Subaffitto(id_mittente, id_stanza, messaggio, stato)
                  VALUES (?, ?, ?, 'In attesa')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iis", $id_mittente, $id_stanza, $messaggio);
        $stmt->execute();

    }

    public function notifiche()
    {
        $query = "SELECT N.*
                  FROM Notifica N";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result !== false) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $rows;
        }
        $stmt->close();
        return [];
    }

    public function richieste_subaffitto($email){
        $query = "SELECT R.id_richiesta, R.messaggio, S.id_stanza, A.tipo_immobile
                  FROM Richiesta_Subaffitto R JOIN Stanza S ON S.id_stanza = R.id_stanza
                                JOIN Alloggio A ON A.id_alloggio = S.id_alloggio 
                                JOIN Utente U ON U.id_utente = A.id_proprietario
                  WHERE U.email = ?
                  AND R.stato = 'In attesa'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result !== false) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $rows;
        }
        $stmt->close();
        return [];
    }

    public function modifica_stato_richiesta_subaffitto($id_richiesta, $stato){
        $query = "UPDATE Richiesta_Subaffitto
                  SET stato = ?
                  WHERE id_stanza = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $stato, $id_richiesta);
        $stmt->execute();
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
            $result = false;
        }

        $stmt->close();
        return $result;
    }

    public function checkLogin($email, $password)
    {
        $query = "SELECT * FROM Utente WHERE email = ? AND password = ?";
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



// Recupera segnalazioni incluse le categorie
public function getSegnalazioniDettagliate() {
    $query = "SELECT S.*, 
              U1.email as email_segnalatore, 
              U2.email as email_segnalato,
              A.indirizzo as indirizzo_alloggio
              FROM Segnalazione S
              JOIN Utente U1 ON S.id_utente_segnalatore = U1.id_utente
              LEFT JOIN Utente U2 ON S.id_utente_segnalato = U2.id_utente
              LEFT JOIN Alloggio A ON S.id_alloggio_segnalato = A.id_alloggio
              ORDER BY S.data_segnalazione DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Recupera tutti gli annunci del sito per la gestione admin
public function getAllAnnunciAdmin() {
    $query = "SELECT A.*, U.email as email_proprietario 
              FROM Alloggio A 
              JOIN Utente U ON A.id_proprietario = U.id_utente 
              ORDER BY A.data_pubblicazione DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function inviaBroadcast($testo) {
    // Inserisce una riga in Notifica per ogni id_utente trovato nella tabella Utente
    $query = "INSERT INTO Notifica (id_utente, testo, letta) 
              SELECT id_utente, ?, 0 FROM Utente";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("s", $testo);
    return $stmt->execute();
}

//Recupera le ultime notifiche inviate
public function getStoricoBroadcast($limit = 5) {
    $query = "SELECT testo, data_invio FROM Notifica 
              GROUP BY testo, data_invio 
              ORDER BY data_invio DESC LIMIT ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function getCoverByAlloggioId($idAlloggio) {
    // Cerchiamo l'immagine che ha is_copertina = 1
    $stmt = $this->db->prepare("SELECT percorso_immagine FROM Foto WHERE id_alloggio = ? AND is_copertina = 1 LIMIT 1");
    $stmt->bind_param("i", $idAlloggio);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    
    // Se non esiste una copertina, restituiamo un'immagine di default
    return $result ? $result['percorso_immagine'] : "esempio_alloggio.png"; 
}

public function eliminaAlloggio($idAlloggio) {
    $query = "DELETE FROM Alloggio WHERE id_alloggio = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $idAlloggio);
    return $stmt->execute();
}

// Azione: Elimina Utente (cancella l'account e i suoi annunci se proprietario)
public function eliminaUtente($idUtente) {
    $query = "DELETE FROM Utente WHERE id_utente = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $idUtente);
    return $stmt->execute();
}

// Ignora una segnalazione (la elimina dalla coda senza cancellare l'oggetto segnalato)
public function eliminaSegnalazione($idSegnalazione) {
    $stmt = $this->db->prepare("DELETE FROM Segnalazione WHERE id_segnalazione = ?");
    $stmt->bind_param("i", $idSegnalazione);
    return $stmt->execute();
}

// Recupera solo le stanze disponibili per un determinato alloggio
public function getStanzeDisponibiliByAlloggio($idAlloggio) {
    $stmt = $this->db->prepare("SELECT * FROM Stanza WHERE id_alloggio = ? AND stato = 'Disponibile'");
    $stmt->bind_param("i", $idAlloggio);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function prenotaStanza($idUtente, $idStanza) {
    // Inizia una transazione per sicurezza
    $this->db->begin_transaction();
    try {
        // 1. Inserisci la prenotazione
        $stmt1 = $this->db->prepare("INSERT INTO Prenotazione (id_affittuario, id_stanza, stato) VALUES (?, ?, 'In attesa')");
        $stmt1->bind_param("ii", $idUtente, $idStanza);
        $stmt1->execute();

        // 2. Aggiorna lo stato della stanza (come da tua richiesta)
        $stmt2 = $this->db->prepare("UPDATE Stanza SET stato = 'Non disponibile' WHERE id_stanza = ?");
        $stmt2->bind_param("i", $idStanza);
        $stmt2->execute();

        $this->db->commit();
        return true;
    } catch (Exception $e) {
        $this->db->rollback();
        return false;
    }
}


}

?>