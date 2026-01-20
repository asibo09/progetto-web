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

            <div class="row g-3"><div class="col-6"> <a href="#" class="card text-decoration-none text-dark shadow-sm h-100">
                <div class="card-body p-2 d-flex align-items-center">
                    <div class="bg-light rounded d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-geo-alt fs-3 text-secondary"></i> </div>
                    <div>
                        <p class="mb-0 fw-bold">Cesena</p>
                        <small class="text-muted" style="font-size: 0.75rem;">1 anno, 1 persona</small>
                    </div>
                </div>
            </a>
            </div>

                <div class="col-6">
                    <a href="#" class="card text-decoration-none text-dark shadow-sm h-100">
                        <div class="card-body p-2 d-flex align-items-center">
                            <div class="bg-light rounded d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-geo-alt fs-3 text-secondary"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold">Cesena</p>
                                <small class="text-muted" style="font-size: 0.75rem;">1 anno, 5 persone</small>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6">
                    <a href="#" class="card text-decoration-none text-dark shadow-sm h-100">
                        <div class="card-body p-2 d-flex align-items-center">
                            <div class="bg-light rounded d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-geo-alt fs-3 text-secondary"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold">Cesena</p>
                                <small class="text-muted" style="font-size: 0.75rem;">6 mesi, 1 persona</small>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6">
                    <a href="#" class="card text-decoration-none text-dark shadow-sm h-100">
                        <div class="card-body p-2 d-flex align-items-center">
                            <div class="bg-light rounded d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-geo-alt fs-3 text-secondary"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold">Cesena</p>
                                <small class="text-muted" style="font-size: 0.75rem;">1 mese, 1 persona</small>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>