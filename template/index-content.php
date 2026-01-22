<div class="mb-4 mt-5 text-left px-3">
            <h1 class="fw-bold"><?php echo $templateParams['titolo']; ?></h1>
        </div>

        <form action="risultatiRicerca.php" method="GET" class="container-xl px-3">
            <div class="mb-2">

                <div class="mb-3">
                <label for="luogo" class="form-label visually-hidden">Luogo</label>
                <input type="text" class="form-control-lg" id="luogo" name="luogo" placeholder="Dove?" aria-describedby="luogoHelp" required>
                <div id="luogoHelp" class="form-text">Città o zona</div>
                </div>

                <div class="mb-3">
                    <label for="nmesi" class="form-label visually-hidden">Numero Mesi</label>
                <input name="nmesi" id="nmesi" class="form-control" type="number" min="1" max="60" placeholder="N. mesi" aria-label="Numero mesi" required>
                <div id="mesiHelp" class="form-text">Per quanti mesi cerchi?</div>
                </div>

                <div class="mb-3">
                <label for="npersone" class="form-label visually-hidden">Numero Persone</label>
                <input type="number" class="form-control" id="npersone" name="npersone" min="1" max="8" placeholder="Persone" aria-describedby="personeHelp" required>
                <div id="personeHelp" class="form-text">Quante persone può ospitare</div>
                </div>
                
                <button type="submit" class="btn bg-unibo-red w-100 py-3 rounded-3 shadow-sm fw-bold fs-5">
                    <i class="bi bi-send-fill me-2"></i> CERCA
                </button>

            </div>
        </form>

        <div class="container-xl px-3 mt-5">

            <h2 class="fw-bold mb-3"><?php echo $templateParams['isLogged']; ?></h2>

            <ul class="row g-3 list-unstyled" role="list" aria-label="Ultime ricerche">
                <?php foreach($templateParams["lastSearches"] as $search): ?>
                <li class="col-6">
                    <div class="d-flex flex-column gap-3">

                <div class="card rounded-3 overflow-hidden shadow position-relative card-annuncio-hover">
                    <div class="row g-0 align-items-stretch">
                        <div class="col-8">
                            <div class="card-body p-4">
                                <a href="annuncio.html" class="stretched-link text-decoration-none text-dark">
                                    <h3 class="h5 fw-bold mb-1"><?php echo $search["descrizione"]; ?></h3>
                                </a>
                                <p class="text-muted small mb-1"><i class="bi bi-geo-alt-fill me-1 text-danger"></i><?php echo $search["nome_citta"]; ?></p>
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>

                    
                </li>
                <?php endforeach; ?>
                
            </ul>
            </div>

        </div>