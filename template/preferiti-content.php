<div class="mb-5">
    <h1 class="fw-bold"><em class="bi bi-heart-fill text-danger me-3"></em>I miei annunci salvati</h1>
    <p class="text-muted">Qui trovi tutte le soluzioni che hai selezionato per i tuoi affitti.</p>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-lg-10">
        <div class="card shadow-sm border-0 p-4 rounded-3">
            <div class="d-flex flex-column gap-4">
                
                <?php if(count($templateParams["annunci"]) == 0): ?>
                    <p class="text-center py-5">Non hai ancora salvato nessun annuncio.</p>
                <?php endif; ?>

                <?php foreach($templateParams["annunci"] as $annuncio): 
                    $cID = "carouselFav" . $annuncio["id_alloggio"];
                    $foto = $annuncio["lista_foto"];
                ?>
                <div class="card card-alloggio border rounded-3 overflow-hidden shadow-sm position-relative card-annuncio-hover" data-id="<?php echo $annuncio['id_alloggio']; ?>">>
                    <div class="row g-0 align-items-stretch">
                        
                        <div class="col-4 col-md-3 border-end position-relative custom-carousel-container">
                            <div id="<?php echo $cID; ?>" class="carousel slide h-100" data-bs-ride="false">
                                <div class="carousel-counter badge">
                                    <span class="current-slide">1</span>/<span class="total-slides"><?php echo count($foto); ?></span>
                                </div>
                                <div class="carousel-inner h-100">
                                    <?php foreach($foto as $idx => $f): ?>
                                    <div class="carousel-item <?php echo $idx === 0 ? 'active' : ''; ?> h-100">
                                        <a href="annuncio.php?id=<?php echo $annuncio["id_alloggio"]; ?>" class="d-block h-100">
                                            <img src="upload/<?php echo $f['percorso_immagine']; ?>" class="img-fit-standard" alt="Anteprima di un <?php echo $annuncio['tipo_immobile']; ?> situato in <?php echo $annuncio['indirizzo']; ?>, <?php echo $annuncio['comune']; ?>">
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <button class="carousel-control-prev custom-arrow" type="button" data-bs-target="#<?php echo $cID; ?>" data-bs-slide="prev">
                                    <span class="arrow-circle"><em class="bi bi-chevron-left"></em></span>
                                </button>
                                <button class="carousel-control-next custom-arrow" type="button" data-bs-target="#<?php echo $cID; ?>" data-bs-slide="next">
                                    <span class="arrow-circle"><em class="bi bi-chevron-right"></em></span>
                                </button>
                            </div>
                        </div>

                        <div class="col-8 col-md-9">
                            <div class="card-body p-3">
                                <a href="annuncio.php?id=<?php echo $annuncio["id_alloggio"]; ?>" class="stretched-link text-decoration-none text-dark">
                                    <h2 class="h5 fw-bold mb-1 title-hover-effect"><?php echo $annuncio["tipo_immobile"]; ?></h2>
                                </a>
                                <p class="text-muted small mb-1">
                                    <em class="bi bi-geo-alt-fill me-1 text-danger"></em>
                                    <?php echo $annuncio["indirizzo"]; ?>, <?php echo $annuncio["civico"]; ?> - <?php echo $annuncio["comune"]; ?>
                                </p>
                                <p class="small mb-3 text-secondary">
                                    <?php echo $annuncio["distanza_campus_km"]; ?> km dal Campus, <?php echo $annuncio["distanza_centro_km"]; ?> km dal centro
                                </p>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-danger fw-bold fs-4"><?php echo (int)$annuncio["prezzo_mensile_alloggio"]; ?>€</span>
                                    
                                    <div class="d-flex gap-3 align-items-center" style="position: relative; z-index: 100;">
                                        <?php 
                                        $idLoggato = $_SESSION["id_utente"] ?? -1;
                                        // 1. Controllo: Non mostrare il tasto prenota se l'alloggio è dell'utente stesso
                                        if($annuncio["id_proprietario"] != $idLoggato): 
            
                                            // 2. Controllo disponibilità stanze
                                            if($annuncio["disponibile"]): ?>
                                                <a href="javascript:void(0)" 
                                                    class="btn btn-prenota text-info btn-outline-info rounded-pill px-3 py-1 d-flex align-items-center gap-2 fw-semibold btn-apri-prenota"
                                                    data-id="<?php echo $annuncio["id_alloggio"]; ?>"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalPrenotazione">
                                                    <em class="bi bi-calendar-check"></em><span>Prenota</span>
                                                </a>
                                            <?php else: ?>
                                            <button class="btn btn-secondary rounded-pill px-3 py-1 btn-sm fw-semibold opacity-50" disabled>
                                                <em class="bi bi-calendar-x me-2"></em>Esaurito
                                            </button>
                                            <?php endif; ?>

                                        <?php endif; ?>
                                        <button type="button" class="btn btn-link p-2 btn-cuore active" data-id="<?php echo $annuncio["id_alloggio"]; ?>">
                                            <em class="bi heart-icon fs-4"></em>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
    //aggiorna i contatori caroselli
    document.querySelectorAll('.carousel').forEach(carousel => {
        const currentSpan = carousel.querySelector('.current-slide');
        carousel.addEventListener('slid.bs.carousel', function (event) {
            if (currentSpan) {
                currentSpan.textContent = event.to + 1;
            }
        });
    });
</script>