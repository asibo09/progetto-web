<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <!-- Card principale -->
            <div class="card shadow-sm border-0 rounded-4">

                <!-- Intestazione -->
                <div class="card-header bg-white border-bottom-0 pt-5 pb-0 text-center">
                    <div class="bg-light d-inline-block p-3 rounded-circle mb-3">
                        <i class="bi bi-person-circle fs-1 text-danger"></i>
                    </div>
                    <h1 class="fw-bold h2 mb-1">I Tuoi Dati</h1>
                    <p class="text-muted">Riepilogo delle informazioni del tuo profilo</p>
                </div>

                <!-- Corpo della card -->
                <div class="card-body p-4 p-md-5">

                    <!-- Griglia dei dati -->
                    <div class="row g-4 text-start">

                        <!-- Nome -->
                        <div class="col-md-6 border-bottom pb-3">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Nome</label>
                            <p class="fs-5 mb-0 fw-semibold text-dark"><?php echo $userData["nome"]; ?></p>
                        </div>

                        <!-- Cognome -->
                        <div class="col-md-6 border-bottom pb-3">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Cognome</label>
                            <p class="fs-5 mb-0 fw-semibold text-dark"><?php echo $userData["cognome"]; ?></p>
                        </div>

                        <!-- Email -->
                        <div class="col-12 border-bottom pb-3">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Indirizzo Email</label>
                            <p class="fs-5 mb-0 fw-semibold text-dark"><?php echo $userData["email"]; ?></p>
                        </div>

                        <!-- Cellulare -->
                        <div class="col-md-6 border-bottom pb-3">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Cellulare</label>
                            <p class="fs-5 mb-0 fw-semibold text-dark"><?php echo $userData["cellulare"]; ?></p>
                        </div>

                        <!-- Età -->
                        <div class="col-md-6 border-bottom pb-3">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Età</label>
                            <p class="fs-5 mb-0 fw-semibold text-dark"><?php echo $userData["eta"]; ?></p>
                        </div>

                        <!-- Ruolo -->
                        <div class="col-md-6 border-bottom pb-3">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Ruolo Account</label>
                            <p class="mb-0">
                                <?php echo $userData["ruolo"]; ?>
                            </p>
                        </div>

                        <!-- Data Registrazione -->
                        <div class="col-md-6 border-bottom pb-3">
                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Membro dal</label>
                            <p class="fs-5 mb-0 fw-semibold text-dark">
                                <?php echo $userData["data_registrazione"]; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer informativo -->
            <div class="text-center mt-4">
                <p class="text-muted small">
                    <i class="bi bi-info-circle me-1"></i>
                    I tuoi dati sono protetti e visibili solo a te e agli amministratori del portale.
                </p>
            </div>

        </div>
    </div>
</div>