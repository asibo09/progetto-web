<div class="mb-4 mt-5 text-left px-3">
    <h1 class="fw-bold"><?php echo $templateParams['titolo']; ?></h1>
</div>

<form action="richiestaSubaffitto.php" method="POST" class="container-xl px-3">
    <div class="mb-2">

        <label for="stanza" class="form-label fw-semibold fs-5">Per quale stanza?</label>
        <select class="form-select" id="stanza" name="stanza" required>
            <?php foreach ($templateParams['stanze'] as $stanza): ?>
                <option value="<?php echo $stanza['id_stanza']; ?>"
                    <?php 
                        //Se id_stanza è nell'URL e coincide la seleziona automaticamente
                        if(isset($_GET["id"]) && $_GET["id"] == $stanza['id_alloggio']) {
                        echo "selected";
                        }
                    ?>>
                    <?php echo $stanza['tipo_immobile']; ?>, <?php echo $stanza['indirizzo']; ?>, <?php echo $stanza['civico']; ?>. Stanza: <?php echo $stanza['id_stanza']?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="mb-3">
            <label for="messaggioProprietario" class="form-label fw-semibold fs-5 mt-3">Messaggio per il
                proprietario</label>
            <input type="text" class="form-control" id="messaggioProprietario" name="messaggioProprietario"
                placeholder="Scrivi qui il tuo messaggio..." required>
        </div>
        <button type="submit" class="btn bg-unibo-red w-100 py-3 rounded-3 shadow-sm fw-bold fs-5">
            <i class="bi bi-send-fill me-2"></i> INVIA
        </button>

    </div>
</form>


