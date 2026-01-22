<div class="mb-4 mt-5 text-left px-3">
    <h1 class="fw-bold"><i class="bi bi-megaphone text-primary me-2"></i>Messaggio broadcast</h1>
    <p class="text-muted">Invia un messaggio a tutti gli utenti. Usa questo strumento per comunicazioni importanti o
        avvisi generali.</p>
    <?php if (isset($templateParams["erroreMessaggio"])): ?>
        <p>
            <?php echo $templateParams["erroreMessaggio"]; ?>
        </p>
    <?php endif; ?>
</div>
<form action="#" method="POST">
    <div class="mb-4">
        <label for="messaggio" class="form-label fw-semibold fs-5">Messaggio</label>
        <textarea class="form-control" id="messaggio" name="messaggio" rows="5"
            placeholder="Scrivi qui il tuo messaggio..." required></textarea>
    </div>
    <button type="submit" class="btn bg-unibo-red w-100 py-3 rounded-3 shadow-sm fw-bold fs-5">
        <i class="bi bi-send-fill me-2"></i> INVIA MESSAGGIO
    </button>
</form>