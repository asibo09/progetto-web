document.addEventListener("DOMContentLoaded", function () {
    const heartButtons = document.querySelectorAll('.btn-cuore');

    heartButtons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation(); // Evita che il click apra l'annuncio

            const alloggioId = this.getAttribute('data-id');
            const pulsante = this;

            const formData = new FormData();
            formData.append('id_alloggio', alloggioId); // Cambiato da id_stanza a id_alloggio

            fetch('api-preferiti.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json()) // Ci aspettiamo un JSON dal server
                .then(data => {
                    if (data.stato === "aggiunto") {
                        pulsante.classList.add('active');
                    } else if (data.stato === "rimosso") {
                        pulsante.classList.remove('active');
                    }
                })
                .catch(error => console.error("Errore:", error));
        });
    });
});