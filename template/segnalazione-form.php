<?php if(isset($_GET["success"]) && $_GET["success"] == 1): ?>
    <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <strong>Segnalazione inviata!</strong> La tua segnalazione è stata ricevuta correttamente ed è ora in attesa di revisione.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if($templateParams["errore_dati"]): ?>
    <div class="alert alert-warning mx-3 mt-5 shadow-sm border-start border-4 border-warning" role="alert">
        <div class="d-flex">
            <i class="bi bi-exclamation-triangle-fill fs-2 me-3"></i>
            <div>
                <h4 class="alert-heading fw-bold">Dati insufficienti</h4>
                <p>Non è stato possibile identificare l'annuncio o l'utente che desideri segnalare.</p>
                <hr>
                <p class="mb-0">Torna alla <a href="index.php" class="fw-bold text-decoration-none">Home</a> o all'annuncio originale per riprovare.</p>
            </div>
        </div>
    </div>
<?php else: ?>
<div class="mb-4 mt-5 text-left px-3">
    <h1 class="fw-bold"><i class="bi bi-exclamation-triangle text-danger me-2"></i>Invia una segnalazione</h1>
    <p class="text-muted">
        Stai segnalando: 
        <strong><?php echo ($templateParams["tipo"] == 'annuncio' ? "Annuncio #" : "Utente #"); echo $templateParams["id_bersaglio"]; ?></strong>
    </p>
</div>

<form action="segnalazione.php" method="POST" class="container-xl px-3">
    <input type="hidden" name="id_alloggio" value="<?php echo ($templateParams["tipo"] == 'annuncio' ? $templateParams["id_bersaglio"] : ''); ?>">
    <input type="hidden" name="id_utente_target" value="<?php echo ($templateParams["tipo"] == 'utente' ? $templateParams["id_bersaglio"] : ''); ?>">

    <div class="mb-4">
        <label for="categoria" class="form-label fw-semibold fs-5">Scegli la categoria</label>
        <select class="form-select" id="categoria" name="categoria" required>
            <option value="" selected disabled>Seleziona il motivo...</option>
            <option value="Contenuto inappropriato">Contenuto inappropriato</option>
            <option value="Sospetto truffa">Sospetto truffa</option>
            <option value="Comportamento scorretto">Comportamento scorretto</option>
            <option value="Altro">Altro</option>
        </select>
    </div>
    
    <div class="mb-4">
        <label for="motivazione" class="form-label fw-semibold fs-5">Descrivi il problema</label>
        <textarea class="form-control" id="motivazione" name="motivazione" rows="4" required></textarea>
    </div>
    
    <button type="submit" class="btn bg-unibo-red w-100 py-3 rounded-3 shadow-sm fw-bold fs-5 text-white">
        INVIA SEGNALAZIONE
    </button>
</form>
<?php endif; ?>