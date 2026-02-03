<div class="row justify-content-center mt-5">
    <div class="col-12 col-lg-8">
        
        <!-- Card: Flex Container Principale -->
        <section class="card border shadow-sm rounded-4 overflow-hidden">

            <!-- Intestazione: Flex Column per allineamento centrale verticale -->
            <div class="card-header bg-white border-0 pt-5 pb-0 d-flex flex-column align-items-center">
                <!-- Icona Container -->
                <div class="bg-light rounded-circle p-4 mb-3 d-flex align-items-center justify-content-center">
                    <em class="bi bi-person-circle text-danger display-3 lh-1"></em>
                </div>
                <h1 class="h2 fw-bold mb-1">I Tuoi Dati</h1>
                <p class="text-muted">Riepilogo delle informazioni del tuo profilo</p>
            </div>

            <!-- Corpo -->
            <div class="card-body p-4 p-md-5">
                <div class="row g-4">

                    <!-- Nome -->
                    <div class="col-md-6">
                        <div class="d-flex flex-column border-bottom pb-3 h-100">
                            <span class="text-muted small text-uppercase fw-bold mb-2">Nome</span>
                            <span class="fs-5 fw-semibold text-dark"><?php echo $userData["nome"]; ?></span>
                        </div>
                    </div>

                    <!-- Cognome -->
                    <div class="col-md-6">
                        <div class="d-flex flex-column border-bottom pb-3 h-100">
                            <span class="text-muted small text-uppercase fw-bold mb-2">Cognome</span>
                            <span class="fs-5 fw-semibold text-dark"><?php echo $userData["cognome"]; ?></span>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-12">
                        <div class="d-flex flex-column border-bottom pb-3">
                            <span class="text-muted small text-uppercase fw-bold mb-2">Indirizzo Email</span>
                            <span class="fs-5 fw-semibold text-dark"><?php echo $userData["email"]; ?></span>
                        </div>
                    </div>

                    <!-- Cellulare -->
                    <div class="col-md-6">
                        <div class="d-flex flex-column border-bottom pb-3 h-100">
                            <span class="text-muted small text-uppercase fw-bold mb-2">Cellulare</span>
                            <span class="fs-5 fw-semibold text-dark"><?php echo $userData["cellulare"]; ?></span>
                        </div>
                    </div>

                    <!-- Età -->
                    <div class="col-md-6">
                        <div class="d-flex flex-column border-bottom pb-3 h-100">
                            <span class="text-muted small text-uppercase fw-bold mb-2">Età</span>
                            <span class="fs-5 fw-semibold text-dark"><?php echo $userData["eta"]; ?></span>
                        </div>
                    </div>

                    <!-- Ruolo -->
                    <div class="col-md-6">
                        <div class="d-flex flex-column border-bottom pb-3 h-100">
                            <span class="text-muted small text-uppercase fw-bold mb-2">Ruolo Account</span>
                            <span class="fs-5 fw-semibold text-dark"><?php echo $userData["ruolo"]; ?></span>
                        </div>
                    </div>

                    <!-- Data Registrazione -->
                    <div class="col-md-6">
                        <div class="d-flex flex-column border-bottom pb-3 h-100">
                            <span class="text-muted small text-uppercase fw-bold mb-2">Membro dal</span>
                            <span class="fs-5 fw-semibold text-dark"><?php echo $userData["data_registrazione"]; ?></span>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>