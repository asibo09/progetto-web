<h1 class="fw-bold mb-5"><i class="bi bi-house me-2"></i>I miei annunci</h1>

<div class="bg-white shadow-sm border p-4 rounded-3 h-100">

    <!-- Toolbar: Sort & Add New -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h2 class="fw-semibold fs-5 m-0">2 annunci pubblicati</h2>

        <div class="d-flex align-items-center gap-5">
            <form class="d-flex align-items-center gap-2" action="">
                <label for="sort" class="text-muted text-nowrap">Ordina per:</label>
                <select id="sort"
                    class="form-select border-0 bg-transparent fw-semibold w-auto shadow-none cursor-pointer">
                    <option value="1">Più recenti</option>
                    <option value="2">Prezzo (basso-alto)</option>
                    <option value="3">Prezzo (alto-basso)</option>
                </select>
            </form>
            <a class="btn btn-primary fw-bold py-2 px-3 rounded-pill d-flex align-items-center gap-2 text-nowrap"
                href="pubblica-annuncio.html">
                <i class="bi bi-plus-circle"></i> Nuovo annuncio
            </a>
        </div>
    </div>

    <!-- Listings Container -->
    <div class="d-flex flex-column gap-3">
        <?php foreach ($iMieiAnnunciResult as $alloggio): ?>
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
                                    <h3 class="h5 fw-bold mb-2"><?php echo $alloggio["tipo_immobile"]?></h3>
                                </a>
                                <p class="text-muted small mb-1">
                                    <i class="bi bi-geo-alt-fill me-1 text-danger"></i><?php echo $alloggio["tipo_immobile"]?>
                                </p>
                                <p class="small text-secondary mb-3"><?php echo $alloggio["distanza_centro_km"]?></p>
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