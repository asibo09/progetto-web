<div class="container-fluid mt-4">
    <div class="row">

        <!-- Pulsante per Offcanvas (visibile solo su schermi piccoli) -->
        <div class="d-lg-none mb-3 text-center">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtriOffcanvas" aria-controls="filtriOffcanvas">
                <em class="bi bi-funnel-fill"></em> Mostra Filtri
            </button>
        </div>

        <!-- Sidebar dei Filtri (Offcanvas su schermi piccoli) -->
        <div class="col-lg-3">
            <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="filtriOffcanvas" aria-labelledby="filtriOffcanvasLabel" role="dialog" aria-modal="false">
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
                                <input type="range" class="form-range" id="prezzo-max" name="prezzo_max" min="100" max="2000" step="50" oninput="this.nextElementSibling.value = this.value" value="<?php echo htmlspecialchars($_GET['prezzo_max'] ?? '2000'); ?>">
                                <output class="ms-2 fw-bold"><?php echo htmlspecialchars($_GET['prezzo_max'] ?? '2000'); ?></output><span>€</span>
                            </div>
                        </div>

                        <!-- Filtro Zona -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Zona</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="zona[]" value="isZonaCampus" id="zona-campus" <?php echo (in_array('isZonaCampus', $_GET['zona'] ?? []) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="zona-campus">Vicino al Campus</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="zona[]" value="isZonaCentro" id="zona-centro" <?php echo (in_array('isZonaCentro', $_GET['zona'] ?? []) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="zona-centro">In Centro</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="zona[]" value="isZonaStazione" id="zona-stazione" <?php echo (in_array('isZonaStazione', $_GET['zona'] ?? []) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="zona-stazione">Vicino alla Stazione</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="zona[]" value="isZonaAltro" id="zona-altro" <?php echo (in_array('isZonaAltro', $_GET['zona'] ?? []) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="zona-altro">Altro</label>
                            </div>
                        </div>

                        <!-- Filtro Caratteristiche Avanzate -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Dettagli</h6>
                            
                            <div class="mb-2">
                                <label for="tipo_riscaldamento" class="form-label small">Riscaldamento</label>
                                <select class="form-select form-select-sm" name="tipo_riscaldamento" id="tipo_riscaldamento">
                                    <option value="">Qualsiasi</option>
                                    <option value="Autonomo" <?php echo (($_GET['tipo_riscaldamento'] ?? '') == 'Autonomo' ? 'selected' : ''); ?>>Autonomo</option>
                                    <option value="Centralizzato" <?php echo (($_GET['tipo_riscaldamento'] ?? '') == 'Centralizzato' ? 'selected' : ''); ?>>Centralizzato</option>
                                    <option value="Assente" <?php echo (($_GET['tipo_riscaldamento'] ?? '') == 'Assente' ? 'selected' : ''); ?>>Assente</option>
                                </select>
                            </div>
                            
                            <div class="mb-2">
                                <label for="genere_inquilini" class="form-label small">Genere Inquilini</label>
                                <select class="form-select form-select-sm" name="genere_inquilini" id="genere_inquilini">
                                    <option value="">Qualsiasi</option>
                                    <option value="Maschile" <?php echo (($_GET['genere_inquilini'] ?? '') == 'Maschile' ? 'selected' : ''); ?>>Maschile</option>
                                    <option value="Femminile" <?php echo (($_GET['genere_inquilini'] ?? '') == 'Femminile' ? 'selected' : ''); ?>>Femminile</option>
                                    <option value="Entrambi" <?php echo (($_GET['genere_inquilini'] ?? '') == 'Entrambi' ? 'selected' : ''); ?>>Entrambi</option>
                                    <option value="Non presenti" <?php echo (($_GET['genere_inquilini'] ?? '') == 'Non presenti' ? 'selected' : ''); ?>>Non presenti</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="occupazione_inquilini" class="form-label small">Occupazione</label>
                                <select class="form-select form-select-sm" name="occupazione_inquilini" id="occupazione_inquilini">
                                    <option value="">Qualsiasi</option>
                                    <option value="Studenti" <?php echo (($_GET['occupazione_inquilini'] ?? '') == 'Studenti' ? 'selected' : ''); ?>>Studenti</option>
                                    <option value="Lavoratori" <?php echo (($_GET['occupazione_inquilini'] ?? '') == 'Lavoratori' ? 'selected' : ''); ?>>Lavoratori</option>
                                    <option value="Entrambi" <?php echo (($_GET['occupazione_inquilini'] ?? '') == 'Entrambi' ? 'selected' : ''); ?>>Entrambi</option>
                                    <option value="Non presenti" <?php echo (($_GET['occupazione_inquilini'] ?? '') == 'Non presenti' ? 'selected' : ''); ?>>Non presenti</option>
                                </select>
                            </div>
                        </div>

                        <!-- Filtro Servizi e Regole -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Servizi e Regole</h6>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="has_ascensore" value="1" id="check-ascensore" <?php echo (isset($_GET['has_ascensore']) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="check-ascensore">Ascensore</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="has_cucina" value="1" id="check-cucina" <?php echo (isset($_GET['has_cucina']) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="check-cucina">Cucina</label>
                            </div>
                             <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="proprietario_vive_casa" value="1" id="check-proprietario" <?php echo (isset($_GET['proprietario_vive_casa']) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="check-proprietario">Proprietario in casa</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="accetta_animali" value="1" id="check-animali" <?php echo (isset($_GET['accetta_animali']) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="check-animali">Animali ammessi</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="accetta_fumatori" value="1" id="check-fumatori" <?php echo (isset($_GET['accetta_fumatori']) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="check-fumatori">Fumatori ammessi</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="accetta_coppie" value="1" id="check-coppie" <?php echo (isset($_GET['accetta_coppie']) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="check-coppie">Coppie ammesse</label>
                            </div>
                        </div>

                        <!-- Filtro Utenze -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Utenze Incluse</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="utenza_internet" value="1" id="check-internet" <?php echo (isset($_GET['utenza_internet']) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="check-internet">Internet</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="utenza_acqua" value="1" id="check-acqua" <?php echo (isset($_GET['utenza_acqua']) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="check-acqua">Acqua</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="utenza_gas" value="1" id="check-gas" <?php echo (isset($_GET['utenza_gas']) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="check-gas">Gas</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="utenza_luce" value="1" id="check-luce" <?php echo (isset($_GET['utenza_luce']) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="check-luce">Luce</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn bg-unibo-red w-100 fw-bold">Seleziona</button>
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
                    <ul class="row g-3 list-unstyled" aria-label="Risultati della ricerca">
                        <?php foreach ($templateParams['SearchResults'] as $search): ?>
                            <li class="col-12 list-unstyled">
                                <!-- Contenuto della Card -->
                                <div class="card card-alloggio rounded-3 overflow-hidden shadow-sm position-relative card-annuncio-hover border-0 bg-light-subtle" data-id="<?php echo $search['id_alloggio']; ?>">
                                    <div class="row g-0 align-items-stretch">
                                        <!-- Colonna del Carosello -->
                                        <div class="col-12 col-md-4 border-end position-relative custom-carousel-container">
                                             <div id="carousel-<?php echo $search['id_alloggio']; ?>" class="carousel slide" data-bs-ride="false">
                                                <div class="carousel-inner">
                                                    <?php 
                                                        $fotos = $dbh->fotoAlloggio($search['id_alloggio']);    
                                                        $isFirst = true;
                                                        foreach ($fotos as $foto): 
                                                    ?>
                                                    <div class="carousel-item <?php if($isFirst) { echo 'active'; $isFirst = false; } ?>">
                                                        <div class="ratio ratio-4x3">
                                                            <img src="<?php echo UPLOAD_DIR . $foto['percorso_immagine']; ?>" class="object-fit-cover" alt="Foto alloggio">
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <button class="carousel-control-prev custom-arrow" type="button" data-bs-target="#carousel-<?php echo $search['id_alloggio']; ?>" data-bs-slide="prev">
                                                    <span class="arrow-circle bg-white text-dark rounded-circle p-1 shadow-sm"><em class="bi bi-chevron-left"></em></span>
                                                </button>
                                                <button class="carousel-control-next custom-arrow" type="button" data-bs-target="#carousel-<?php echo $search['id_alloggio']; ?>" data-bs-slide="next">
                                                    <span class="arrow-circle bg-white text-dark rounded-circle p-1 shadow-sm"><em class="bi bi-chevron-right"></em></span>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- Colonna dei Dettagli -->
                                        <div class="col-12 col-md-8">
                                            <div class="card-body p-4 d-flex flex-column h-100">
                                                <div class="mb-auto">
                                                    <a href="annuncio.php?id=<?php echo $search['id_alloggio']; ?>" class="stretched-link text-decoration-none text-dark">
                                                        <h3 class="h5 fw-bold mb-2"><?php echo $search['tipo_immobile']; ?></h3>
                                                    </a>
                                                    <p class="text-muted small mb-1">
                                                        <em class="bi bi-geo-alt-fill me-1 text-danger"></em><?php echo $search['indirizzo'] . ", " . $search['civico'] . " - " . $search['comune']; ?>
                                                    </p>
                                                    <p class="small text-secondary mb-3">
                                                        Distanza dal campus: <?php echo $search['distanza_campus_km']; ?> km
                                                        <br>Distanza dal centro: <?php echo $search['distanza_centro_km']; ?> km
                                                    </p>
                                                    
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-3">
                                                    <span class="fw-bold fs-4 text-primary"><?php echo $search['prezzo_mensile_alloggio']; ?>€/mese</span>
                                                    <?php $isFav = in_array($search["id_alloggio"], $templateParams["preferiti_ids"]); ?>
                                                    <button type="button" 
                                                        class="btn btn-link p-2 btn-cuore <?php echo $isFav ? 'active' : ''; ?>" 
                                                        data-id="<?php echo $search["id_alloggio"]; ?>">
                                                        <em class="bi <?php echo $isFav ? 'bi-heart-fill' : 'bi-heart'; ?> fs-4"></em>
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