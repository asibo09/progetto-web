<div class="mb-4 mt-5 text-left px-3">
    <h1 class="fw-bold"><i class="bi bi-chat-left-text fs-2"></i> <?php echo $templateParams['titolo']; ?></h1>
</div>

<div class="container-xl px-3">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs mb-4" id="notificheTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-dark" id="notifiche-tab" data-bs-toggle="tab"
                        data-bs-target="#notifiche" type="button" role="tab" aria-controls="notifiche"
                        aria-selected="true">
                        Notifiche <span
                            class="badge bg-secondary ms-2"><?php echo count($templateParams['notifiche']); ?></span>
                    </button>
                </li>
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
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content" id="notificheTabsContent">

                <!-- Notifiche Pane -->
                <div class="tab-pane fade show active" id="notifiche" role="tabpanel" aria-labelledby="notifiche-tab">
                    <?php if (empty($templateParams['notifiche'])): ?>
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle-fill me-2"></i> Nessuna notifica presente.
                        </div>
                    <?php else: ?>
                        <?php foreach ($templateParams['notifiche'] as $notifica): ?>
                            <article class="bg-white border p-4 mb-4 rounded-3 shadow">
                                <header class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-clock text-muted"></i>
                                        <h2 class="h6 mb-0 text-muted"><?php echo $notifica['data_invio']; ?></h2>
                                    </div>
                                    <span class="badge rounded-pill bg-unibo-red text-white d-flex align-items-center">
                                        <i class="bi bi-bell-fill me-1"></i> Notifica
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

                <!-- Richieste Subaffitto Pane -->
                <div class="tab-pane fade" id="richieste" role="tabpanel" aria-labelledby="richieste-tab">
                    <?php if (empty($templateParams['richiesteSubaffitto'])): ?>
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle-fill me-2"></i> Nessuna richiesta di subaffitto presente.
                        </div>
                    <?php else: ?>
                        <?php foreach ($templateParams['richiesteSubaffitto'] as $richiestaSubaffitto): ?>
                            <article class="bg-white border p-4 mb-4 rounded-3 shadow-sm">
                                <header class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-start gap-3">
                                        <div>
                                            <h2 class="h5 mb-1 fw-bold">Richiesta subaffitto</h2>
                                            <p class="mb-0 text-muted">Per appartamento in:
                                                <?php echo $richiestaSubaffitto['indirizzo']; echo " " . $richiestaSubaffitto['civico']; ?>. Stanza: <?php echo $richiestaSubaffitto['id_stanza']; ?>
                                            </p>
                                            <p class="mb-0 text-muted">Richiedente:
                                                <?php echo $richiestaSubaffitto['nome']; ?> <?php echo $richiestaSubaffitto['cognome']; ?> Numero cellulare: <?php echo $richiestaSubaffitto['cellulare']; ?> Email: <?php echo $richiestaSubaffitto['email']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <span class="badge rounded-pill bg-warning text-dark d-flex align-items-center">
                                        <i class="bi bi-envelope-exclamation-fill me-1"></i> Subaffitto
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
                                        <i class="bi bi-check2 me-1" aria-hidden="true"></i>Accetta
                                    </button>

                                    <button type="submit" name="action" value="Rifiutata"
                                        class="btn btn-sm btn-outline-danger d-flex align-items-center fw-bold"
                                        aria-label="Rifiuta richiesta">
                                        <i class="bi bi-x-lg me-1" aria-hidden="true"></i>Rifiuta
                                    </button>
                                </form>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Prenotazioni Pane -->
                <div class="tab-pane fade" id="Prenotazioni" role="tabpanel" aria-labelledby="prenotazioni-tab">
                    <?php if (empty($templateParams['prenotazioni'])): ?>
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle-fill me-2"></i> Nessuna prenotazione richiesta.
                        </div>
                    <?php else: ?>
                        <?php foreach ($templateParams['prenotazioni'] as $prenotazione): ?>
                            <article class="bg-white border p-4 mb-4 rounded-3 shadow-sm">
                                <header class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-start gap-3">
                                        <div>
                                            <h2 class="h5 mb-1 fw-bold">Prenotazione</h2>
                                            <p class="mb-0 text-muted">Per appartamento in:
                                                <?php echo $prenotazione['indirizzo']; echo " " . $prenotazione['civico']; ?>. Stanza: <?php echo $prenotazione['id_stanza']; ?>
                                            </p>
                                            <p class="mb-0 text-muted">Richiedente:
                                                <?php echo $prenotazione['nome']; ?> <?php echo $prenotazione['cognome']; ?> Numero cellulare: <?php echo $prenotazione['cellulare']; ?> Email: <?php echo $prenotazione['email']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <span class="badge rounded-pill bg-info text-dark d-flex align-items-center">
                                        <i class="bi bi-calendar-event me-1"></i> Prenotazione
                                    </span>
                                </header>

                                <form action="badgeNotifiche.php" method="POST" class="d-flex gap-2 align-items-center mt-3">
                                    <input type="hidden" name="id_prenotazione"
                                        value="<?php echo $prenotazione['id_prenotazione']; ?>"> <!-- Assuming id_prenotazione is available, check DB query if needed. --> 
                                        <!-- Wait, db query SELECT S.id_stanza... doesn't select id_prenotazione! I need to fix DB query too? -->
                                        <!-- Let's check db/database.php again. The query is: -->
                                        <!-- SELECT S.id_stanza, A.civico, A.indirizzo, Af.nome, Af.cognome, Af.email, Af.cellulare FROM Prenotazione Pr ... -->
                                        <!-- It does NOT select Pr.id_prenotazione. -->
                                    
                                    <button type="submit" name="action_prenotazione" value="Confermata"
                                        class="btn btn-sm btn-success d-flex align-items-center fw-bold"
                                        aria-label="Accetta richiesta">
                                        <i class="bi bi-check2 me-1" aria-hidden="true"></i>Accetta
                                    </button>

                                    <button type="submit" name="action_prenotazione" value="Rifiutata"
                                        class="btn btn-sm btn-outline-danger d-flex align-items-center fw-bold"
                                        aria-label="Rifiuta richiesta">
                                        <i class="bi bi-x-lg me-1" aria-hidden="true"></i>Rifiuta
                                    </button>
                                </form>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>