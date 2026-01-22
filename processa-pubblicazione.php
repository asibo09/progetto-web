<?php
require_once 'bootstrap.php';

function parseBool($val) {
    return ($val === "Sì" || $val === "1" || $val === 1 || $val === "on") ? 1 : 0;
}

$idProprietario = $_SESSION["id_utente"] ?? 2;

// FIX per i radio button senza attributo 'value' nell'HTML
$riscaldamento = ($_POST["riscaldamento"] == "on") ? "Autonomo" : ($_POST["riscaldamento"] ?? "Assente");
// Invece di accedere direttamente, usa ?? per definire un default
$genere = $_POST["genere-inq"] ?? "Non presenti";
$occupazione = $_POST["occ-inq"] ?? "Non presenti";

// Se arriva "on" (perché manca il value nell'HTML), sistemalo:
if($genere === "on") $genere = "Entrambi";
if($occupazione === "on") $occupazione = "Studenti";

$dati = [
    'tipo_immobile'     => $_POST["tipo_immobile"],
    'superficie_totale' => (int)$_POST["mq_totali"],
    'totale_piani'      => (int)$_POST["tot_piani"],
    'piano'             => (int)$_POST["piano"],
    'has_ascensore'     => ($_POST["ascensore"] === "Sì" ? 1 : 0),
    'riscaldamento'     => $riscaldamento,
    'has_cucina'        => parseBool($_POST["cucina"]),
    'nr_camere'         => (int)$_POST["nr_camere"],
    'nr_locali'         => (int)$_POST["nr_locali"],
    'nr_bagni'          => (int)$_POST["nr_bagni"],
    'comune'            => $_POST["comune"],
    'indirizzo'         => $_POST["indirizzo"],
    'civico'            => (int)$_POST["civico"],
    'z_campus'          => isset($_POST["z-campus"]) ? 1 : 0,
    'z_centro'          => isset($_POST["z-centro"]) ? 1 : 0,
    'z_stazione'        => isset($_POST["z-stazione"]) ? 1 : 0,
    'z_altro'           => isset($_POST["z-altro"]) ? 1 : 0,
    'dist_campus'       => (double)$_POST["dist-campus"],
    'dist_centro'       => (double)$_POST["dist-centro"],
    'max_persone'       => (int)$_POST["disp-persone"],
    'coinquilini'       => (int)$_POST["current_coinq"],
    'genere'            => $genere,
    'occupazione'       => $occupazione,
    'vive_casa'         => parseBool($_POST["prop-casa"]),
    'animali'           => isset($_POST["rule-anim"]) ? 1 : 0,
    'fumatori'          => isset($_POST["rule-fum"]) ? 1 : 0,
    'coppie'            => isset($_POST["rule-coppie"]) ? 1 : 0,
    'prezzo_alloggio'   => (double)$_POST["canone"],
    'cauzione'          => (double)$_POST["cauzione"],
    'utenze_euro'       => (double)($_POST["costo-utenze"] ?? 0),
    'data_dispo'        => !empty($_POST["disponibile-dal"]) ? $_POST["disponibile-dal"] . "-01" : null,
    'perm_min'          => (int)$_POST["perm-min"],
    'u_acqua'           => isset($_POST["ut-acqua"]) ? 1 : 0,
    'u_internet'        => isset($_POST["ut-internet"]) ? 1 : 0,
    'u_gas'             => isset($_POST["ut-gas"]) ? 1 : 0,
    'u_luce'            => isset($_POST["ut-luce"]) ? 1 : 0,
    'descrizione'       => $_POST["descrizione"]
];

$idAlloggio = $dbh->inserisciAlloggio($idProprietario, $dati);

if($idAlloggio) {
    // Gestione Foto
    if(isset($_FILES["foto_alloggio"]) && !empty($_FILES["foto_alloggio"]["name"][0])) {
    $files = $_FILES["foto_alloggio"];
    
    foreach($files["name"] as $key => $name) {
        if($files["error"][$key] == 0) {
            $currentFile = [
                "name"     => $files["name"][$key],
                "type"     => $files["type"][$key],
                "tmp_name" => $files["tmp_name"][$key],
                "error"    => $files["error"][$key],
                "size"     => $files["size"][$key]
            ];
            
            // uploadImage sposta fisicamente il file e restituisce il nuovo nome
            list($result, $msg) = uploadImage(UPLOAD_DIR, $currentFile);
            
            if($result == 1) { // 1 significa successo
                // Se è la prima immagine del ciclo, impostala come copertina (1), altrimenti (0)
                $isCopertina = ($key == 0) ? 1 : 0;
                $dbh->inserisciFoto($idAlloggio, $msg, $isCopertina);
            }
        }
    }
}

//Inserimento stanze
$numeroStanzeForm = $_POST["stanze"]; 

for($i = 1; $i <= $numeroStanzeForm; $i++) {
    $mq_s = (int)$_POST["mq-$i"];
    $prezzo_s = (float)$_POST["prezzo-$i"];
    $letti_s = (int)$_POST["letto-s-$i"];
    $letti_m = (int)$_POST["letto-m-$i"];
    $bagno_s = $_POST["bagno-$i"]; 
    $balcone_s = parseBool($_POST["balcone-$i"] ?? "No");
    
    $dbh->inserisciStanza($idAlloggio, $mq_s, $prezzo_s, $letti_s, $letti_m, $bagno_s, $balcone_s);
    }
    $msg = "Annuncio pubblicato con successo!";
    header("location: index.php?msg=" . urlencode($msg));
} else {
    echo "Errore DB: " . $dbh->db->error; 
}
?>