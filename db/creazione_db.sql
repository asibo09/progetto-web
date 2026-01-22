Table "Utente" {
  "id_utente" INT [pk, increment]
  "nome" VARCHAR(50) [not null]
  "cognome" VARCHAR(50) [not null]
  "email" VARCHAR(100) [unique, not null]
  "cellulare" VARCHAR(20) [not null]
  "password" VARCHAR(255) [not null]
  "eta" INT
  "ruolo" Utente_ruolo_enum [default: 'studente']
  "data_registrazione" DATETIME [default: `CURRENT_TIMESTAMP`]
}

Table "Alloggio" {
  "id_alloggio" INT [pk, increment]
  "id_proprietario" INT [not null]
  "tipo_immobile" Alloggio_tipo_immobile_enum [not null]
  "superficie_totale" INT [not null]
  "totale_piani_edificio" INT
  "piano_alloggio" INT
  "has_ascensore" BOOLEAN [default: 0]
  "tipo_riscaldamento" Alloggio_tipo_riscaldamento_enum [not null]
  "has_cucina" BOOLEAN [default: 0]
  "nr_camere_letto" INT [default: 1]
  "nr_locali_totali" INT [default: 1]
  "nr_bagni_totali" INT [default: 1]
  "comune" VARCHAR(50) [not null]
  "indirizzo" VARCHAR(255) [not null]
  "civico" INT [not null]
  "isZonaCampus" BOOLEAN [default: 0]
  "isZonaCentro" BOOLEAN [default: 0]
  "isZonaStazione" BOOLEAN [default: 0]
  "isZonaAltro" BOOLEAN [default: 0]
  "distanza_campus_km" DECIMAL(5,2)
  "distanza_centro_km" DECIMAL(5,2)
  "max_persone" INT [default: 1]
  "nr_coinquilini_attuali" INT [default: 0]
  "genere_inquilini" Alloggio_genere_inquilini_enum [default: 'Non presenti']
  "occupazione_inquilini" Alloggio_occupazione_inquilini_enum [default: 'Non presenti']
  "proprietario_vive_casa" BOOLEAN [default: 0]
  "accetta_animali" BOOLEAN [default: 0]
  "accetta_fumatori" BOOLEAN [default: 0]
  "accetta_coppie" BOOLEAN [default: 0]
  "prezzo_mensile_alloggio" DECIMAL(10,2) [not null]
  "cauzione" DECIMAL(10,2)
  "costo_utenze_mensile" DECIMAL(10,2)
  "disponibile_dal" DATE
  "permanenza_minima_mesi" INT [default: 12]
  "utenza_acqua" BOOLEAN [default: 0]
  "utenza_internet" BOOLEAN [default: 0]
  "utenza_gas" BOOLEAN [default: 0]
  "utenza_luce" BOOLEAN [default: 0]
  "descrizione" TEXT
  "data_pubblicazione" DATETIME [default: `CURRENT_TIMESTAMP`]
}

Table "Stanza" {
  "id_stanza" INT [pk, increment]
  "id_alloggio" INT [not null]
  "metratura_stanza" INT [not null]
  "nr_letti_singoli" INT [default: 0]
  "nr_letti_matrimoniali" INT [default: 0]
  "tipo_bagno" Stanza_tipo_bagno_enum [default: 'Privato']
  "has_balcone" BOOLEAN [default: 0]
  "prezzo_stanza" DECIMAL(10,2) [not null]
  "stato" Stanza_stato_enum [default: 'Disponibile']
}

Table "Foto" {
  "id_foto" INT [pk, increment]
  "id_alloggio" INT [not null]
  "percorso_immagine" VARCHAR(255) [not null]
  "is_copertina" BOOLEAN [default: 0]
}

Table "Preferiti" {
  "id_utente" INT [not null]
  "id_alloggio" INT [not null]
  "data_preferito" DATETIME [default: `CURRENT_TIMESTAMP`]

  Indexes {
    (id_utente, id_alloggio) [pk]
  }
}

Table "Prenotazione" {
  "id_prenotazione" INT [pk, increment]
  "id_affittuario" INT [not null]
  "id_stanza" INT [not null]
  "data_richiesta" DATETIME [default: `CURRENT_TIMESTAMP`]
  "stato" Prenotazione_stato_enum [default: 'In attesa']
}

Table "Richiesta_Subaffitto" {
  "id_richiesta" INT [pk, increment]
  "id_mittente" INT [not null]
  "id_stanza" INT [not null]
  "messaggio" TEXT
  "stato" Richiesta_Subaffitto_stato_enum [default: 'In attesa']
}

Table "Notifica" {
  "id_notifica" INT [pk, increment]
  "id_utente" INT [not null]
  "testo" VARCHAR(255) [not null]
  "letta" BOOLEAN [default: 0]
  "data_invio" DATETIME [default: `CURRENT_TIMESTAMP`]
}

Table "Segnalazione" {
  "id_segnalazione" INT [pk, increment]
  "id_utente_segnalatore" INT [not null]
  "id_alloggio_segnalato" INT [default: NULL]
  "id_utente_segnalato" INT [default: NULL]
  "categoria" Segnalazione_categoria_enum
  "descrizione" TEXT [not null]
  "stato" Segnalazione_stato_enum [default: 'Aperta']
  "data_segnalazione" DATETIME [default: `CURRENT_TIMESTAMP`]

  Checks {
    `(id_alloggio_segnalato IS NOT NULL AND id_utente_segnalato IS NULL) OR
        (id_alloggio_segnalato IS NULL AND id_utente_segnalato IS NOT NULL)` [name: 'check_bersaglio_segnalazione']
  }
}

Table "Ricerca_alloggio" {
  "id_ricerca" INT [pk, increment]
  "id_studente" INT [not null]
  "id_alloggio" INT [not null]
  "data_ricerca" DATETIME [default: `CURRENT_TIMESTAMP`]
}