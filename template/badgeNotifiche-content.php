<div class="mb-4 mt-5 text-left px-3">
    <h1 class="fw-bold"><i class="bi bi-chat-left-text fs-2"></i> <?php echo $templateParams['titolo']; ?></h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-8">

                <?php foreach ($templateParams['notifiche'] as $notifica): ?>
                    <article class="bg-white border p-4 mb-4">
                        <header class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-start gap-3">
                                <div>
                                    <h2 class="h5 mb-1"><?php echo $notifica['data_invio']; ?></h2>
                                </div>
                            </div>
                            <!-- Badge di notifica a destra -->
                            <span class="badge rounded-pill bg-unibo-red text-white d-flex align-items-center">
                                <i class="bi bi-bell-fill me-1"></i>
                                Notifica
                            </span>
                        </header>
                        <section>
                            <h3 class="visually-hidden">Dettagli notifica</h3>
                            <p><?php echo $notifica['testo']; ?></p>
                        </section>
                    </article>
                <?php endforeach; ?>

                <?php foreach ($templateParams['richiesteSubaffitto'] as $richiestaSubaffitto): ?>
                    <article class="bg-white border p-4 mb-4">
                        <header class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-start gap-3">
                                <div>
                                    <h2 class="h5 mb-1">Richiesta subaffitto</h2>
                                    <p>Richiesta subaffitto per <?php echo $richiestaSubaffitto['tipo_immobile']; echo $richiestaSubaffitto['id_stanza']; ?></p>
                                </div>
                            </div>
                            <!-- Badge di notifica a destra -->
                            <span class="badge rounded-pill bg-unibo-red text-white d-flex align-items-center">
                                <i class="bi bi-bell-fill me-1"></i>
                                Subaffitto
                            </span>
                        </header>

                    <form action="badgeNotifiche.php" method="POST" class="d-flex gap-2 align-items-center">
                        
                        <input type="hidden" name="id_richiesta" value="<?php echo $richiestaSubaffitto['id_richiesta']; ?>">
                        
                        <button type="submit" name="action" value="Confermata"
                            class="btn btn-sm btn-success d-flex align-items-center" aria-label="Accetta richiesta">
                            <i class="bi bi-check2 me-1" aria-hidden="true"></i>Accetta
                        </button>

                        <button type="submit" name="action" value="Rifiutata"
                            class="btn btn-sm btn-outline-danger d-flex align-items-center"
                            aria-label="Rifiuta richiesta">
                            <i class="bi bi-x-lg me-1" aria-hidden="true"></i>Rifiuta
                        </button>
                    </form>

                    </article>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>