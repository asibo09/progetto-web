<?php $a = $templateParams["annuncio"]; ?>
<nav aria-label="breadcrumb" >
    <a href="<?php echo $templateParams["back_link"]; ?>" class="link-lista large text-info fw-bold text-decoration-none">
        <em class="bi bi-chevron-left"></em> Indietro
    </a>
</nav>
<div class="container py-4">
    <h2 class="fw-bold text-unibo-red mb-4">Modifica Annuncio #<?php echo $a["id_alloggio"]; echo " di "; echo $a["nome"]; echo " "; echo $a["cognome"]; ?></h2>
    
    <form action="processa-modifica-admin.php" method="POST" class="card shadow-sm p-4 border-0 rounded-4">
        <input type="hidden" name="id_alloggio" value="<?php echo $a["id_alloggio"]; ?>">
        <input type="hidden" name="action" value="2"> 
        <div class="mb-3">
            <label for="tipo" class="form-label fw-bold">Tipologia</label>
            <input type="text" class="form-control" id="tipo" name="tipo_immobile" value="<?php echo $a["tipo_immobile"]; ?>" required>
        </div>

        <div class="mb-3">
            <label for="comune" class="form-label fw-bold">Comune</label>
            <input type="text" class="form-control" id="comune" name="comune" value="<?php echo $a["comune"]; ?>" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="indirizzo" class="form-label fw-bold">Indirizzo</label>
                <input type="text" class="form-control" id="indirizzo" name="indirizzo" value="<?php echo $a["indirizzo"]; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="civico" class="form-label fw-bold">Civico</label>
                <input type="number" class="form-control" id="civico" name="civico" value="<?php echo $a["civico"]; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="dist_campus" class="form-label fw-bold">Dist. Campus (km)</label>
                <input type="number" step="0.1" class="form-control" id="dist_campus" name="dist_campus" value="<?php echo $a["distanza_campus_km"]; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="dist_centro" class="form-label fw-bold">Dist. Centro (km)</label>
                <input type="number" step="0.1" class="form-control" id="dist_centro" name="dist_centro" value="<?php echo $a["distanza_centro_km"]; ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="prezzo" class="form-label fw-bold">Prezzo Mensile (€)</label>
            <input type="number" class="form-control" id="prezzo" name="prezzo" value="<?php echo (int)$a["prezzo_mensile_alloggio"]; ?>" required>
        </div>

        <div class="mb-3">
            <label for="desc" class="form-label fw-bold">Descrizione</label>
            <textarea class="form-control" id="desc" name="descrizione" rows="5" required><?php echo $a["descrizione"]; ?></textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-unibo-red px-4 fw-bold rounded-pill">Salva Modifiche</button>
            <a href="admin-index.php" class="btn btn-outline-secondary px-4 rounded-pill">Annulla</a>
        </div>
    </form>
</div>