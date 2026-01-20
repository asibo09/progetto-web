
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/progetto-web/css/style.css">

    <title>Segnalazione</title>
</head>

<body class="d-flex flex-column min-vh-100">
<!-- Desktop -->
<header class="d-none d-lg-flex justify-content-between align-items-center p-3 bg-unibo-red shadow-sm">
    <a href="home.html">
        <img src="../upload/logoUnibo.png" alt="Logo" style="height: 65px;">
    </a>
    <nav class="d-flex gap-5 fs-5">
        <a href="home.html">Home</a>
        <div class="vr bg-white" style="height: 30px; opacity: 1;"></div><a href="preferiti.html">Salvati</a>
        <div class="vr bg-white" style="height: 30px; opacity: 1;"></div><a href="richiedi.html">Richiedi</a>
        <div class="vr bg-white" style="height: 30px; opacity: 1;"></div><a
            href="prenotazioni.html">Prenotazioni</a>
    </nav>
    <a href="profilo.html"><i class="bi bi-person-circle fs-2"></i></a>
</header>

<!-- Tablet -->
<header class="d-none d-md-flex d-lg-none justify-content-between align-items-center p-3 bg-unibo-red shadow-sm">
    <a href="home.html">
        <img src="../upload/logoUnibo.png" alt="Logo" style="height: 50px;">
    </a>
    <div class="d-flex gap-4">
        <a href="salvati.html"><i class="bi bi-heart fs-4"></i></a>
        <a href="richiedi.html"><i class="bi bi-arrow-up-circle fs-4"></i></a>
        <a href="prenotazioni.html"><i class="bi bi-calendar-event fs-4"></i></a>
        <a href="profilo.html"><i class="bi bi-person-circle fs-4"></i></a>
    </div>
</header>

<!-- Mobile -->
<header class="d-flex d-md-none justify-content-between align-items-center p-3 bg-unibo-red shadow-sm">
    <a href="home.html">
        <img src="../upload/logoUnibo.png" alt="Logo" style="height: 50px;">
    </a>
    <a href="profilo.html">
        <i class="bi bi-person-circle" style="font-size: 32px;"></i>
    </a>
</header>

    <main class="flex-grow-1 container-xl py-5">
        <div class="mb-4 mt-5 text-left px-3">
            <h1 class="fw-bold"><?php echo $templeteParams["titolo"]; ?></h1>
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


    </main>





<footer class="bg-unibo-red py-3 mt-auto">
    <div class="container text-center text-white d-flex flex-column gap-1">
        <p class="fw-bold mb-0" style="font-size: 14px;">Campus Housing - Università di Bologna</p>
        <p class="mb-0" style="font-size: 13px;">Alma Mater Studiorum - Campus di Cesena</p>
        <p class="mb-0 opacity-75" style="font-size: 12px;">© A.A. 2025-2026 Tecnologie Web - Aresu Marco, Fronzi
            Andrea, Siboni Pietro</p>
    </div>
</footer>

<nav class="fixed-bottom bg-white border-top shadow d-md-none">
    <ul style="list-style: none; display: flex; justify-content: space-around; padding: 10px; margin: 0;">
        <li style="text-align: center;">
            <a href="home.html" style="text-decoration: none; color: black;">
                <i class="bi bi-house" style="font-size: 24px;"></i>
                <p style="margin: 0; font-size: 0.8rem;">Home</p>
            </a>
        </li>
        <li style="text-align: center;">
            <a href="preferiti.html" style="text-decoration: none; color: black;">
                <i class="bi bi-heart" style="font-size: 24px;"></i>
                <p style="margin: 0; font-size: 0.8rem;">Salvati</p>
            </a>
        </li>
        <li style="text-align: center;">
            <a href="richiedi-delega.html" style="text-decoration: none; color: black;">
                <i class="bi bi-plus-circle" style="font-size: 24px;"></i>
                <p style="margin: 0; font-size: 0.8rem;">Richiedi</p>
            </a>
        </li>
        <li style="text-align: center;">
            <a href="prenotazioni.html" style="text-decoration: none; color: black;">
                <i class="bi bi-calendar-event" style="font-size: 24px;"></i>
                <p style="margin: 0; font-size: 0.8rem;">Prenotazioni</p>
            </a>
        </li>
    </ul>
</nav>

</body>
</html>