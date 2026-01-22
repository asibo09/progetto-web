<h1 class="fw-bold mb-5"><i class="bi bi-house me-2"></i><?php echo $templateParams["titolo"] ?></h1>

<div class="bg-white shadow-sm border p-4 rounded-3 h-100">

    <!-- Listings Container -->
    <div class="d-flex flex-column gap-3">
        <?php foreach ($prenotazioni as $prenotazione): ?>
            <!-- Single Card Item -->
            <div
                class="card rounded-3 overflow-hidden shadow-sm position-relative card-annuncio-hover border-0 bg-light-subtle">
                <div class="row g-0 align-items-stretch">

                    <!-- Carousel Column -->
                    <div class="col-12 col-md-4 border-end position-relative custom-carousel-container"
                        style="min-height: 220px; height: auto !important;">
                        <div id="carouselMyProp1" class="carousel slide position-absolute top-0 start-0 w-100 h-100"
                            data-bs-ride="false">
                            <div class="carousel-counter badge">
                                <span class="current-slide">1</span>/<span class="total-slides">2</span>
                            </div>
                            <div class="carousel-inner h-100">
                                <div class="carousel-item active h-100">
                                    <img src="../upload/esempio_alloggio.png" class="img-fit" alt="Foto Stanza 1">
                                </div>
                                <div class="carousel-item h-100">
                                    <img src="../upload/esempio_alloggio2.png" class="img-fit" alt="Foto Stanza 2">
                                </div>
                            </div>
                            <button class="carousel-control-prev custom-arrow" type="button"
                                data-bs-target="#carouselMyProp1" data-bs-slide="prev">
                                <span class="arrow-circle bg-white text-dark rounded-circle p-1 shadow-sm"><i
                                        class="bi bi-chevron-left"></i></span>
                                <span class="visually-hidden">Precedente</span>
                            </button>
                            <button class="carousel-control-next custom-arrow" type="button"
                                data-bs-target="#carouselMyProp1" data-bs-slide="next">
                                <span class="arrow-circle bg-white text-dark rounded-circle p-1 shadow-sm"><i
                                        class="bi bi-chevron-right"></i></span>
                                <span class="visually-hidden">Successivo</span>
                            </button>
                        </div>
                    </div>

                    <!-- Details Column -->
                    <div class="col-12 col-md-8">
                        <div class="card-body p-4 d-flex flex-column h-100">
                            <div class="mb-auto">
                                <a href="annuncio.html" class="stretched-link text-decoration-none text-dark">
                                    <h3 class="h5 fw-bold mb-2"><?php echo $prenotazione["tipo_immobile"]?></h3>
                                </a>
                                <p class="text-muted small mb-1">
                                    <i class="bi bi-geo-alt-fill me-1 text-danger"></i><?php echo $prenotazione["tipo_immobile"]?>
                                </p>
                                <p class="small text-secondary mb-3"><?php echo $prenotazione["distanza_centro_km"]?></p>
                            </div>
                                <div class="ms-auto d-flex gap-2 position-relative z-2">
                                    <a href="#"
                                        class="btn btn-outline-primary rounded-pill d-flex gap-2 align-items-center fw-semibold btn-sm px-3">
                                        <i class="bi bi-pencil"></i> Modifica
                                    </a>
                                    <a href="#"
                                        class="btn btn-outline-danger rounded-pill d-flex gap-2 align-items-center fw-semibold btn-sm px-3">
                                        <i class="bi bi-trash"></i> Elimina
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- End Single Card Item -->

    </div>
</div>