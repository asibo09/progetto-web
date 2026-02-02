<div class="container-fluid mt-4">
    <div class="row">

        <!-- Pulsante per Offcanvas (visibile solo su schermi piccoli) -->
        <div class="d-lg-none mb-3 text-center">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtriOffcanvas" aria-controls="filtriOffcanvas">
                <i class="bi bi-funnel-fill"></i> Mostra Filtri
            </button>
        </div>

        <!-- Sidebar dei Filtri (Offcanvas su schermi piccoli) -->
        <div class="col-lg-3">
            <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="filtriOffcanvas" aria-labelledby="filtriOffcanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="filtriOffcanvasLabel">Filtri di Ricerca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#filtriOffcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form action="risultatiRicerca.php" method="GET">
                        <!-- Cerca per Luogo -->
                        <div class="mb-3">
                            <label for="luogo" class="form-label fw-bold">Luogo</label>
                            <input name="luogo" id="luogo" class="form-control" type="search" placeholder="Es. Cesena, Centro" value="<?php echo htmlspecialchars($_GET['luogo'] ?? ''); ?>">
                        </div>
                        
                        <!-- Mesi e Persone -->
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label for="nmesi" class="form-label fw-bold">Mesi</label>
                                <input name="nmesi" id="nmesi" class="form-control" type="number" min="1" max="60" placeholder="N. mesi" value="<?php echo htmlspecialchars($_GET['nmesi'] ?? '1'); ?>">
                            </div>
                            <div class="col-6">
                                <label for="npersone" class="form-label fw-bold">Persone</label>
                                <input name="npersone" id="npersone" class="form-control" type="number" min="1" max="8" placeholder="Persone" value="<?php echo htmlspecialchars($_GET['npersone'] ?? '1'); ?>">
                            </div>
                        </div>

                        <!-- Filtro Prezzo -->
                        <div class="mb-4">
                            <label for="prezzo-max" class="form-label fw-bold">Prezzo Massimo</label>
                            <div class="d-flex align-items-center">
                                <input type="range" class="form-range" id="prezzo-max" name="prezzo_max" min="100" max="2000" step="50" oninput="this.nextElementSibling.value = this.value">
                                <output class="ms-2 fw-bold">2000</output><span>€</span>
                            </div>
                        </div>

                        <!-- Filtro Tipologia -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Tipologia</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tipologia[]" value="appartamento" id="tipo-appartamento">
                                <label class="form-check-label" for="tipo-appartamento">Appartamento</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tipologia[]" value="stanza singola" id="tipo-stanza-singola">
                                <label class="form-check-label" for="tipo-stanza-singola">Stanza Singola</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tipologia[]" value="stanza doppia" id="tipo-stanza-doppia">
                                <label class="form-check-label" for="tipo-stanza-doppia">Stanza Doppia</label>
                            </div>
                        </div>

                        <!-- Filtro Zona -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Zona</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="zona[]" value="isZonaCampus" id="zona-campus">
                                <label class="form-check-label" for="zona-campus">Vicino al Campus</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="zona[]" value="isZonaCentro" id="zona-centro">
                                <label class="form-check-label" for="zona-centro">In Centro</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="zona[]" value="isZonaStazione" id="zona-stazione">
                                <label class="form-check-label" for="zona-stazione">Vicino alla Stazione</label>
                            </div>
                        </div>

                        <!-- Filtro Caratteristiche -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Caratteristiche</h6>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="has_ascensore" value="1" id="check-ascensore">
                                <label class="form-check-label" for="check-ascensore">Ascensore</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="accetta_animali" value="1" id="check-animali">
                                <label class="form-check-label" for="check-animali">Animali ammessi</label>
                            </div>
                        </div>

                        <!-- Filtro Utenze -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Utenze Incluse</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="utenza_internet" value="1" id="check-internet">
                                <label class="form-check-label" for="check-internet">Internet</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="utenza_acqua" value="1" id="check-acqua">
                                <label class="form-check-label" for="check-acqua">Acqua</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn bg-unibo-red w-100">Applica Filtri</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Colonna Risultati della Ricerca -->
        <div class="col-lg-9">
            <div class="d-flex flex-column gap-3">
                <?php if (empty($templateParams['SearchResults'])): ?>
                    <div class="alert alert-info" role="alert">
                        Nessun risultato trovato per la tua ricerca. Prova a modificare i filtri.
                    </div>
                <?php else: ?>
                    <ul class="row g-3 list-unstyled" role="list" aria-label="Risultati della ricerca">
                        <?php foreach ($templateParams['SearchResults'] as $search): ?>
                            <li class="col-12 list-unstyled">
                                <!-- Contenuto della Card (come prima) -->
                                <div class="card rounded-3 overflow-hidden shadow-sm position-relative card-annuncio-hover border-0 bg-light-subtle">
                                    <div class="row g-0 align-items-stretch">
                                        <!-- Carousel Column -->
                                        <div class="col-12 col-md-4 border-end position-relative custom-carousel-container" style="min-height: 220px; height: auto !important;">
                                             <div id="carousel-<?php echo $search['id_alloggio']; ?>" class="carousel slide position-absolute top-0 start-0 w-100 h-100" data-bs-ride="false">
                                                <div class="carousel-inner h-100">
                                                    <?php 
                                                        $fotos = $dbh->fotoAlloggio($search['id_alloggio']);    
                                                        $isFirst = true;
                                                        foreach ($fotos as $foto): 
                                                    ?>
                                                    <div class="carousel-item h-100 <?php if($isFirst) { echo 'active'; $isFirst = false; } ?>">
                                                        <img src="<?php echo UPLOAD_DIR . $foto['percorso_immagine']; ?>" class="img-fit" alt="Foto alloggio">
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <button class="carousel-control-prev custom-arrow" type="button" data-bs-target="#carousel-<?php echo $search['id_alloggio']; ?>" data-bs-slide="prev">
                                                    <span class="arrow-circle bg-white text-dark rounded-circle p-1 shadow-sm"><i class="bi bi-chevron-left"></i></span>
                                                </button>
                                                <button class="carousel-control-next custom-arrow" type="button" data-bs-target="#carousel-<?php echo $search['id_alloggio']; ?>" data-bs-slide="next">
                                                    <span class="arrow-circle bg-white text-dark rounded-circle p-1 shadow-sm"><i class="bi bi-chevron-right"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- Details Column -->
                                        <div class="col-12 col-md-8">
                                            <div class="card-body p-4 d-flex flex-column h-100">
                                                <div class="mb-auto">
                                                    <a href="annuncio.php?id=<?php echo $search['id_alloggio']; ?>" class="stretched-link text-decoration-none text-dark">
                                                        <h3 class="h5 fw-bold mb-2"><?php echo $search['tipo_immobile']; ?></h3>
                                                    </a>
                                                    <p class="text-muted small mb-1">
                                                        <i class="bi bi-geo-alt-fill me-1 text-danger"></i><?php echo $search['indirizzo']; ?>
                                                    </p>
                                                    <p class="small text-secondary mb-3">Distanza dal campus: <?php echo $search['distanza_campus_km']; ?> km</p>
                                                </div>
                                                <div class="d-flex align-items-center flex-wrap gap-3 mt-3">
                                                    <span class="fw-bold fs-4 text-primary"><?php echo $search['prezzo_mensile_alloggio']; ?>€/mese</span>
                                                    <button type="button" class="btn btn-link p-2 btn-cuore active" data-id="<?php echo $annuncio["id_alloggio"]; ?>">
                                                        <em class="bi heart-icon fs-4"></em>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>