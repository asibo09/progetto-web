<div class="container">
    <?php if(isset($_GET["msg"])): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
            <em class="bi bi-check-all me-2"></em>
            <strong>Successo:</strong> <?php echo htmlspecialchars($_GET["msg"]); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <h1 class="mb-4 fw-bold text-unibo-red">Pannello di Amministrazione</h1>

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
                                <td style="min-width: 250px; max-width: 400px;">
                                    <div style="white-space: normal; word-wrap: break-word;">
                                    <?php echo $s["descrizione"]; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if($s["id_alloggio_segnalato"]): ?>
                                        <span class="text-danger"><em class="bi bi-house-door me-1"></em>Alloggio #<?php echo $s["id_alloggio_segnalato"]; ?></span>
                                    <?php else: ?>
                                        <span class="text-info"><em class="bi bi-person me-1"></em>Utente #<?php echo $s["id_utente_segnalato"]; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <?php if($s["id_alloggio_segnalato"]): ?>
                                            <a href="annuncio.php?id=<?php echo $s["id_alloggio_segnalato"]; ?>" class="btn btn-outline-primary" title="Vedi Annuncio"><em class="bi bi-eye"></em></a>
                                        <?php else: ?>
                                            <a href="profilo-altro-utente.php?id=<?php echo $s["id_utente_segnalato"]; ?>" class="btn btn-outline-primary" title="Vedi Profilo"><em class="bi bi-eye"></em></a>
                                        <?php endif; ?>
                                        
                                        <a href="admin-index.php?action=delete&target=<?php echo $s['id_alloggio_segnalato'] ? 'alloggio' : 'utente'; ?>&id=<?php echo $s['id_alloggio_segnalato'] ?? $s['id_utente_segnalato']; ?>" 
                                            class="btn btn-outline-danger" 
                                            title="<?php echo $s['id_alloggio_segnalato'] ? 'Elimina annuncio' : 'Elimina profilo utente'; ?>" 
                                            onclick="return confirm('Sei sicuro di voler procedere con l\'eliminazione definitiva?')">
                                            <em class="bi bi-trash"></em>
                                        </a>
                                        
                                        <a href="admin-index.php?action=ignore&id=<?php echo $s['id_segnalazione']; ?>" 
                                           class="btn btn-outline-secondary" title="Ignora segnalazione"><em class="bi bi-x-circle"></em></a>
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
                                    <img src="<?php echo UPLOAD_DIR . $a['foto_copertina']; ?>" alt="Anteprima di un <?php echo $a['tipo_immobile']; ?> situato in <?php echo $a['indirizzo']; ?>, <?php echo $a['comune']; ?>" 
                                        style="width: 200px; height: 150px; object-fit: cover;" 
                                        class="rounded border shadow-sm">
                                </td>
                                <td>#<?php echo $a["id_alloggio"]; ?></td>
                                <td>
                                    <div class="fw-bold"><?php echo $a["indirizzo"]; echo " "; echo $a["civico"] ?></div>
                                    <small class="text-muted"><?php echo $a["comune"]; ?></small>
                                </td>
                                <td><small><?php echo $a["email_proprietario"]; ?></small></td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="annuncio.php?id=<?php echo $a["id_alloggio"]; ?>" class="btn btn-outline-primary" title="Vedi"><em class="bi bi-eye"></em></a>
                                        <a href="admin-modifica-annuncio.php?id=<?php echo $a["id_alloggio"]; ?>" class="btn btn-outline-warning" title="Modifica">
                                            <em class="bi bi-pencil"></em>
                                        </a>
                                        <a href="admin-index.php?action=delete_alloggio&id=<?php echo $a["id_alloggio"]; ?>" 
                                            class="btn btn-outline-danger" title="Elimina annuncio"
                                            onclick="return confirm('Sei sicuro di voler eliminare definitivamente questo annuncio?')">
                                            <em class="bi bi-trash"></em>
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
        
        <div class="tab-pane fade" id="broadcast" role="tabpanel">
            <div class="row">
                <div class="col-md-7">
                    <div class="card shadow-sm border-0 p-4">
                        <h5 class="fw-bold mb-3"><em class="bi bi-megaphone me-2"></em>Nuovo Messaggio Broadcast</h5>
                        <form action="admin-index.php" method="POST">
                            <div class="mb-3">
                                <label for="testo_broadcast" class="fw-semibold mb-2">Testo del messaggio broadcast</label>
                                <textarea class="form-control" id="testo_broadcast" name="testo_broadcast" rows="4" 
                                    placeholder="Scrivi qui il messaggio che riceveranno tutti gli utenti (max 255 caratteri)..." maxlength="255" required></textarea></div>
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
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Se nell'URL è presente il parametro 'msg'
    if (window.location.search.includes('msg=')) {
        // Creiamo un nuovo URL senza il parametro msg
        const url = new URL(window.location.href);
        url.searchParams.delete('msg');
        
        // Sostituiamo l'URL nella cronologia del browser senza ricaricare la pagina
        window.history.replaceState({}, document.title, url.pathname + url.search);
    }
});
</script>