<div class="mb-4 mt-5 text-left px-3">
            <h1 class="fw-bold">Nome, cosa stai cercando?</h1>
            <p class="text-muted">Trova offerte per alloggi ovunque!</p>
        </div>

        <form action="#" method="POST" class="container-xl px-3">
            <div class="mb-2">

                <label for="luogo" class="form-label visually-hidden">Luogo</label>
                <input type="text" class="form-control-lg" id="luogo" name="luogo" placeholder="Dove?" aria-describedby="luogoHelp" required>
                <div id="luogoHelp" class="form-text">Città o zona</div>

                <label for="nmesi" class="form-label visually-hidden">Numero Mesi</label>
                <input type="number" class="form-control" id="nmesi" name="nmesi" min="1" max="60" placeholder="N. mesi" aria-describedby="mesiHelp" required>
                <div id="mesiHelp" class="form-text">Quanti mesi pensi di rimanere</div>

                <label for="npersone" class="form-label visually-hidden">Numero Persone</label>
                <input type="number" class="form-control" id="npersone" name="npersone" min="1" max="8" placeholder="Persone" aria-describedby="personeHelp">
                <div id="personeHelp" class="form-text">Quante persone può ospitare</div>

                <button type="submit" class="btn bg-unibo-red w-100 py-3 rounded-3 shadow-sm fw-bold fs-5">
                    <i class="bi bi-send-fill me-2"></i> CERCA
                </button>

            </div>
        </form>

        <div class="container-xl px-3 mt-5">

            <h2 class="fw-bold mb-3">Continua la ricerca...</h2>

            <ul class="row g-3 list-unstyled" role="list" aria-label="Ultime ricerche">
                <?php foreach($templateParams["lastSearches"] as $search): ?>
                <li class="col-6">
                    <div class="d-flex flex-column gap-3">

                <div class="card rounded-3 overflow-hidden shadow position-relative card-annuncio-hover">
                    <div class="row g-0 align-items-stretch">
                        <div class="col-4 border-end position-relative custom-carousel-container">
                            <div id="carouselMyProp1" class="carousel slide h-100" data-bs-ride="false">
                                <div class="carousel-counter badge">
                                    <span class="current-slide">1</span>/<span class="total-slides">2</span>
                                </div>
                                <div class="carousel-inner h-100">
                                    <div class="carousel-item active h-100">
                                        <a href="annuncio.html" class="d-block h-100">
                                            <img src="../upload/esempio_alloggio.png" class="img-fit"
                                                alt="Foto Stanza 1">
                                        </a>
                                    </div>
                                    <div class="carousel-item h-100">
                                        <a href="annuncio.html" class="d-block h-100">
                                            <img src="../upload/esempio_alloggio2.png" class="img-fit"
                                                alt="Foto Stanza 2">
                                        </a>
                                    </div>
                                </div>
                                <button class="carousel-control-prev custom-arrow" type="button"
                                    data-bs-target="#carouselMyProp1" data-bs-slide="prev">
                                    <span class="arrow-circle"><i class="bi bi-chevron-left"></i></span>
                                </button>
                                <button class="carousel-control-next custom-arrow" type="button"
                                    data-bs-target="#carouselMyProp1" data-bs-slide="next">
                                    <span class="arrow-circle"><i class="bi bi-chevron-right"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card-body p-4">
                                <a href="annuncio.html" class="stretched-link text-decoration-none text-dark">
                                    <h3 class="h5 fw-bold mb-1">Stanza singola</h3>
                                </a>
                                <p class="text-muted small mb-1"><i class="bi bi-geo-alt-fill me-1 text-danger"></i>Via
                                    del Campus, 10 - Cesena</p>
                                <p class="small mb-3 text-secondary">2 km dal Campus, 10 km dal centro</p>

                                <div class="d-flex align-items-center gap-3">
                                    <span class="fw-bold fs-5">800€</span>
                                    <a href="#"
                                        class="btn btn-modifica btn-outline-primary rounded-pill d-flex gap-2 align-items-center fw-semibold ms-auto position-relative z-2">
                                        <i class="bi bi-pencil"></i>Modifica
                                    </a>
                                    <a href="#"
                                        class="btn btn-outline-danger rounded-pill d-flex gap-2 align-items-center fw-semibold position-relative z-2">
                                        <i class="bi bi-trash"></i>Elimina
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                </li>
            </ul>
            <?php endforeach; ?>

        </div>