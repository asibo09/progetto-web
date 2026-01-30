<?php if(isset($_GET["msg"])): ?>
    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
        <em class="bi bi-check-circle-fill me-2"></em>
        <?php echo htmlspecialchars($_GET["msg"]); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(isset($_GET["error"])): ?>
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
        <em class="bi bi-exclamation-triangle-fill me-2"></em>
        <?php echo htmlspecialchars($_GET["error"]); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php 
    $a = $templateParams["annuncio"];
    $stanze = $templateParams["stanze"];
    $foto = $templateParams["foto"];
    $firstFoto = count($foto) > 0 ? "upload/" . $foto[0]["percorso_immagine"] : "upload/default.png";
    $isFav = $dbh->isFavorite($idUtente, $idStanza);
    // verifica se esiste almeno una stanza disponibile
    $almenoUnaDisponibile = false;
    foreach($stanze as $s) {
        if($s["stato"] == 'Disponibile') {
            $almenoUnaDisponibile = true;
            break; // trovata una, basta
        }
    }
?>

<nav id="nav-annuncio" class="navbar navbar-light bg-white border-bottom sticky-top shadow-sm py-2">
    <div class="container-xl">
        <div class="d-flex align-items-center w-100 flex-wrap">
            <div class="d-flex align-items-center border-end pe-3 me-3 price-container">
                <img src="<?php echo $firstFoto; ?>" class="rounded-2 me-2" style="width: 45px; height: 45px; object-fit: cover;" alt="Thumbnail">
                <div class="fw-bold text-nowrap fs-5">€ <?php echo (int)$a["prezzo_mensile_alloggio"]; ?></div>
            </div>
            <ul class="nav nav-pills custom-nav-annuncio gap-1 mb-0">
                <li class="nav-item"><a class="nav-link" href="#gallery-section">Foto</a></li>
                <li class="nav-item"><a class="nav-link" href="#descrizione-section">Descrizione</a></li>
                <li class="nav-item"><a class="nav-link" href="#caratteristiche-section">Caratteristiche</a></li>
                <li class="nav-item"><a class="nav-link" href="#prezzi-section">Prezzi</a></li>
                <li class="nav-item"><a class="nav-link" href="#convivenza-section">Convivenza</a></li>
                <li class="nav-item"><a class="nav-link" href="#stanze-section">Stanze</a></li>
            </ul>
        </div>
    </div>
</nav>


    <nav aria-label="breadcrumb" class="mt-3 mb-3">
        <a href="<?php echo $templateParams["back_link"]; ?>" class="link-lista text-info fw-bold text-decoration-none">
            <em class="bi bi-chevron-left"></em> Indietro
        </a>
    </nav>

    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div id="gallery-section" class="gallery-container rounded-4 overflow-hidden shadow-sm mb-4 bg-white" style="height: 400px; position: relative;">
                <div class="row g-1 h-100">

                    <div class="col-8 h-100 main-photo-wrapper position-relative">
                        <div id="carouselAnnuncio" class="carousel slide h-100" data-bs-ride="false">
                            <div class="carousel-inner h-100">
                                <?php foreach($foto as $idx => $f): ?>
                                <div class="carousel-item <?php echo $idx == 0 ? 'active' : ''; ?> h-100">
                                    <img src="upload/<?php echo $f['percorso_immagine']; ?>" alt="Foto <?php echo $idx + 1; ?>" class="img-fit h-100 w-100">
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <button class="carousel-control-prev gallery-arrow" type="button" data-bs-target="#carouselAnnuncio" data-bs-slide="prev">
                                <span class="arrow-circle"><em class="bi bi-chevron-left"></em></span>
                            </button>
                            <button class="carousel-control-next gallery-arrow" type="button" data-bs-target="#carouselAnnuncio" data-bs-slide="next">
                                <span class="arrow-circle"><em class="bi bi-chevron-right"></em></span>
                            </button>
                        </div>
                    </div>

                    <div class="col-4 h-100 d-flex flex-column gap-1">
                        <div class="h-50 overflow-hidden">
                            <img src="<?php echo isset($foto[1]) ? 'upload/'.$foto[1]['percorso_immagine'] : $firstFoto; ?>" class="img-fit h-100 w-100" alt="Anteprima 1">
                        </div>
                        
                        <div class="h-50 position-relative more-photos-trigger overflow-hidden">
                            <img src="<?php echo isset($foto[2]) ? 'upload/'.$foto[2]['percorso_immagine'] : $firstFoto; ?>" class="img-fit h-100 w-100" alt="Anteprima 2">
                            
                            <a href="foto.php?id=<?php echo $a['id_alloggio']; ?>" class="more-photos-overlay text-decoration-none">
                                <span class="fw-bold fs-4 text-center px-2">
                                    <?php 
                                    // Se ci sono più di 2 foto mostriamo il conteggio, altrimenti un testo generico
                                        if(count($foto) > 2) {
                                            echo "+" . (count($foto) - 2) . " foto";
                                        } else {
                                            echo "Vedi Gallery";
                                        }
                                    ?>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="carousel-counter badge rounded-pill px-3 py-2">
                    <span class="current-slide">1</span>/<span class="total-slides"><?php echo count($foto); ?></span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-start mb-1">
                <div>
                    <h1 class="fw-bold h2 mb-1"><?php echo $a["tipo_immobile"]; ?> in <?php echo $a["indirizzo"]; ?>, <?php echo $a["civico"]; ?></h1>
                    <p class="text-muted mb-0"><em class="bi bi-geo-alt-fill me-1 text-danger"></em><?php echo $a["comune"]; ?></p>
                </div>
                <div class="text-end">
                    <span class="text-danger fw-bold fs-2"><?php echo (int)$a["prezzo_mensile_alloggio"]; ?>€</span>
                </div>
            </div>

            <div class="row g-3 mb-5 text-black fw-semibold">
                <div class="col-6 col-md-4"><em class="bi bi-door-open fs-4 me-2"></em><?php echo $a["nr_locali_totali"]; ?> locali</div>
                <div class="col-6 col-md-4"><em class="bi bi-aspect-ratio fs-4 me-2"></em><?php echo $a["superficie_totale"]; ?> m²</div>
                <div class="col-6 col-md-4"><em class="bi bi-badge-wc fs-4 me-2"></em><?php echo $a["nr_bagni_totali"]; ?> bagni</div>
                <div class="col-6 col-md-4"><em class="bi bi-layers fs-4 me-2"></em>Piano <?php echo $a["piano_alloggio"] == 0 ? "Terra" : $a["piano_alloggio"]; ?></div>
                <div class="col-6 col-md-4"><em class="bi bi-arrows-vertical fs-4 me-2"></em><?php echo $a["has_ascensore"] ? "Sì Ascensore" : "No Ascensore"; ?></div>
            </div>

            <section id="descrizione-section" class="anchor-section mb-5">
                <h2 class="h4 fw-bold border-bottom pb-2 mb-3">Descrizione</h2>
                <p><?php echo $a["descrizione"]; ?></p>
            </section>

            <section id="caratteristiche-section" class="anchor-section mb-5">
                <h2 class="h4 fw-bold border-bottom pb-2 mb-4">Caratteristiche</h2>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <div class="col d-flex gap-3">
                        <em class="bi bi-building fs-4 text-black"></em>
                        <div><div class="fw-semibold">Tipologia</div><div class="small text-muted"><?php echo $a["tipo_immobile"]; ?></div></div>
                    </div>
                    <div class="col d-flex gap-3">
                        <em class="bi bi-signpost fs-4 text-black"></em>
                        <div><div class="fw-semibold">Zona</div><div class="small text-muted"><?php if($a["isZonaCampus"]) echo "Campus"; elseif($a["isZonaCentro"]) echo "Centro"; else echo "Altro"; ?></div></div>
                    </div>
                    <div class="col d-flex gap-3">
                        <em class="bi bi-thermometer-half fs-4 text-black"></em>
                        <div><div class="fw-semibold">Riscaldamento</div><div class="small text-muted"><?php echo $a["tipo_riscaldamento"]; ?></div></div>
                    </div>
                    <div class="col d-flex gap-3">
                        <em class="bi bi-bar-chart-steps fs-4 text-black"></em>
                        <div><div class="fw-semibold">Piani edificio</div><div class="small text-muted"><?php echo $a["totale_piani_edificio"]; ?></div></div>
                    </div>
                    <div class="col d-flex gap-3">
                        <em class="bi bi-cup-hot fs-4 text-black"></em>
                        <div><div class="fw-semibold">Cucina</div><div class="small text-muted"><?php echo $a["has_cucina"] ? "Presente" : "Non presente"; ?></div></div>
                    </div>
                    <div class="col d-flex gap-3">
                        <em class="bi bi-moon fs-4 text-black"></em>
                        <div><div class="fw-semibold">Camere da letto</div><div class="small text-muted"><?php echo $a["nr_camere_letto"]; ?></div></div>
                    </div>
                </div>
            </section>

            <section id="prezzi-section" class="anchor-section mb-5">
                <h2 class="h4 fw-bold border-bottom pb-2 mb-4">Prezzo e Costi</h2>
                <div class="row row-cols-1 row-cols-md-2 g-3 small">
                    <div class="col"><strong>Canone mensile:</strong> <?php echo (int)$a["prezzo_mensile_alloggio"]; ?>€</div>
                    <div class="col"><strong>Utenze:</strong> <?php echo ($a["utenza_acqua"] && $a["utenza_luce"]) ? "Incluse" : "Escluse"; ?></div>
                    <div class="col"><strong>Altre spese:</strong> <?php echo (int)$a["costo_utenze_mensile"]; ?>€/mese</div>
                    <div class="col"><strong>Cauzione:</strong> <?php echo (int)$a["cauzione"]; ?>€</div>
                    <div class="col"><strong>Disponibile dal:</strong> <?php echo date("m/Y", strtotime($a["disponibile_dal"])); ?></div>
                    <div class="col"><strong>Permanenza minima:</strong> <?php echo $a["permanenza_minima_mesi"]; ?> mesi</div>
                </div>
            </section>

            <section id="convivenza-section" class="anchor-section mb-5">
                <h2 class="h4 fw-bold border-bottom pb-2 mb-4">Convivenza</h2>
                <div class="row row-cols-1 row-cols-md-2 g-3 small">
                    <div class="col"><strong>Disponibile per:</strong> <?php echo $a["max_persone"]; ?> Persone</div>
                    <div class="col"><strong>Inquilini attuali:</strong> <?php echo $a["nr_coinquilini_attuali"]; ?> (<?php echo $a["occupazione_inquilini"]; ?>)</div>
                    <div class="col"><strong>Genere preferito:</strong> <?php echo $a["genere_inquilini"]; ?></div>
                    <div class="col"><strong>Proprietario in casa:</strong> <?php echo $a["proprietario_vive_casa"] ? "Sì" : "No"; ?></div>
                    <div class="col"><strong>Fumatori:</strong> <?php echo $a["accetta_fumatori"] ? "Ammessi" : "Non ammessi"; ?></div>
                    <div class="col"><strong>Animali:</strong> <?php echo $a["accetta_animali"] ? "Ammessi" : "Da concordare"; ?></div>
                    <div class="col"><strong>Coppie:</strong> <?php echo $a["accetta_coppie"] ? "Accettate" : "Non accettate"; ?></div>
                </div>
            </section>

            <section id="stanze-section" class="anchor-section mb-5">
                <h2 class="h4 fw-bold border-bottom pb-2 mb-4">Stanze disponibili</h2>
                <div class="card border rounded-3 p-3 shadow-sm mb-3 bg-white">
                    <?php 
                    $idLoggato = $_SESSION["id_utente"] ?? -1;
                    $ruoloLoggato = $_SESSION["ruolo"] ?? '';
        
                    foreach($stanze as $index => $s): ?>
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div>
                                <div class="fw-bold">Stanza numero <?php echo $index+1; ?>:</div>
                                <div class="small text-muted">
                                <?php echo $s["nr_letti_singoli"]; ?> Singoli | <?php echo $s["nr_letti_matrimoniali"]; ?> Matrimoniali | <?php echo $s["metratura_stanza"]; ?> m² | Bagno <?php echo $s["tipo_bagno"]; ?>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="text-danger fw-bold mb-1 fs-5"><?php echo (int)$s["prezzo_stanza"]; ?>€</div>
                    
                                    <?php if($s["stato"] == 'Disponibile'): ?>
                                        <?php 
                                        // Controllo: Solo chi NON è proprietario e NON è admin può prenotare
                                        if($templateParams["annuncio"]["id_proprietario"] != $idLoggato && $ruoloLoggato != 'admin'): ?>
                                            <form action="processa-prenotazione.php" method="POST" class="d-inline" 
                                                onsubmit="return confirm('Sei sicuro di voler prenotare la Stanza <?php echo $index + 1; ?>?');">
                                                <input type="hidden" name="id_stanza" value="<?php echo $s["id_stanza"]; ?>">
                                                <input type="hidden" name="id_alloggio" value="<?php echo $templateParams["annuncio"]["id_alloggio"]; ?>">
                                                <button type="submit" class="btn btn-prenota text-info btn-outline-info rounded-3 btn-sm fw-semibold">
                                                    Prenota questa stanza
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <button class="btn btn-outline-success rounded-3 btn-sm fw-semibold opacity-75" disabled style="cursor: default;">
                                                Stanza disponibile
                                            </button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <button class="btn btn-secondary rounded-3 btn-sm fw-semibold opacity-50" disabled>
                                            Stanza non disponibile
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if($index < count($stanze)-1) echo '<hr class="my-3 opacity-25">'; ?>
                    <?php endforeach; ?>
                    </div>
            </section>
        </div>

        <div class="col-12 col-lg-4">
            <div id="utente-section" class="sticky-top anchor-section" style="top: 80px;">
                <div class="card shadow-sm border-0 p-4 rounded-4 mb-3 bg-white">
                    <h2 class="h5 fw-bold border-bottom mb-3">Pubblicato da:</h2>
                    <a href="profilo-altro-utente.php?id=<?php echo $a["id_proprietario"]; ?>" class="text-decoration-none text-dark d-flex align-items-center gap-2 mb-1">
                        <em class="bi bi-person-circle fs-4 text-danger"></em>
                        <span class="nome-utente fw-bold"><?php echo $a["nome"] . " " . $a["cognome"]; ?></span>
                    </a>
                    <span class="text-dark small mb-4">Pubblicato il: <?php echo date("d/m/Y", strtotime($a["data_reg_utente"])); ?></span>
                    
                    <h2 class="h5 fw-bold border-bottom pb-2 mb-3 mt-3">Contatti</h2>
                    <p class="mb-2"><em class="bi bi-envelope me-2"></em><strong>Email:</strong> <a href="mailto:<?php echo $a["email"]; ?>" class="text-dark"><?php echo $a["email"]; ?></a></p>
                    <p class="mb-0"><em class="bi bi-telephone me-2"></em><strong>Telefono:</strong> <a href="tel:<?php echo $a["cellulare"]; ?>" class="text-dark"><?php echo $a["cellulare"]; ?></a></p>
                    
                    <div class="d-grid gap-2 mt-3">
                        <?php
                        $idLoggato = $_SESSION["id_utente"] ?? -1;
                        if($annuncio["id_proprietario"] != $idLoggato && isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] != 'admin'): 
                        
                            if($almenoUnaDisponibile): ?>
                                <a href="javascript:void(0)" 
                                    class="btn btn-prenota text-info btn-outline-info py-2 rounded-3 fw-bold shadow-sm btn-apri-prenota"
                                    data-id="<?php echo $a["id_alloggio"]; ?>" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalPrenotazione"
                                    role="button">
                                    <em class="bi bi-calendar-check me-2"></em>Prenota
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary py-2 rounded-3 fw-bold shadow-sm opacity-50" disabled>
                                    <em class="bi bi-calendar-x me-2"></em>Non disponibile
                                </button>
                            <?php endif; ?>
                            <button class="btn btn-outline-danger py-2 rounded-3 fw-bold btn-cuore <?php echo $isFav ? 'active' : ''; ?>" data-id="<?php echo $annuncio["id_alloggio"]; ?>">
                                <em class="bi heart-icon me-2"></em>Salva
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($annuncio["id_proprietario"] != $idLoggato && isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] != 'admin'): ?>
                <div class="text-center">
                    <a href="segnalazione.php?tipo=annuncio&id=<?php echo $a["id_alloggio"]; ?>" class="btn btn-warning text-decoration-none">
                        <em class="bi bi-exclamation-triangle-fill me-1"></em> Segnala annuncio
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


<script>
    //contatore caroselli
    document.querySelectorAll('.carousel').forEach(carousel => {
        const galleryContainer = carousel.closest('.gallery-container') || carousel;
        const currentSpan = galleryContainer.querySelector('.current-slide');
        const totalSpan = galleryContainer.querySelector('.total-slides');
        const items = carousel.querySelectorAll('.carousel-item');
        if (totalSpan) totalSpan.textContent = items.length;

        carousel.addEventListener('slid.bs.carousel', function (event) {
            if (currentSpan) currentSpan.textContent = event.to + 1;
        });
    });
</script>