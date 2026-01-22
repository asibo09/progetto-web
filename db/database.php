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
        $query = "SELECT * FROM Alloggio WHERE comune LIKE ? AND permanenza_minima_mesi <= ? AND max_persone >= ?";
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
}
?>