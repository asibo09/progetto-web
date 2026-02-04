<h1 class="fw-bold mb-5"><em class="bi bi-house me-2"></em>I miei annunci</h1>

<div class="bg-white shadow-sm border p-4 rounded-3 h-100">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h2 class="fw-semibold fs-5 m-0"><?php echo $numeroAnnunci ?> annunci pubblicati</h2>

        <div class="d-flex align-items-center gap-5">
            <a class="btn btn-primary fw-bold py-2 px-3 rounded-pill d-flex align-items-center gap-2 text-nowrap"
                href="pubblica-annuncio.php">
                <em class="bi bi-plus-circle"></em> Nuovo annuncio
            </a>
        </div>
    </div>

    <ul class="d-flex flex-column gap-3 list-unstyled p-0 m-0">
        <?php foreach ($iMieiAnnunciResult as $alloggio): ?>
            <!-- articolo -->
            <li>
                <article
                    class="card rounded-3 overflow-hidden shadow-sm position-relative card-annuncio-hover border-0 bg-light-subtle">
                    <div class="row g-0 align-items-stretch">
                        <!-- Carosello delle foto -->
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
                        <!-- Colonna  dei dettagli -->
                        <div class="col-12 col-md-8">
                            <div class="card-body p-4 d-flex flex-column h-100">
                                <a href="annuncio.php?id=<?php echo $alloggio["id_alloggio"] ?>"
                                    class="stretched-link text-decoration-none text-dark">
                                    <h3 class="h5 fw-bold mb-2"><?php echo $alloggio["tipo_immobile"] ?></h3>
                                </a>
                                <p class="text-muted small mb-1">
                                    <em
                                        class="bi bi-geo-alt-fill me-1 text-danger"></em><?php echo $alloggio["indirizzo"] . " " . $alloggio["civico"] . ", " . $alloggio["comune"] ?>
                                </p>
                                <p class="small text-secondary mb-1">
                                    <?php echo $alloggio["distanza_centro_km"] . "km distante dal centro" ?>
                                </p>
                                <p class="small text-secondary mb-1">
                                    <?php echo $alloggio["distanza_campus_km"] . "km distante dal campus" ?>
                                </p>
                                <div class="position-absolute bottom-0 end-0 m-3 z-3">
                                    <a href="eliminaAnnuncio.php?id=<?php echo $alloggio["id_alloggio"] ?>"
                                        class="btn btn-outline-danger rounded-pill d-flex gap-2 align-items-center fw-semibold btn-sm px-3">
                                        <em class="bi bi-trash"></em> Elimina
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>
</div>