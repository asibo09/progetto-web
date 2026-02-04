# 🏠 Unibo Affitti

**Progetto per il corso di Tecnologie Web (A.A. 2025/2026), Ingegneria e Scienze Informatiche, Università di Bologna - Cesena.**

Un portale web gestionale progettata per digitalizzare e ricercare offerte di alloggi universitari. Il sistema funge da punto di incontro certificato tra chi offre una soluzione abitativa (proprietari o studenti uscenti) e chi ne ha bisogno (studenti iscritti al Campus), sotto la supervisione dell'Amministratore Universitario.

---

## 🚀 Funzionalità Principali

### Funzionalità per l'Utente Studente
L'interfaccia dedicata agli studenti è ottimizzata per la velocità di consultazione e la sicurezza:
* **Ricerca Avanzata e Filtri**: possibilità di filtrare gli annunci per zona (Campus, Centro, Stazione), durata del contratto (numero di mesi), numero di posti ancora disponibili e budget.
* **Gestione Preferiti**: salvataggio degli annunci di interesse in una sezione dedicata per permettere una consultazione differita.
* **Dettaglio Alloggio**: panoramica completa con carosello di foto, descrizioni testuali, dotazioni tecniche e distanze calcolate dai punti di interesse.
* **Richiesta di Delega (Subaffitto)**: permette a uno studente di richiedere al proprietario l'autorizzazione a ripubblicare l’annuncio per trovare un subentrante e liberarsi dal vincolo del pagamento del contratto.

### Funzionalità per l'Utente Proprietario
Il sistema offre ai proprietari strumenti semplici e diretti per gestire i propri immobili:
* **Inserimento Guidato**: processo di creazione di un annuncio diviso in step logici (Tipologia, Località, Caratteristiche, Prezzo, Convivenza, Foto) con validazione dei dati obbligatori.
* **I tuoi annunci**: dashboard personale dove il proprietario può monitorare lo stato delle proprie pubblicazioni o eliminarle definitivamente.
* **Gestione Deleghe e Prenotazioni**: ricezione di notifiche in tempo reale per le richieste di subaffitto e prenotazione stanze, con interfaccia dedicata per l'approvazione o il rifiuto immediato.

### Dashboard di Amministrazione
L'Amministratore dispone di poteri di supervisione totali per garantire l'integrità e la qualità del portale:
* **Lista Segnalazioni**: gestione dei ticket aperti dagli utenti su profili o annunci sospetti. L'admin può visionare i dettagli e decidere se ignorare la segnalazione, bannare l'utente o rimuovere l'annuncio.
* **Lista Annunci**: accesso globale a tutti gli annunci pubblicati sul sito con facoltà di modifica dei dati o eliminazione in caso di violazione del regolamento.
* **Comunicazioni Broadcast**: sistema di invio notifiche testuali istantanee a tutta la base utenti per avvisi urgenti, manutenzioni o comunicazioni istituzionali.

---

## 📂 Struttura del Progetto

```text
progetto-web/
├── css/
│   └── style.css                                 # Stili personalizzati CSS
├── db/
│   └── creazione_db.sql                          # Creazione delle tabelle del database
│   └── database.php                              # Classe DatabaseHelper (connessione e query SQL)
│   └── insert_data.sql                           # Inserimento dati nel database
├── docs/
│   └── Relazione.pdf                             # Relazione dettagliata dell’applicativo
│   └── Design.pdf                                # Relazione riguardante esclusivamente il design
├── js/
│   └── [Script].js                               # Script lato client per interazioni asincrone
├── template/                                     # Componenti della vista
│   ├── base.php                                  # Struttura principale
│   └── [Pagina]-content.php                      # Contenuti dinamici di tutte le pagine
├── upload/                                       # Directory per i file multimediali
│   ├── logoUnibo.png                             # Logo dell’Università di Bologna
│   └── [foto_alloggi]                            # Immagini caricate dagli utenti proprietari degli alloggi
├── utils/
│   └── functions.php                             # Funzioni helper globali 
├── website/
│   └── [Pagina].html                             # Pagine HTML statiche
└── [Controller PHP]                              # Punti di ingresso e logica di business
```
---

## 💻 Setup

1. **Ambiente**: Scaricare o clonare il repository in `htdocs` di XAMPP.
2. **Database**: Su phpMyAdmin, creare il database `gestioneaffitti` e importare i file `creazione_db.sql` e `insert_data.sql` presenti nella cartella `db/`.
3. **Avvio**: Navigare all'indirizzo `http://localhost/progetto-web/`.

---

## 👥 Team di Sviluppo

Aresu Marco, Fronzi Andrea, Siboni Pietro
