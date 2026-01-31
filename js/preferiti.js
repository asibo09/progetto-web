document.addEventListener("DOMContentLoaded", function () {
    const heartButtons = document.querySelectorAll('.btn-cuore');

    heartButtons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const alloggioId = this.getAttribute('data-id');
            const pulsante = this;
            const icona = pulsante.querySelector('i'); // Recuperiamo l'icona interna

            const formData = new FormData();
            formData.append('id_alloggio', alloggioId);

            fetch('api-preferiti.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.stato === "aggiunto") {
                    pulsante.classList.add('active');
                    // Cambia l'icona in "piena"
                    icona.classList.remove('bi-heart');
                    icona.classList.add('bi-heart-fill');
                } else if (data.stato === "rimosso") {
                    pulsante.classList.remove('active');
                    // Cambia l'icona in "vuota"
                    icona.classList.remove('bi-heart-fill');
                    icona.classList.add('bi-heart');
                }
            })
            .catch(error => console.error("Errore:", error));
        });
    });
});