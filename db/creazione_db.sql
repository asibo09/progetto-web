-- Creazione del Database
CREATE DATABASE IF NOT EXISTS GestioneAffitti;
USE GestioneAffitti;

-- ==========================================
-- 1. GESTIONE UTENTI
-- ==========================================

CREATE TABLE Utente (
    id_utente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    cellulare VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    eta INT,
    ruolo ENUM('studente', 'proprietario', 'admin') DEFAULT 'studente',
    data_registrazione DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ==========================================
-- 2. GESTIONE ALLOGGI
-- ==========================================

CREATE TABLE Alloggio (
    id_alloggio INT AUTO_INCREMENT PRIMARY KEY,
    id_proprietario INT NOT NULL,
    
    -- Sezione: Tipologia e caratteristiche immobile
    tipo_immobile VARCHAR(50) NOT NULL,
    superficie_totale INT NOT NULL,
    totale_piani_edificio INT,
    piano_alloggio INT,
    has_ascensore BOOLEAN DEFAULT 0,
    tipo_riscaldamento ENUM('Autonomo', 'Centralizzato', 'Assente') NOT NULL,
    
    -- Sezione: Composizione
    has_cucina BOOLEAN DEFAULT 0,
    nr_camere_letto INT DEFAULT 1,
    nr_locali_totali INT DEFAULT 1,
    nr_bagni_totali INT DEFAULT 1,

    -- Sezione: Località
    comune VARCHAR(50) NOT NULL,
    indirizzo VARCHAR(255) NOT NULL,
    civico INT NOT NULL,
    isZonaCampus BOOLEAN DEFAULT 0,
    isZonaCentro BOOLEAN DEFAULT 0,
    isZonaStazione BOOLEAN DEFAULT 0,
    isZonaAltro BOOLEAN DEFAULT 0,
    distanza_campus_km DECIMAL(5,2),
    distanza_centro_km DECIMAL(5,2),

    -- Sezione: Convivenza
    max_persone INT DEFAULT 1,
    nr_coinquilini_attuali INT DEFAULT 0,
    genere_inquilini ENUM('Maschile', 'Femminile', 'Entrambi', 'Non presenti') DEFAULT 'Non presenti',
    occupazione_inquilini ENUM('Studenti', 'Lavoratori', 'Entrambi', 'Non presenti') DEFAULT 'Non presenti',
    proprietario_vive_casa BOOLEAN DEFAULT 0,
    accetta_animali BOOLEAN DEFAULT 0,
    accetta_fumatori BOOLEAN DEFAULT 0,
    accetta_coppie BOOLEAN DEFAULT 0,
    
    -- Sezione Prezzo e costi:
    prezzo_mensile_alloggio DECIMAL(10, 2) NOT NULL,
    cauzione DECIMAL(10, 2),
    costo_utenze_mensile DECIMAL(10, 2), -- Costo se non incluse
    disponibile_dal DATE,
    permanenza_minima_mesi INT DEFAULT 12,
    -- Utenze incluse
    utenza_acqua BOOLEAN DEFAULT 0,
    utenza_internet BOOLEAN DEFAULT 0,
    utenza_gas BOOLEAN DEFAULT 0,
    utenza_luce BOOLEAN DEFAULT 0,

    -- Sezione: Descrizione
    descrizione TEXT,
    data_pubblicazione DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_proprietario) REFERENCES Utente(id_utente) ON DELETE CASCADE
);

-- ==========================================
-- 3. GESTIONE STANZE
-- ==========================================

-- Ogni alloggio può avere una o più stanze con prezzi diversi
CREATE TABLE Stanza (
    id_stanza INT AUTO_INCREMENT PRIMARY KEY,
    id_alloggio INT NOT NULL,
    metratura_stanza INT NOT NULL,
    nr_letti_singoli INT DEFAULT 0,
    nr_letti_matrimoniali INT DEFAULT 0,
    tipo_bagno ENUM('Privato', 'Condiviso') DEFAULT 'Privato',
    has_balcone BOOLEAN DEFAULT 0,
    prezzo_stanza DECIMAL(10, 2) NOT NULL,
	stato ENUM('Disponibile', 'Non disponibile') DEFAULT 'Disponibile',
    FOREIGN KEY (id_alloggio) REFERENCES Alloggio(id_alloggio) ON DELETE CASCADE
);

-- ==========================================
-- 4. FOTO, PREFERITI E OPERAZIONI
-- ==========================================

-- Foto degli alloggi (fino a 20 per annuncio)
CREATE TABLE Foto (
    id_foto INT AUTO_INCREMENT PRIMARY KEY,
    id_alloggio INT NOT NULL,
    percorso_immagine VARCHAR(255) NOT NULL,
    is_copertina BOOLEAN DEFAULT 0,
    FOREIGN KEY (id_alloggio) REFERENCES Alloggio(id_alloggio) ON DELETE CASCADE
);

CREATE TABLE Preferiti (
    id_utente INT NOT NULL,
    id_alloggio INT NOT NULL,
    data_preferito DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_utente, id_alloggio),
    FOREIGN KEY (id_utente) REFERENCES Utente(id_utente) ON DELETE CASCADE,
    FOREIGN KEY (id_alloggio) REFERENCES Alloggio(id_alloggio) ON DELETE CASCADE
);

CREATE TABLE Prenotazione (
    id_prenotazione INT AUTO_INCREMENT PRIMARY KEY,
    id_affittuario INT NOT NULL,
    id_stanza INT NOT NULL,
    data_richiesta DATETIME DEFAULT CURRENT_TIMESTAMP,
    stato ENUM('In attesa', 'Confermata', 'Rifiutata') DEFAULT 'In attesa',
    FOREIGN KEY (id_affittuario) REFERENCES Utente(id_utente) ON DELETE CASCADE,
    FOREIGN KEY (id_stanza) REFERENCES Stanza(id_stanza) ON DELETE CASCADE
);

CREATE TABLE Richiesta_Subaffitto (
    id_richiesta INT AUTO_INCREMENT PRIMARY KEY,
    id_mittente INT NOT NULL, 
    id_stanza INT NOT NULL,
    messaggio TEXT,
    stato ENUM('In attesa', 'Confermata', 'Rifiutata') DEFAULT 'In attesa',
    FOREIGN KEY (id_mittente) REFERENCES Utente(id_utente) ON DELETE CASCADE,
    FOREIGN KEY (id_stanza) REFERENCES Stanza(id_stanza) ON DELETE CASCADE
);

CREATE TABLE Notifica (
    id_notifica INT AUTO_INCREMENT PRIMARY KEY,
    id_utente INT NOT NULL,
    testo VARCHAR(255) NOT NULL,
    letta BOOLEAN DEFAULT 0,
    data_invio DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utente) REFERENCES Utente(id_utente) ON DELETE CASCADE
);

CREATE TABLE Segnalazione (
    id_segnalazione INT AUTO_INCREMENT PRIMARY KEY,
    id_utente_segnalatore INT NOT NULL,
    
    -- Riferimenti opzionali: entrambi possono essere NULL, ma il vincolo sotto ne obbliga uno
    id_alloggio_segnalato INT DEFAULT NULL, 
    id_utente_segnalato INT DEFAULT NULL,   
    
    categoria ENUM('Contenuto inappropriato', 'Sospetto truffa', 'Comportamento scorretto', 'Altro'),
    descrizione TEXT NOT NULL,
    stato ENUM('Aperta', 'In revisione', 'Risolta') DEFAULT 'Aperta',
    data_segnalazione DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_utente_segnalatore) REFERENCES Utente(id_utente) ON DELETE CASCADE,
    FOREIGN KEY (id_alloggio_segnalato) REFERENCES Alloggio(id_alloggio) ON DELETE CASCADE,
    FOREIGN KEY (id_utente_segnalato) REFERENCES Utente(id_utente) ON DELETE CASCADE,
    
    -- VINCOLO FONDAMENTALE: Obbliga a segnalare O un alloggio O un utente (non entrambi e non nessuno)
    CONSTRAINT check_bersaglio_segnalazione CHECK (
        (id_alloggio_segnalato IS NOT NULL AND id_utente_segnalato IS NULL) OR
        (id_alloggio_segnalato IS NULL AND id_utente_segnalato IS NOT NULL)
    )
);

CREATE TABLE Ricerca_alloggio (
    id_ricerca INT AUTO_INCREMENT PRIMARY KEY,
    id_studente INT NOT NULL,
    id_alloggio INT NOT NULL,
    data_ricerca DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_studente) REFERENCES Utente(id_utente) ON DELETE CASCADE,
    FOREIGN KEY (id_alloggio) REFERENCES Alloggio(id_alloggio) ON DELETE CASCADE
);