<div class="mb-4 mt-5 text-left px-3">
    <h1 class="fw-bold"><i class="bi bi-box-arrow-in-right text-success me-2"></i>Login</h1>
    <p class="text-muted">Accedi al tuo account per utilizzare tutti i servizi offerti dal nostro portale.</p>
</div>
<?php if (isset($templateParams["errorelogin"])): ?>
    <p>
        <?php echo $templateParams["errorelogin"]; ?>
    </p>
<?php endif; ?>
<form action="#" method="POST">
    <div class="mb-4">
        <label for="email" class="form-label fw-semibold fs-5">Email</label>
        <input class="form-control" type="email" class="" id="email" name="email"
            placeholder="Inserisci la tua email" require></input>
    </div>
    <div class="mb-4">
        <label for="password" class="form-label fw-semibold fs-5">Password</label>
        <input class="form-control" type="password" class="" id="password" name="password"
            placeholder="Inserisci la tua password" required></input>
    </div>
    <button type="submit" class="btn bg-unibo-red w-100 py-3 rounded-3 shadow-sm fw-bold fs-5">
        <i class="bi bi-box-arrow-in-right me-2"></i> ACCEDI
    </button>
</form>

<div class="text-center mt-4">
    <p class="text-muted">Non hai ancora un account? 
        <a href="registrazione.php" class="text-danger fw-bold text-decoration-none">Registrati ora</a>
    </p>
</div>