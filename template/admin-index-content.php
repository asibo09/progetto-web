<div class="container">
    <h2 class="mb-4 fw-bold text-unibo-red">Pannello di Amministrazione</h2>

    <ul class="nav nav-tabs mb-4" id="adminTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold text-dark" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports" type="button" role="tab">Segnalazioni</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold text-dark" id="ads-tab" data-bs-toggle="tab" data-bs-target="#ads" type="button" role="tab">Gestione Annunci</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold text-dark" id="broadcast-tab" data-bs-toggle="tab" data-bs-target="#broadcast" type="button" role="tab">Notifica Broadcast</button>
        </li>
    </ul>

    <div class="tab-content" id="adminTabContent">
        <div class="tab-pane fade show active" id="reports" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h4 mb-0">Elenco Segnalazioni</h3>
                    <span class="badge bg-danger fs-6">
                    <?php echo count($templateParams["segnalazioni"]); ?> Segnalazioni totali
                    </span>
            </div>
            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Segnalatore</th>
                                <th>Categoria</th>
                                <th>Motivo</th>
                                <th>Target</th>
                                <th class="text-center">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($templateParams["segnalazioni"] as $s): ?>
                            <tr>
                                <td><small><?php echo $s["email_segnalatore"]; ?></small></td>
                                <td><span class="badge bg-secondary"><?php echo $s["categoria"]; ?></span></td>
                                <td class="text-truncate" style="max-width: 200px;"><?php echo $s["descrizione"]; ?></td>
                                <td>
                                    <?php if($s["id_alloggio_segnalato"]): ?>
                                        <span class="text-danger"><i class="bi bi-house-door me-1"></i>Alloggio #<?php echo $s["id_alloggio_segnalato"]; ?></span>
                                    <?php else: ?>
                                        <span class="text-info"><i class="bi bi-person me-1"></i>Utente #<?php echo $s["id_utente_segnalato"]; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <?php if($s["id_alloggio_segnalato"]): ?>
                                            <a href="annuncio.php?id=<?php echo $s["id_alloggio_segnalato"]; ?>" class="btn btn-outline-primary" title="Vedi Annuncio"><i class="bi bi-eye"></i></a>
                                        <?php else: ?>
                                            <a href="profilo-altro-utente.php?id=<?php echo $s["id_utente_segnalato"]; ?>" class="btn btn-outline-primary" title="Vedi Profilo"><i class="bi bi-eye"></i></a>
                                        <?php endif; ?>
                                        
                                        <a href="admin-index.php?action=delete&target=<?php echo $s['id_alloggio_segnalato'] ? 'alloggio' : 'utente'; ?>&id=<?php echo $s['id_alloggio_segnalato'] ?? $s['id_utente_segnalato']; ?>" 
                                            class="btn btn-outline-danger" 
                                            title="<?php echo $s['id_alloggio_segnalato'] ? 'Elimina annuncio' : 'Elimina profilo utente'; ?>" 
                                            onclick="return confirm('Sei sicuro di voler procedere con l\'eliminazione definitiva?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        
                                        <a href="admin-index.php?action=ignore&id=<?php echo $s['id_segnalazione']; ?>" 
                                           class="btn btn-outline-secondary" title="Ignora segnalazione"><i class="bi bi-x-circle"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="ads" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Tutti gli Annunci</h4>
                <span class="badge bg-primary fs-6">
                <?php echo count($templateParams["alloggi_totali"]); ?> Alloggi pubblicati
                </span>
            </div>
            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="pe-3" style="width: 1%; white-space: nowrap;">Anteprima</th>
                                <th>ID</th> 
                                <th>Indirizzo</th>
                                <th>Proprietario</th>
                                <th class="text-center">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($templateParams["alloggi_totali"] as $a): ?>
                            <tr>
                                <td>
                                    <img src="<?php echo UPLOAD_DIR . $a["foto_copertina"]; ?>" 
                                        alt="" 
                                        style="width: 200px; height: 150px; object-fit: cover;" 
                                        class="rounded border shadow-sm">
                                </td>
                                <td>#<?php echo $a["id_alloggio"]; ?></td>
                                <td>
                                    <div class="fw-bold"><?php echo $a["indirizzo"]; ?></div>
                                    <small class="text-muted"><?php echo $a["comune"]; ?></small>
                                </td>
                                <td><small><?php echo $a["email_proprietario"]; ?></small></td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="annuncio.php?id=<?php echo $a["id_alloggio"]; ?>" class="btn btn-outline-primary" title="Vedi"><i class="bi bi-eye"></i></a>
                                        <a href="admin-index.php?action=delete_alloggio&id=<?php echo $a["id_alloggio"]; ?>" 
                                            class="btn btn-outline-danger" title="Elimina annuncio"
                                            onclick="return confirm('Sei sicuro di voler eliminare definitivamente questo annuncio?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-content" id="adminTabContent">
    <div class="tab-pane fade" id="broadcast" role="tabpanel">
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-megaphone me-2"></i>Nuovo Messaggio Broadcast</h5>
                <form action="admin-index.php" method="POST">
                    <div class="mb-3">
                        <textarea class="form-control" name="testo_broadcast" rows="4" 
                                  placeholder="Scrivi qui il messaggio che riceveranno tutti gli utenti (max 255 caratteri)..." 
                                  maxlength="255" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-unibo-red w-100 fw-bold">Invia a tutti</button>
                </form>
            </div>
        </div>
        
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light fw-bold">Ultime comunicazioni inviate</div>
                <div class="list-group list-group-flush">
                    <?php foreach($templateParams["storico_broadcast"] as $b): ?>
                        <div class="list-group-item">
                            <small class="text-muted d-block"><?php echo $b["data_invio"]; ?></small>
                            <p class="mb-0 small"><?php echo $b["testo"]; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>