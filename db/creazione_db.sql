-- ==========================================
-- DATABASE GESTIONE AFFITTI (Ordinato A-Z)
-- ==========================================

CREATE TABLE Admin (
    email VARCHAR(150) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cognome VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    eta INT,
    dataReg DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Affittuario(
    email VARCHAR(150) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cognome VARCHAR(100) NOT NULL,
    cellulare VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    eta INT,
    dataReg DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Localita (
    cap VARCHAR(10) PRIMARY KEY,
    nome_citta VARCHAR(100) NOT NULL
);

CREATE TABLE Proprietario (
    email VARCHAR(150) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cognome VARCHAR(100) NOT NULL,
    cellulare VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    eta INT,
    dataReg DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Alloggio (
    id_alloggio INT NOT NULL,
    email_proprietario VARCHAR(150) NOT NULL,
    cap VARCHAR(10) NOT NULL,
    descrizione TEXT,
    n_persone_max INT DEFAULT 1,
    superficie_totale INT NOT NULL,
    piano_alloggio INT NOT NULL,
    piani_alloggio INT NOT NULL,
    via VARCHAR(150) NOT NULL,
    numero_civico VARCHAR(20) NOT NULL,
    solo_maschi BOOLEAN DEFAULT FALSE,
    solo_femmine BOOLEAN DEFAULT FALSE,
    accetta_animali BOOLEAN DEFAULT FALSE,
    accetta_fumatori BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (email_proprietario) REFERENCES Proprietario(email),
    FOREIGN KEY (cap) REFERENCES Localita(cap),
    PRIMARY KEY (email_proprietario, id_alloggio)
);

CREATE TABLE Tipo_Bolletta (
    tipo VARCHAR(50) PRIMARY KEY -- es. Luce, Gas, Internet
);

CREATE TABLE Bolletta (    
    email_proprietario VARCHAR(150) NOT NULL,
    id_alloggio INT NOT NULL,
    tipo VARCHAR(50) NOT NULL, 
    inclusa BOOLEAN,
    FOREIGN KEY (email_proprietario, id_alloggio) REFERENCES Alloggio(email_proprietario, id_alloggio) ON DELETE CASCADE,
    FOREIGN KEY (tipo) REFERENCES Tipo_Bolletta(tipo),
    PRIMARY KEY (email_proprietario, id_alloggio, tipo)
);

CREATE TABLE Caratteristica_Tipo (
    id_caratteristica INT PRIMARY KEY, -- Aggiunto ID numerico per coerenza con la FK sotto
    descrizione_tipo VARCHAR(100) 
);

CREATE TABLE Stanza_Affittabile (
    id_stanza INT NOT NULL,
    id_alloggio INT NOT NULL,
    email_proprietario VARCHAR(150) NOT NULL,
    metratura INT,
    disponibile BOOLEAN DEFAULT TRUE, 
    mesi_disponibili varchar(100),
    disponibile_dal DATE,
    fino_a DATE,
    FOREIGN KEY (email_proprietario, id_alloggio) REFERENCES Alloggio(email_proprietario, id_alloggio) ON DELETE CASCADE,
    PRIMARY KEY (email_proprietario, id_alloggio, id_stanza)
);

CREATE TABLE Caratteristica_Stanza (
    id_stanza INT NOT NULL,
    email_proprietario VARCHAR(150) NOT NULL,
    id_alloggio INT NOT NULL,
    id_caratteristica INT NOT NULL,
    numero_caratteristica INT,
    FOREIGN KEY (id_caratteristica) REFERENCES Caratteristica_Tipo(id_caratteristica) ON DELETE CASCADE,
    FOREIGN KEY (email_proprietario, id_alloggio, id_stanza) REFERENCES Stanza_Affittabile(email_proprietario, id_alloggio, id_stanza) ON DELETE CASCADE,
    PRIMARY KEY (email_proprietario, id_alloggio, id_stanza, id_caratteristica)
);

CREATE TABLE Costo (
    id_costo INT, -- Nota: se è 1:1 con stanza, id_costo potrebbe essere ridondante
    id_stanza INT NOT NULL, 
    email_proprietario VARCHAR(150) NOT NULL,
    id_alloggio INT NOT NULL,
    prezzo_stanza INT NOT NULL,
    cauzione INT,
    FOREIGN KEY (email_proprietario, id_alloggio, id_stanza) REFERENCES Stanza_Affittabile(email_proprietario, id_alloggio, id_stanza) ON DELETE CASCADE,
    UNIQUE (email_proprietario, id_alloggio, id_stanza), -- Relazione 1:1
    PRIMARY KEY (id_costo, email_proprietario, id_alloggio, id_stanza)
);

CREATE TABLE Foto (
    id_alloggio INT NOT NULL,
    id_foto INT NOT NULL,
    email_proprietario VARCHAR(150) NOT NULL,
    url_foto VARCHAR(255) NOT NULL,
    FOREIGN KEY (email_proprietario, id_alloggio) REFERENCES Alloggio(email_proprietario, id_alloggio) ON DELETE CASCADE,
    PRIMARY KEY (email_proprietario, id_alloggio, id_foto)
);

CREATE TABLE Notifica (
    id_notifica INT,
    testo TEXT NOT NULL,
    data_invio DATETIME DEFAULT CURRENT_TIMESTAMP,
    per_affittuario BOOLEAN,
    per_proprietario BOOLEAN,
    email_admin VARCHAR(150) NOT NULL,
    Foreign Key (email_admin) REFERENCES Admin(email),
    PRIMARY KEY (id_notifica, email_admin)
);

CREATE TABLE Prenotazione (
    email_affittuario VARCHAR(150) NOT NULL, -- Corretto da INT a VARCHAR
    id_stanza INT NOT NULL,
    id_alloggio INT NOT NULL,
    email_proprietario VARCHAR(150) NOT NULL,
    data_prenotazione DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_inizio DATE NOT NULL,
    data_fine DATE,
    FOREIGN KEY (email_affittuario) REFERENCES Affittuario(email),
    FOREIGN KEY (email_proprietario, id_alloggio, id_stanza) REFERENCES Stanza_Affittabile(email_proprietario, id_alloggio, id_stanza),
    PRIMARY KEY (email_affittuario, email_proprietario, id_alloggio, id_stanza, data_prenotazione)
);

CREATE TABLE Ricerca_alloggio(
    data_ricerca DATETIME DEFAULT CURRENT_TIMESTAMP,
    email_affittuario VARCHAR(150) NOT NULL,
    id_alloggio INT NOT NULL,
    email_proprietario VARCHAR(150) NOT NULL,
    FOREIGN KEY (email_affittuario) REFERENCES Affittuario(email),
    FOREIGN KEY (email_proprietario, id_alloggio) REFERENCES Alloggio(email_proprietario, id_alloggio),
    PRIMARY KEY (data_ricerca, email_affittuario, email_proprietario, id_alloggio)
);

CREATE TABLE Richiesta_Subaffitto (
    email_affittuario_richiedente VARCHAR(150) NOT NULL, -- Corretto da INT a VARCHAR
    id_stanza INT NOT NULL,
    id_alloggio INT NOT NULL,
    email_proprietario VARCHAR(150) NOT NULL,
    stato VARCHAR(50) DEFAULT 'In attesa',
    FOREIGN KEY (email_affittuario_richiedente) REFERENCES Affittuario(email),
    FOREIGN KEY (email_proprietario, id_alloggio, id_stanza) REFERENCES Stanza_Affittabile(email_proprietario, id_alloggio, id_stanza),
    PRIMARY KEY (email_affittuario_richiedente, email_proprietario, id_alloggio, id_stanza)
);

CREATE TABLE Segnalazione (
    id_segnalazione INT AUTO_INCREMENT PRIMARY KEY,
    email_affittuario VARCHAR(150) NOT NULL, -- Corretto da INT a VARCHAR
    email_proprietario VARCHAR(150) NOT NULL, -- Serve per identificare l'alloggio
    id_alloggio INT NOT NULL,
    testo_segnalazione TEXT NOT NULL,
    stato VARCHAR(50) DEFAULT 'Aperta',
    FOREIGN KEY (email_proprietario, id_alloggio) REFERENCES Alloggio(email_proprietario, id_alloggio),
    FOREIGN KEY (email_affittuario) REFERENCES Affittuario(email)
);

CREATE TABLE Stanza_Affittata (
    id_stanza INT NOT NULL,
    id_alloggio INT NOT NULL,
    email_proprietario VARCHAR(150) NOT NULL, -- Rinominato
    email_affittuario VARCHAR(150) NOT NULL,  -- Rinominato per evitare duplicati
    data_inizio DATE NOT NULL,
    data_fine DATE NOT NULL,
    FOREIGN KEY (email_affittuario) REFERENCES Affittuario(email) ON DELETE CASCADE,
    Foreign Key (email_proprietario, id_alloggio, id_stanza) REFERENCES Stanza_Affittabile(email_proprietario, id_alloggio, id_stanza),
    PRIMARY KEY (email_affittuario, email_proprietario, id_alloggio, id_stanza, data_inizio)
);

CREATE TABLE ZonaCasa(
    id_zona INT PRIMARY KEY, -- Aggiunto ID per coerenza con tabella ponte
    tipo VARCHAR(100) -- es. Centro, Universitaria, Periferia
);

CREATE TABLE Zona_In_Alloggio (
    email_proprietario VARCHAR(150) NOT NULL,
    id_alloggio INT NOT NULL,
    id_zona INT NOT NULL,
    numero INT NOT NULL, -- Non chiaro cosa sia "numero", forse distanza?
    FOREIGN KEY (email_proprietario, id_alloggio) REFERENCES Alloggio(email_proprietario, id_alloggio) ON DELETE CASCADE,
    FOREIGN KEY (id_zona) REFERENCES ZonaCasa(id_zona),
    PRIMARY KEY (email_proprietario, id_alloggio, id_zona)
);