<h1 class="fw-bold mb-5"><i class="bi bi-house me-2"></i>
    <?php echo $templateParams["titolo"] ?>
</h1>

<div class="bg-white shadow-sm border p-4 rounded-3 h-100">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h2 class="fw-semibold fs-5 m-0">
            <?php echo $numeroAffitti ?> case affittate
        </h2>
    </div>
    <!-- Listings Container -->
    <div class="d-flex flex-column gap-3">
        <?php foreach ($prenotazioni as $alloggio): ?>
            <!-- Single Card Item -->
            <div
                class="card rounded-3 overflow-hidden shadow-sm position-relative card-annuncio-hover border-0 bg-light-subtle">
                <div class="row g-0 align-items-stretch">

                    <!-- Carousel Column -->
                    <div class="col-12 col-md-4 position-relative z-2">
                        <div id="<?php echo $alloggio["id_alloggio"] ?>" class="carousel slide" data-bs-ride="true">
                            <div class="carousel-inner">
                                <?php $posizioneFoto = 0;
                                foreach ($fotoAlloggio[$alloggio["id_alloggio"]] as $foto): ?>
                                    <div class="carousel-item <?php echo $posizioneFoto == 0 ? "active" : ""; ?>">
                                        <div class="ratio ratio-4x3">
                                            <img src="<?php echo UPLOAD_DIR . $foto["percorso_immagine"];
                                            $posizioneFoto++; ?>" class="d-block w-100 object-fit-cover" alt="">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#<?php echo $alloggio["id_alloggio"] ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#<?php echo $alloggio["id_alloggio"] ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <!-- Details Column -->
                    <div class="col-12 col-md-8">
                        <div class="card-body p-4 d-flex flex-column h-100">
                            <div class="d-flex justify-content-between align-items-start">
                                <a href="annuncio.php?id=<?php echo $alloggio["id_alloggio"] ?>"
                                    class="stretched-link text-decoration-none text-dark">
                                    <h3 class="h5 fw-bold mb-2"><?php echo $alloggio["tipo_immobile"] ?></h3>
                                </a>
                                <span class="badge rounded-pill <?php
                                    echo ($alloggio["stato"] == 'Confermata') ? 'bg-success' : 
                                         (($alloggio["stato"] == 'In attesa') ? 'bg-warning text-dark' : 
                                         (($alloggio["stato"] == 'Rifiutata') ? 'bg-danger' : 'bg-secondary'));
                                ?> px-3 py-2">
                                    <i class="bi <?php 
                                        echo ($alloggio["stato"] == 'Confermata') ? 'bi-check-circle-fill' : 
                                             (($alloggio["stato"] == 'In attesa') ? 'bi-hourglass-split' : 
                                             (($alloggio["stato"] == 'Rifiutata') ? 'bi-x-circle-fill' : 'bi-info-circle-fill'));
                                    ?> me-1"></i>
                                    <?php echo $alloggio["stato"] ?>
                                </span>
                            </div>
                            <p class="text-muted small mb-1">
                                <i class="bi bi-geo-alt-fill me-1 text-danger"></i><?php echo $alloggio["indirizzo"] . ", " . $alloggio["comune"] ?>
                            </p>
                            <p class="small text-secondary mb-1">
                                <?php echo $alloggio["distanza_centro_km"] . " km distante dal centro" ?>
                            </p>
                            <p class="small text-secondary mb-1">
                                <?php echo $alloggio["distanza_campus_km"] . " km distante dal campus" ?>
                            </p>
                            <div class="position-absolute bottom-0 end-0 m-3 z-3">
                                <a href="richiestaSubaffitto.php?id=<?php echo $alloggio["id_alloggio"] ?>"
                                    class="btn btn-outline-primary rounded-pill d-flex gap-2 align-items-center fw-semibold btn-sm px-3">
                                    <i class="bi bi-arrow-left-right"></i> Subaffitta
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>