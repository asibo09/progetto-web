<div class="mb-4">
    <h1 class="h2 fw-bold">Il tuo annuncio</h1>
</div>
<div class="row g-4">
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden sticky-top" style="top: 20px;">
            <div class="bg-light p-4 text-center border-bottom">
                <h2 class="h4 fw-bold mb-1 text-danger">Completa</h2>
                <p class="small text-muted mb-0">Inserisci i dati obbligatori per pubblicare</p>
            </div>

            <div class="list-group list-group-flush shadow-sm" id="step-menu">
                <?php 
                $steps = [
                    "tipologia" => "Tipologia", "localita" => "Località", 
                    "caratteristiche" => "Caratteristiche", "convivenza" => "Convivenza", 
                    "prezzi" => "Prezzo e costi", "descrizione" => "Descrizione", 
                    "foto" => "Foto", "contatti" => "Contatti"
                ];
                foreach($steps as $id => $label): ?>
                <button type="button" onclick="showSection('<?php echo $id; ?>')" 
                        class="list-group-item list-group-item-action py-3 d-flex justify-content-between align-items-center <?php echo $id == 'tipologia' ? 'active' : ''; ?>" 
                        id="btn-<?php echo $id; ?>">
                    <?php echo $label; ?> <span id="status-<?php echo $id; ?>"><i class="bi bi-circle text-muted"></i></span>
                </button>
                <?php endforeach; ?>
            </div>

            <div class="p-3 bg-light border-top">
                <a href="miei-annunci.php" class="btn btn-outline-secondary btn-sm w-100 rounded-3 py-2 fw-semibold shadow-sm bg-white text-primary border-secondary-subtle">
                    Vai ai tuoi annunci
                </a>
            </div>
        </div>
    </div>

    <div class="col-8">
                <div class="card shadow-sm border-0 p-4 p-md-5 rounded-4 bg-white">
                    <form id="form-annuncio" action="processa-pubblicazione.php" method="POST" enctype="multipart/form-data" novalidate>
                        <!-- sezione tipologia -->
                        <div class="form-section" id="sec-tipologia">
                            <h2 class="h4 fw-bold mb-4">Tipologia immobile</h2>
                            <div class="mb-4">
                                <label for="tipo_immobile" class="form-label fw-semibold">Inserisci il tipo di immobile *</label>
                                <input type="text" id="tipo_immobile" name="tipo_immobile" class="form-control rounded-3 py-2"
                                    placeholder="Es. Monolocale" required>
                            </div>

                            <h2 class="h4 fw-bold mb-4 mt-4">Caratteristiche immobile</h2>

                            <div class="row mb-4 g-3">
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold">Stanze in affitto</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button" onclick="changeVal('stanze', -1)">-</button>
                                            <input type="number" id="stanze" name="stanze" class="form-control text-center fw-bold" value="1" min="1" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="changeVal('stanze', 1)">+</button>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold">Superficie totale (mq) *</label>
                                    <input type="number" name="mq_totali" class="form-control rounded-3" placeholder="Es. 120" required>
                                </div>
                            </div>

                            <div class="row g-4 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Totale Piani Edificio *</label>
                                    <input type="number" name="tot_piani" class="form-control rounded-3" placeholder="Es. 4" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Piano dell'immobile *</label>
                                    <input type="number" name="piano" class="form-control rounded-3" placeholder="Es. 0" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold d-block">Con Ascensore? *</label>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="radio" name="ascensore" id="asc-si"
                                            required>
                                        <label class="form-check-label" for="asc-si">Sì</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="radio" name="ascensore" id="asc-no"
                                            required>
                                        <label class="form-check-label" for="asc-no">No</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold d-block">Riscaldamento *</label>
                                    <div class="d-flex gap-3 mt-2 flex-wrap">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="riscaldamento"
                                                id="risc-aut" required>
                                            <label class="form-check-label" for="risc-aut">Autonomo</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="riscaldamento"
                                                id="risc-cent" required>
                                            <label class="form-check-label" for="risc-cent">Centralizzato</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="riscaldamento"
                                                id="risc-no" required>
                                            <label class="form-check-label" for="risc-no">Assente</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h2 class="h4 fw-bold mb-4 mt-4">Composizione immobile</h2>
                            <div class="row g-4">
                                <div class="col-6">
                                    <label class="form-label small fw-semibold d-block">È presente la cucina?</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="toggleSiNo('cucina')">-</button>
                                        <input type="text" id="cucina" name="cucina" class="form-control text-center bg-white fw-bold"
                                            value="No" readonly required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="toggleSiNo('cucina')">+</button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label small fw-semibold d-block">Nr. Camere letto</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('camere', -1)">-</button>
                                        <input type="number" id="camere" name="nr_camere" class="form-control text-center fw-bold"
                                            value="1" min="0" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('camere', 1)">+</button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label small fw-semibold d-block">Nr. Locali totali</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('locali', -1)">-</button>
                                        <input type="number" id="locali" name="nr_locali" class="form-control text-center fw-bold"
                                            value="1" min="0" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('locali', 1)">+</button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label small fw-semibold d-block">Nr. Bagni</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('bagni', -1)">-</button>
                                        <input type="number" id="bagni" name="nr_bagni" class="form-control text-center fw-bold"
                                            value="1" min="0">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('bagni', 1)">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- sezione localita -->
                        <div class="form-section d-none" id="sec-localita">
                            <h2 class="h4 fw-bold mb-4">Dove si trova?</h2>

                            <div class="mb-4">
                                <label for="comune" class="form-label fw-semibold">Inserisci il comune *</label>
                                <input type="text" id="comune" name="comune" class="form-control rounded-3 py-2"
                                    placeholder="Es. Cesena" required>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-8 col-md-9">
                                    <label for="indirizzo" class="form-label fw-semibold">Inserisci l'indirizzo
                                        *</label>
                                    <input type="text" id="indirizzo" name="indirizzo" class="form-control rounded-3 py-2"
                                        placeholder="Es. Via Rossi" required>
                                </div>
                                <div class="col-4 col-md-3">
                                    <label for="civico" class="form-label fw-semibold">N. civico *</label>
                                    <input type="number" id="civico" name="civico" class="form-control rounded-3 py-2 text-center"
                                        placeholder="470" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold d-block">Zona:</label>
                                <div class="d-flex flex-wrap gap-4 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="z-campus" name="z-campus">
                                        <label class="form-check-label" for="z-campus">Campus</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="z-centro" name="z-centro">
                                        <label class="form-check-label" for="z-centro">Centro</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="z-stazione" name="z-stazione">
                                        <label class="form-check-label" for="z-stazione">Stazione</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="z-altro" name="z-altro">
                                        <label class="form-check-label" for="z-altro">Altro</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-6">
                                    <label class="form-label small fw-semibold d-block">Distanza dal Campus (km)</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('dist-campus', -1)">-</button>
                                        <input type="number" id="dist-campus" name="dist-campus" class="form-control text-center fw-bold"
                                            value="0" min="0" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('dist-campus', 1)">+</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-semibold d-block">Distanza dal Centro (km)</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('dist-centro', -1)">-</button>
                                        <input type="number" id="dist-centro" name="dist-centro" class="form-control text-center fw-bold"
                                            value="0" min="0" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('dist-centro', 1)">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- sezione caratteristiche -->
                        <div class="form-section d-none" id="sec-caratteristiche">
                            <div id="stanze-dinamiche-container"></div>
                        </div>

                        <!-- sezione convivenza -->
                        <div class="form-section d-none" id="sec-convivenza">
                            <h2 class="h4 fw-bold mb-4">Dettagli Convivenza</h2>

                            <div class="row g-4">
                                <div class="col-6">
                                    <label class="form-label small fw-semibold d-block">Disponibile per (nr.
                                        persone)</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('disp-persone', -1)">-</button>
                                        <input type="number" id="disp-persone" name="disp-persone" class="form-control text-center fw-bold"
                                            value="0" min="1" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('disp-persone', 1)">+</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-semibold d-block">Nr. attuale coinquilini</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('current-coinq', -1)">-</button>
                                        <input type="number" id="current-coinq" name="current_coinq" class="form-control text-center fw-bold"
                                            value="0" min="0" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('current-coinq', 1)">+</button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label small fw-semibold d-block mb-2">Genere inquilini attuale
                                        *</label>
                                    <div class="d-flex flex-column gap-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="genere-inq" id="g-m">
                                            <label class="form-check-label small" for="g-m">Maschile</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="genere-inq" id="g-f">
                                            <label class="form-check-label small" for="g-f">Femminile</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="genere-inq" id="g-e">
                                            <label class="form-check-label small" for="g-e">Entrambi</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-semibold d-block mb-2">Occupazione inquilini
                                        attuale *</label>
                                    <div class="d-flex flex-column gap-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="occ-inq" id="o-s">
                                            <label class="form-check-label small" for="o-s">Studenti</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="occ-inq" id="o-l">
                                            <label class="form-check-label small" for="o-l">Lavoratori</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="occ-inq" id="o-e">
                                            <label class="form-check-label small" for="o-e">Entrambi</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label small fw-semibold d-block">Il proprietario vive in
                                        casa?</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="toggleSiNo('prop-casa')">-</button>
                                        <input type="text" id="prop-casa" name="prop-casa"
                                            class="form-control text-center bg-white fw-bold" value="No" readonly
                                            required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="toggleSiNo('prop-casa')">+</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label small fw-semibold d-block mb-2">Regole della casa</label>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="rule-anim">
                                                <label class="form-check-label small" for="rule-anim">Animali
                                                    accettati</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="rule-fum">
                                                <label class="form-check-label small" for="rule-fum">Fumatori
                                                    accettati</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="rule-coppie">
                                                <label class="form-check-label small" for="rule-coppie">Coppie
                                                    accettate</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- sezione prezzi -->
                        <div class="form-section d-none" id="sec-prezzi">
                            <h2 class="h4 fw-bold mb-4">Prezzo e costi</h2>

                            <div class="row g-4">
                                <div class="col-6">
                                    <label for="canone" class="form-label small fw-semibold">Canone mensile (€/mese)
                                        *</label>
                                    <input type="number" id="canone" name="canone" class="form-control" placeholder="Es. 450" min="1"
                                        required>
                                </div>
                                <div class="col-6">
                                    <label for="cauzione" class="form-label small fw-semibold">Cauzione (€) *</label>
                                    <input type="number" id="cauzione" name="cauzione" class="form-control" placeholder="Es. 900"
                                        min="0" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label small fw-semibold d-block mb-2">Utenze incluse nel
                                        canone:</label>
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ut-acqua" name="ut-acqua">
                                            <label class="form-check-label small" for="ut-acqua">Acqua</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ut-internet" name="ut-internet">
                                            <label class="form-check-label small" for="ut-internet">Internet</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ut-gas" name="ut-gas">
                                            <label class="form-check-label small" for="ut-gas">Gas</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ut-luce" name="ut-luce">
                                            <label class="form-check-label small" for="ut-luce">Elettricità</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label for="costo-utenze" class="form-label small fw-semibold">Costo utenze
                                        (€/mese)</label>
                                    <input type="number" id="costo-utenze" name="costo-utenze" class="form-control" placeholder="Es. 50"
                                        min="0">
                                </div>
                                <div class="col-6">
                                    <label for="disponibile-dal" class="form-label small fw-semibold">Disponibile dal
                                        (mese/anno) *</label>
                                    <input type="month" id="disponibile-dal" name="disponibile-dal" class="form-control" required>
                                </div>

                                <div class="col-6">
                                    <label class="form-label small fw-semibold d-block">Permanenza minima (mesi)
                                        *</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('perm-min', -1)">-</button>
                                        <input type="number" id="perm-min" name="perm-min" class="form-control text-center fw-bold"
                                            value="12" min="1" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="changeVal('perm-min', 1)">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- sezione descrizione -->
                        <div class="form-section d-none" id="sec-descrizione">
                            <h2 class="h4 fw-bold mb-4">Descrizione</h2>
                            <p class="small mb-2">Inserisci una descrizione *</p>
                            <textarea class="form-control rounded-4" rows="6" id="descrizione" name="descrizione" placeholder="Descrivi l'immobile..."
                                required></textarea>
                        </div>

                        <!-- sezione foto -->
                        <div class="form-section d-none" id="sec-foto">
                            <h2 class="h4 fw-bold mb-4">Foto</h2>
                            <p class="small mb-2">Inserisci almeno una foto *</p>

                            <div class="upload-box text-center p-5 border border-2 border-dashed rounded-4 bg-light cursor-pointer"
                                onclick="document.getElementById('input-foto').click()">
                                <i class="bi bi-plus-lg display-1 text-danger"></i>
                                <p class="mt-3 fw-bold mb-0">Caricate: <span id="foto-count">0</span> su 20</p>
                                    <input type="file" id="input-foto" name="foto_alloggio[]" class="d-none" multiple accept="image/*" onchange="handleFiles(this)">                            
                                </div>
                            <div id="preview-container" class="row g-2 mt-4">
                            </div>
                        </div>

                        <!-- sezione contatti -->
                        <div class="form-section d-none" id="sec-contatti">
                            <h2 class="h4 fw-bold mb-4">Contatti per l'annuncio</h2>

                            <div class="row g-4 mb-5">
                                <div class="col-12 col-md-6">
                                    <label for="email-pubblica" class="form-label fw-semibold">Email di contatto
                                        *</label>
                                    <input type="email" id="email-pubblica" class="form-control fw-bold py-2"
                                        value="roberto@example.com" required>
                                    <div class="invalid-feedback">Inserisci un'email valida.</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="tel-pubblica" class="form-label fw-semibold">Telefono di contatto
                                        *</label>
                                    <input type="tel" id="tel-pubblica" class="form-control fw-bold py-2"
                                        value="333 1234567" required>
                                    <div class="invalid-feedback">Il numero di telefono è obbligatorio.</div>
                                </div>
                            </div>

                            <div class="alert alert-info border-0 rounded-4 d-flex align-items-center mb-4"
                                role="alert">
                                <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                                <div class="small">Controlla di aver inserito correttamente tutti i dati prima di
                                    procedere alla pubblicazione definitiva.</div>
                            </div>

                            <button type="submit"
                                class="btn btn-unibo-red btn-lg w-100 rounded-pill fw-bold py-3 shadow border-0">
                                <i class="bi bi-check2-circle me-2"></i> PUBBLICA ANNUNCIO ORA
                            </button>
                        </div>

                        <div id="nav-buttons" class="mt-5 pt-4 border-top d-flex justify-content-between">
                            <button type="button" id="prevBtn"
                                class="btn btn-outline-secondary px-4 rounded-pill d-none"
                                onclick="nextPrev(-1)">Indietro</button>
                            <button type="button" id="nextBtn" class="btn btn-unibo-red px-4 rounded-pill ms-auto"
                                onclick="nextPrev(1)">Prosegui</button>
                        </div>

                    </form>
                </div>
            </div>
</div>

<script src="js/pubblica-annuncio.js"></script>