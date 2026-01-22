<div class="mb-4 mt-5 text-left px-3">
    <h1 class="fw-bold"><i class="bi bi-person-plus text-success me-2"></i>Registrazione</h1>
    <p class="text-muted">Crea il tuo account per accedere a tutti i servizi offerti dal nostro portale.</p>
    <?php if (isset($templateParams["erroreRegistrazione"])): ?>
        <p>
            <?php echo $templateParams["erroreRegistrazione"]; ?>
        </p>
    <?php endif; ?>
</div>
<form action="#" method="POST">
    <div class="mb-4">
        <label for="nome" class="form-label fw-semibold fs-5">Nome</label>
        <input class="form-control" type="text" class="" id="nome" name="nome" placeholder="Inserisci nome"></input>
    </div>
    <div class="mb-4">
        <label for="cognome" class="fw-bold">Cognome</label>
        <input type="text" class="form-control" id="cognome" name="cognome" placeholder="Inserisci cognome"></input>
    </div>
    <div class="mb-4">
        <label for="email" class="form-label fw-semibold fs-5">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Inserisci email"></input>
    </div>
    <div class="mb-4">
        <label for="password" class="form-label fw-semibold fs-5">Password</label>
        <input type="password" class="form-control" id="password" name="password"
            placeholder="Inserisci password"></input>
    </div>
    <div class="mb-4">
        <label for="cellulare" class="form-label fw-semibold fs-5">Cellulare</label>
        <input type="text" class="form-control" id="cellulare" name="cellulare"
            placeholder="Inserisci cellulare"></input>
    </div>
    <div class="mb-4">
        <label for="eta" class="form-label fw-semibold fs-5">Eta</label>
        <input type="number" class="form-control" id="eta" name="eta" placeholder="Inserisci eta"></input>
    </div>
    <div class="mb-4">
        <label for="ruolo" class="form-label fw-semibold fs-5">Ruolo</label>
        <select class="form-select" id="ruolo" name="ruolo">
            <option value="studente">Affittuario</option>
            <option value="proprietario">Proprietario</option>
        </select>
    </div>
    <button type="submit" class="btn bg-unibo-red w-100 py-3 rounded-3 shadow-sm fw-bold fs-5">
        <i class="bi bi-person-plus-fill me-2"></i> REGISTRATI
    </button>
</form>

<div class="text-center mt-4">
    <p class="text-muted">Hai già un account? 
        <a href="login.php" class="text-danger fw-bold text-decoration-none">Accedi qui</a>
    </p>
</div>