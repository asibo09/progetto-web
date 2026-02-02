<?php 
    $a = $templateParams["annuncio"];
    $foto = $templateParams["foto"];
    $copertina = count($foto) > 0 ? $foto[0]["percorso_immagine"] : "upload/default.png";
?>

<nav id="nav-annuncio" class="navbar navbar-light bg-white border-bottom sticky-top shadow-sm mb-5 py-2">
    <div class="container-xl">
        <div class="d-flex align-items-center w-100 flex-wrap">
            <a href="annuncio.php?id=<?php echo $a['id_alloggio']; ?>" class="link-indietro text-decoration-none text-info fw-bold me-4 text-uppercase">
                <em class="bi bi-chevron-left"></em> Indietro
            </a>
            <div class="d-flex align-items-center border-end pe-3 me-3 price-container">
                <img src="<?php echo $copertina; ?>" class="rounded-2 me-2" style="width: 45px; height: 45px; object-fit: cover;" alt="Thumbnail">
                <div class="fw-bold text-nowrap fs-5">€ <?php echo (int)$a["prezzo_mensile_alloggio"]; ?></div>
            </div>
        </div>
    </div>
</nav>


<div class="container-xl pb-5 mb-5">
    <div class="row g-3 row-cols-2">
        <?php foreach($foto as $idx => $f): ?>
        <div class="col">
            <div class="rounded-3 overflow-hidden shadow-sm bg-white border">
                <img src="upload/<?php echo $f['percorso_immagine']; ?>" class="w-100 img-gallery-full" style="cursor: pointer; object-fit: cover; height: 250px;"
                    alt="Foto <?php echo $idx + 1; ?> dell'alloggio in <?php echo htmlspecialchars($templateParams['annuncio']['indirizzo']); ?>"
                    onclick="apriFoto(this.src)">
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<div class="modal fade" id="fotoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-galleria">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 d-flex justify-content-center align-items-center position-relative">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" id="modalImg" class="rounded-3 shadow-lg img-fluid" alt="Zoom della foto selezionata">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

<script>
    function apriFoto(src) {
        const modalImage = document.getElementById('modalImg');
        modalImage.src = src;
        const myModal = new bootstrap.Modal(document.getElementById('fotoModal'));
        myModal.show();
    }
</script>