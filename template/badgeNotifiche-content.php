<div class="mb-4 mt-5 text-left px-3">
    <h1 class="fw-bold"><em class="bi bi-chat-left-text fs-2"></em> <?php echo $templateParams['titolo']; ?></h1>
</div>

<div class="container-xl px-3">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- Navigazione Tabs -->
            <ul class="nav nav-tabs mb-4" id="notificheTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-dark" id="notifiche-tab" data-bs-toggle="tab"
                        data-bs-target="#notifiche" type="button" role="tab" aria-controls="notifiche"
                        aria-selected="true">
                        Notifiche <span
                            class="badge bg-secondary ms-2"><?php echo count($templateParams['notifiche']); ?></span>
                    </button>
                </li>
                <?php if ($_SESSION["ruolo"] == 'proprietario'): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold text-dark" id="richieste-tab" data-bs-toggle="tab"
                            data-bs-target="#richieste" type="button" role="tab" aria-controls="richieste"
                            aria-selected="false">
                            Richieste Subaffitto <span
                                class="badge bg-secondary ms-2"><?php echo count($templateParams['richiesteSubaffitto']); ?></span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold text-dark" id="prenotazioni-tab" data-bs-toggle="tab"
                            data-bs-target="#Prenotazioni" type="button" role="tab" aria-controls="Prenotazioni"
                            aria-selected="true">
                            Prenotazioni <span
                                    class="badge bg-secondary ms-2"><?php echo count($templateParams['prenotazioni']); ?></span>
                        </button>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Contenuto Tabs -->
            <div class="tab-content" id="notificheTabsContent">

                <!-- Pannello Notifiche -->
                <div class="tab-pane fade show active" id="notifiche" role="tabpanel" aria-labelledby="notifiche-tab">
                    <?php if (empty($templateParams['notifiche'])): ?>
                        <div class="alert alert-info" role="alert">
                            <em class="bi bi-info-circle-fill me-2"></em> Nessuna notifica presente.
                        </div>
                    <?php else: ?>
                        <?php foreach ($templateParams['notifiche'] as $notifica): ?>
                            <article class="bg-white border p-4 mb-4 rounded-3 shadow">
                                <header class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <em class="bi bi-clock text-muted"></em>
                                        <h2 class="h6 mb-0 text-muted"><?php echo $notifica['data_invio']; ?></h2>
                                    </div>
                                    <span class="badge rounded-pill bg-unibo-red text-white d-flex align-items-center">
                                        <em class="bi bi-bell-fill me-1"></em> Notifica
                                    </span>
                                </header>
                                <section>
                                    <h3 class="visually-hidden">Dettagli notifica</h3>
                                    <p class="mb-0"><?php echo $notifica['testo']; ?></p>
                                </section>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <?php if ($_SESSION["ruolo"] == 'proprietario'): ?>
                    <!-- Pannello Richieste Subaffitto -->
                    <div class="tab-pane fade" id="richieste" role="tabpanel" aria-labelledby="richieste-tab">
                        <?php if (empty($templateParams['richiesteSubaffitto'])): ?>
                            <div class="alert alert-info" role="alert">
                                <em class="bi bi-info-circle-fill me-2"></em> Nessuna richiesta di subaffitto presente.
                            </div>
                        <?php else: ?>
                            <?php foreach ($templateParams['richiesteSubaffitto'] as $richiestaSubaffitto): ?>
                                <article class="bg-white border p-4 mb-4 rounded-3 shadow-sm">
                                    <header class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-start gap-3">
                                            <div>
                                                <h2 class="h5 mb-1 fw-bold">Richiesta subaffitto</h2>
                                                <p class="mb-0 text-muted">Per appartamento in:
                                                    <a href="annuncio.php?id=<?php echo $richiestaSubaffitto['id_alloggio']; ?>" class="text-muted">
                                                        <?php echo $richiestaSubaffitto['indirizzo'] . " " . $richiestaSubaffitto['civico'] . ", " . $richiestaSubaffitto['comune'];?>
                                                    </a>. 
                                                    ID Stanza: <?php echo $richiestaSubaffitto['id_stanza']; ?>
                                                </p>
                                                <p class="mb-0 text-muted">Richiedente:
                                                    <a href="profilo-altro-utente.php?id=<?php echo $richiestaSubaffitto['id_richiedente']; ?>" class="text-muted">
                                                        <?php echo $richiestaSubaffitto['nome']; ?> <?php echo $richiestaSubaffitto['cognome']; ?>
                                                    </a>
                                                    <br> Numero cellulare: <?php echo $richiestaSubaffitto['cellulare']; ?> 
                                                    <br> Email: <?php echo $richiestaSubaffitto['email']; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <span class="badge rounded-pill bg-warning text-dark d-flex align-items-center">
                                            <em class="bi bi-envelope-exclamation-fill me-1"></em> Subaffitto
                                        </span>
                                    </header>

                                    <div class="bg-light p-3 rounded-3 mb-3">
                                        <p class="mb-0 fst-italic">"<?php echo $richiestaSubaffitto['messaggio']; ?>"</p>
                                    </div>

                                    <form action="badgeNotifiche.php" method="POST" class="d-flex gap-2 align-items-center">
                                        <input type="hidden" name="id_richiesta"
                                            value="<?php echo $richiestaSubaffitto['id_richiesta']; ?>">

                                        <button type="submit" name="action" value="Confermata"
                                            class="btn btn-sm btn-success d-flex align-items-center fw-bold"
                                            aria-label="Accetta richiesta">
                                            <em class="bi bi-check2 me-1" aria-hidden="true"></em>Accetta
                                        </button>

                                        <button type="submit" name="action" value="Rifiutata"
                                            class="btn btn-sm btn-outline-danger d-flex align-items-center fw-bold"
                                            aria-label="Rifiuta richiesta">
                                            <em class="bi bi-x-lg me-1" aria-hidden="true"></em>Rifiuta
                                        </button>
                                    </form>
                                </article>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Pannello Prenotazioni -->
                    <div class="tab-pane fade" id="Prenotazioni" role="tabpanel" aria-labelledby="prenotazioni-tab">
                        <?php if (empty($templateParams['prenotazioni'])): ?>
                            <div class="alert alert-info" role="alert">
                                <em class="bi bi-info-circle-fill me-2"></em> Nessuna prenotazione richiesta.
                            </div>
                        <?php else: ?>
                            <?php foreach ($templateParams['prenotazioni'] as $prenotazione): ?>
                                <article class="bg-white border p-4 mb-4 rounded-3 shadow-sm">
                                    <header class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-start gap-3">
                                            <div>
                                                <h2 class="h5 mb-1 fw-bold">Prenotazione</h2>
                                                <p class="mb-0 text-muted">Per appartamento in:
                                                    <a href="annuncio.php?id=<?php echo $prenotazione['id_alloggio']; ?>" class="text-muted">
                                                        <?php echo $prenotazione['indirizzo'] . " " . $prenotazione['civico'] . ", " . $prenotazione['comune'];?>
                                                    </a>. 
                                                    ID Stanza: <?php echo $prenotazione['id_stanza']; ?>
                                                </p>
                                                <p class="mb-0 text-muted">Richiedente:
                                                    <a href="profilo-altro-utente.php?id=<?php echo $prenotazione['id_richiedente']; ?>" class="text-muted">
                                                        <?php echo $prenotazione['nome']; ?> <?php echo $prenotazione['cognome']; ?>
                                                    </a>
                                                    <br> Numero cellulare: <?php echo $prenotazione['cellulare']; ?> 
                                                    <br> Email: <?php echo $prenotazione['email']; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <span class="badge rounded-pill bg-info text-dark d-flex align-items-center">
                                            <em class="bi bi-calendar-event me-1"></em> Prenotazione
                                        </span>
                                    </header>

                                    <form action="badgeNotifiche.php" method="POST" class="d-flex gap-2 align-items-center mt-3">
                                        <input type="hidden" name="id_prenotazione"
                                            value="<?php echo $prenotazione['id_prenotazione']; ?>">
                                        
                                        <button type="submit" name="action_prenotazione" value="Confermata"
                                            class="btn btn-sm btn-success d-flex align-items-center fw-bold"
                                            aria-label="Accetta richiesta">
                                            <em class="bi bi-check2 me-1" aria-hidden="true"></em>Accetta
                                        </button>

                                        <button type="submit" name="action_prenotazione" value="Rifiutata"
                                            class="btn btn-sm btn-outline-danger d-flex align-items-center fw-bold"
                                            aria-label="Rifiuta richiesta">
                                            <em class="bi bi-x-lg me-1" aria-hidden="true"></em>Rifiuta
                                        </button>
                                    </form>
                                </article>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>