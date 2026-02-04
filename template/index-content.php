<?php if (isset($templateParams["messaggio_successo"])): ?>
    <div class="container-xl mt-3">
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-4" role="alert">
            <em class="bi bi-check-circle-fill me-2"></em>
            <strong>Fatto!</strong> <?php echo htmlspecialchars($templateParams["messaggio_successo"]); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<div class="mb-4 mt-5 text-left px-3">
    <h1 class="fw-bold"><?php echo $templateParams['titolo']; ?></h1>
</div>

<form action="risultatiRicerca.php" method="GET" class="container-xl px-3">
    <div class="mb-2">

        <div class="mb-3">
            <div id="luogoHelp" class="form-text">Città o zona</div>
            <label for="luogo" class="form-label visually-hidden">Luogo</label>
            <input type="text" class="form-control text-center form-control-lg" id="luogo" name="luogo"
                placeholder="Dove?" aria-describedby="luogoHelp" required>
        </div>

        <div class="mb-3">
            <div id="mesiHelp" class="form-text">Per quanti mesi cerchi?</div>
            <label for="nmesi" class="form-label visually-hidden">Numero Mesi</label>
            <div class="input-group">
                <button class="btn btn-outline-secondary" type="button"
                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                    <em class="bi bi-dash"></em>
                </button>
                <input name="nmesi" id="nmesi" class="form-control text-center" type="number" min="1" max="60"
                    placeholder="N. mesi" aria-label="Numero mesi" required>
                <button class="btn btn-outline-secondary" type="button"
                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                    <em class="bi bi-plus"></em>
                </button>
            </div>

        </div>

        <div class="mb-3">
            <div id="personeHelp" class="form-text">Quante persone può ospitare</div>
            <label for="npersone" class="form-label visually-hidden">Numero Persone</label>
            <div class="input-group">
                <button class="btn btn-outline-secondary" type="button"
                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                    <em class="bi bi-dash"></em>
                </button>
                <input type="number" class="form-control text-center" id="npersone" name="npersone" min="1" max="8"
                    placeholder="Persone" aria-describedby="personeHelp" required>
                <button class="btn btn-outline-secondary" type="button"
                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                    <em class="bi bi-plus"></em>
                </button>
            </div>

        </div>

        <button type="submit" class="btn bg-unibo-red w-100 py-3 rounded-3 shadow-sm fw-bold fs-5">
            <em class="bi bi-send-fill me-2"></em> CERCA
        </button>

    </div>
</form>

<div class="container-xl px-3 mt-5">

    <?php if (!empty($templateParams["lastSearches"])): ?>
        <div class="container-xl px-3 mt-5">
            <h2 class="fw-bold mb-3">Le tue ultime ricerche</h2>
            <div class="row g-4"></div>

            <div class="row g-4 mt-3">
                <?php foreach ($templateParams["lastSearches"] as $i => $alloggio): ?>
                    <div class="col-12 col-lg-6">
                        <!-- Elemento singolo della Carta -->
                        <div class="card card-alloggio rounded-3 overflow-hidden shadow-sm position-relative card-annuncio-hover border-0 bg-light-subtle h-100"
                            data-id="<?php echo $alloggio['id_alloggio']; ?>">
                            <div class="row g-0 align-items-stretch h-100">

                                <!-- Colonna Carosello -->
                                <div class="col-12 col-md-4 position-relative z-2">
                                    <div id="carousel-<?php echo $i; ?>" class="carousel slide h-100" data-bs-ride="true">
                                        <div class="carousel-inner h-100">
                                            <?php
                                            $fotos = [];
                                            if (isset($templateParams["fotoAlloggio"][$alloggio["id_alloggio"]])) {
                                                $rawFotos = $templateParams["fotoAlloggio"][$alloggio["id_alloggio"]];
                                                foreach ($rawFotos as $f) {
                                                    if (!empty($f['percorso_immagine'])) {
                                                        $fotos[] = $f;
                                                    }
                                                }
                                            }

                                            if (count($fotos) == 0): ?>
                                                <div class="carousel-item active h-100">
                                                    <div class="ratio ratio-4x3 h-100">
                                                        <img src="<?php echo UPLOAD_DIR . "esempio_alloggio.png"; ?>"
                                                            class="object-fit-cover" alt="Immagine default">
                                                    </div>
                                                </div>
                                            <?php else:
                                                $posizioneFoto = 0;
                                                foreach ($fotos as $foto): ?>
                                                    <div class="carousel-item h-100 <?php echo $posizioneFoto == 0 ? "active" : ""; ?>">
                                                        <div class="ratio ratio-4x3 h-100">
                                                            <img src="<?php echo UPLOAD_DIR . $foto["percorso_immagine"]; ?>"
                                                                class="object-fit-cover" alt="Foto alloggio">
                                                        </div>
                                                    </div>
                                                    <?php $posizioneFoto++; ?>
                                                <?php endforeach;
                                            endif; ?>
                                        </div> <?php if (count($fotos) > 1): ?>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carousel-<?php echo $i; ?>" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carousel-<?php echo $i; ?>" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- Colonna Dettagli -->
                                <div class="col-12 col-md-8">
                                    <div class="card-body p-4 d-flex flex-column h-100">
                                        <a href="annuncio.php?id=<?php echo $alloggio["id_alloggio"]; ?>"
                                            class="stretched-link text-decoration-none text-dark">
                                            <h3 class="h5 fw-bold mb-2"><?php echo $alloggio["tipo_immobile"]; ?></h3>
                                        </a>
                                        <p class="text-muted small mb-1">
                                            <em
                                                class="bi bi-geo-alt-fill me-1 text-danger"></em><?php echo $alloggio["comune"]; ?>
                                        </p>
                                        <p class="small text-secondary mb-1">
                                            <?php echo $alloggio["distanza_centro_km"] . "km distante dal centro"; ?>
                                        </p>
                                        <p class="small text-secondary mb-1">
                                            <?php echo $alloggio["distanza_campus_km"] . "km distante dal campus"; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>