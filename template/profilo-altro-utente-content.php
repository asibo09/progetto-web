<?php $u = $templateParams["utente"]; ?>
<nav aria-label="breadcrumb" class="mb-3">
    <a href="<?php echo $templateParams["back_link"]; ?>" class="link-lista large text-info fw-bold text-decoration-none">
        <i class="bi bi-chevron-left"></i> Indietro
    </a>
</nav>
<h1 class="fw-bold mb-5">Profilo utente di <?php echo $u["nome"]; ?></h1>

<div class="row g-4 <?php echo ($u["ruolo"] == 'studente') ? 'justify-content-center' : ''; ?>">
    <div class="col-12 <?php echo ($u["ruolo"] == 'studente') ? 'col-lg-8' : 'col-lg-5'; ?>">
        <div class="d-flex flex-column gap-4">
            <div class="card shadow-sm border-0 p-4 rounded-3">
                <h2 class="h4 fw-bold border-bottom pb-2 mb-3">
                    <i class="bi bi-info-circle me-2 text-danger"></i>Informazioni personali
                </h2>
                <p class="mb-1"><strong>Nome:</strong> <?php echo $u["nome"]; ?></p>
                <p class="mb-1"><strong>Cognome:</strong> <?php echo $u["cognome"]; ?></p>
                <p class="mb-1"><strong>Età:</strong> <?php echo $u["eta"]; ?></p>
                <p class="mb-1"><strong>Registrato il:</strong> <?php echo date("d/m/Y", strtotime($u["data_registrazione"])); ?></p>
                <p class="mb-0 text-danger fw-bold">Ruolo: <?php echo ucfirst($u["ruolo"]); ?></p>
            </div>

            <div class="card shadow-sm border-0 p-4 rounded-3">
                <h2 class="h4 fw-bold border-bottom pb-2 mb-3">
                    <i class="bi bi-envelope-at me-2 text-danger"></i>Contatti
                </h2>
                <p class="mb-2">
                    <i class="bi bi-envelope me-2"></i><strong>Email:</strong>
                    <a href="mailto:<?php echo $u["email"]; ?>" class="text-dark text-decoration-none"><?php echo $u["email"]; ?></a>
                </p>
                <p class="mb-0">
                    <i class="bi bi-telephone me-2"></i><strong>Telefono:</strong>
                    <a href="tel:<?php echo $u["cellulare"]; ?>" class="text-dark text-decoration-none"><?php echo $u["cellulare"]; ?></a>
                </p>
            </div>
        </div>
    </div>
    <?php if($u["ruolo"] == 'proprietario'): ?>
    <div class="col-12 col-lg-7">
        <div class="card shadow-sm border-0 p-4 rounded-3 h-100">
            <h2 class="h4 fw-bold border-bottom pb-2 mb-3">
                <i class="bi bi-house-door me-2 text-danger"></i>Annunci di <?php echo $u["nome"]; ?>
            </h2>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <span class="fw-semibold text-dark fs-6"><?php echo count($templateParams["annunci"]); ?> alloggi trovati</span>
            </div>

            <div class="d-flex flex-column gap-3">
                <?php foreach($templateParams["annunci"] as $annuncio): 
                    $cID = "carouselProp" . $annuncio["id_alloggio"]; 
                    $foto = $annuncio["lista_foto"];
                ?>
                <div class="card border rounded-3 overflow-hidden shadow-sm position-relative card-annuncio-hover">
                    <div class="row g-0 align-items-stretch">
                        <div class="col-4 border-end position-relative custom-carousel-container">
                            <div id="<?php echo $cID; ?>" class="carousel slide h-100" data-bs-ride="false">
                                <div class="carousel-counter badge">
                                    <span class="current-slide">1</span>/<span class="total-slides"><?php echo count($foto); ?></span>
                                </div>
                                <div class="carousel-inner h-100">
                                    <?php foreach($foto as $idx => $f): ?>
                                    <div class="carousel-item <?php echo $idx === 0 ? 'active' : ''; ?> h-100">
                                        <a href="annuncio.php?id=<?php echo $annuncio["id_alloggio"]; ?>" class="d-block h-100">
                                            <img src="upload/<?php echo $f['percorso_immagine']; ?>" class="img-fit" alt="Foto">
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <button class="carousel-control-prev custom-arrow" type="button" data-bs-target="#<?php echo $cID; ?>" data-bs-slide="prev">
                                    <span class="arrow-circle"><i class="bi bi-chevron-left"></i></span>
                                </button>
                                <button class="carousel-control-next custom-arrow" type="button" data-bs-target="#<?php echo $cID; ?>" data-bs-slide="next">
                                    <span class="arrow-circle"><i class="bi bi-chevron-right"></i></span>
                                </button>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="card-body p-3">
                                <a href="annuncio.php?id=<?php echo $annuncio["id_alloggio"]; ?>" class="stretched-link text-decoration-none text-dark">
                                    <h3 class="h5 fw-bold mb-1"><?php echo $annuncio["tipo_immobile"]; ?></h3>
                                </a>
                                <p class="text-muted small mb-1"><i class="bi bi-geo-alt-fill me-1 text-danger"></i><?php echo $annuncio["indirizzo"]; ?>, <?php echo $annuncio["civico"]; ?> - <?php echo $annuncio["comune"]; ?></p>
                                <p class="small mb-3 text-secondary"><?php echo $annuncio["distanza_campus_km"]; ?> km dal Campus, <?php echo $annuncio["distanza_centro_km"]; ?> km dal centro</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-danger fw-bold fs-5"><?php echo (int)$annuncio["prezzo_mensile_alloggio"]; ?>€</span>
                                    <div class="d-flex gap-2 align-items-center" style="position: relative; z-index: 50;">
        
                                        <?php 
                                        $idLoggato = $_SESSION["id_utente"] ?? -1;
                                        // 1. Controllo: Non mostrare il tasto prenota se l'alloggio è dell'utente stesso o è admin
                                        if($annuncio["id_proprietario"] != $idLoggato && isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] != 'admin'):
            
                                            // 2. Controllo disponibilità stanze
                                            if($annuncio["disponibile"]): ?>
                                                <a href="javascript:void(0)" 
                                                    class="btn btn-prenota text-info btn-outline-info rounded-pill px-3 py-1 d-flex align-items-center gap-2 fw-semibold btn-apri-prenota"
                                                    data-id="<?php echo $annuncio["id_alloggio"]; ?>"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalPrenotazione">
                                                    <i class="bi bi-calendar-check"></i><span>Prenota</span>
                                                </a>
                                            <?php else: ?>
                                                <button class="btn btn-secondary rounded-pill px-3 py-1 btn-sm fw-semibold opacity-50" disabled>
                                                    <i class="bi bi-calendar-x me-2"></i>Esaurito
                                                </button>
                                            <?php endif; ?>

                                        <?php endif; ?>

                                        <?php if($annuncio["id_proprietario"] != $idLoggato && isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] != 'admin'): ?>
                                            <?php $isFav = in_array($annuncio["id_alloggio"], $templateParams["preferiti_ids"]); ?>
                                            <button type="button" 
                                                class="btn btn-link p-2 btn-cuore <?php echo $isFav ? 'active' : ''; ?>" 
                                                data-id="<?php echo $annuncio["id_alloggio"]; ?>">
                                                <i class="bi <?php echo $isFav ? 'bi-heart-fill' : 'bi-heart'; ?> fs-4"></i>
                                            </button>
                                        <?php endif; ?>
        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php if(isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] != 'admin'): ?>
    <div class="text-left mt-4">
        <a class="btn btn-warning fw-semibold py-2 px-4 rounded-3 shadow-sm" href="segnalazione.php?tipo=utente&id=<?php echo $u["id_utente"]; ?>" role="button">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Segnala Utente
        </a>
    </div>
<?php endif; ?>

<script>
    //contatore per ogni carousel
    document.querySelectorAll('.carousel').forEach(carousel => {
        const currentSpan = carousel.querySelector('.current-slide');
        carousel.addEventListener('slid.bs.carousel', function (event) {
            if (currentSpan) {
                currentSpan.textContent = event.to + 1;
            }
        });
    });
</script>