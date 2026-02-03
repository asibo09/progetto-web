<div class="container py-5 text-center">
    <h1 class="fw-bold mb-1"><?php echo $userData["nome"] . " " . $userData["cognome"]; ?></h1>
    <p class="h5 text-muted mb-5"><?php echo $userData["ruolo"]; ?></p>

    <div class="row justify-content-center">
        <div class="col-lg-10 p-4 p-md-5 border rounded-4 bg-light">
            <nav title="Navigazione profilo utente">
                <ul class="row row-cols-1 row-cols-md-2 g-4 text-dark list-unstyled p-0 m-0">
                    
                    <li class="col">
                        <div class="card h-100 p-4 shadow-sm card-menu-hover position-relative rounded-3">
                            <em class="bi bi-person-vcard fs-1 mb-2"></em>
                            <h2 class="h5 fw-bold">I TUOI DATI</h2>
                            <p class="text-muted small mb-0">Gestisci le tue informazioni personali e di contatto</p>
                            <a href="dati.php" title="I tuoi dati" class="stretched-link"></a>
                        </div>
                    </li>

                    <li class="col">
                        <div class="card h-100 p-4 shadow-sm card-menu-hover position-relative rounded-3">
                            <em class="bi bi-house fs-1 mb-2"></em>
                            <h2 class="h5 fw-bold">I MIEI ANNUNCI</h2>
                            <p class="text-muted small mb-0">Ritrova alloggi che hai messo in affitto</p>
                            <a href="iMieiAnnunci.php" title="I miei annunci" class="stretched-link"></a>
                        </div>
                    </li>

                    <li class="col">
                        <div class="card h-100 p-4 shadow-sm card-menu-hover position-relative rounded-3">
                            <em class="bi bi-bell fs-1 mb-2"></em>
                            <h2 class="h5 fw-bold">NOTIFICHE</h2>
                            <p class="text-muted small mb-0">Rimani aggiornato su messaggi e novità</p>
                            <a href="badgeNotifiche.php" title="Le tue Notifiche" class="stretched-link"></a>
                        </div>
                    </li>

                    <li class="col">
                        <div class="card h-100 p-4 shadow-sm card-menu-hover position-relative rounded-3">
                            <em class="bi bi-box-arrow-right fs-1 mb-2"></em>
                            <h2 class="h5 fw-bold">ESCI</h2>
                            <p class="text-muted small mb-0">Termina la tua sessione di lavoro</p>
                            <a href="logout.php" title="Esci" class="stretched-link"></a>
                        </div>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</div>