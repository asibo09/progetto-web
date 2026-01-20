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