document.addEventListener("DOMContentLoaded", function () {
    const heartButtons = document.querySelectorAll('.btn-cuore');

    heartButtons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const alloggioId = this.getAttribute('data-id');
            const pulsante = this;

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
                    } else if (data.stato === "rimosso") {
                        pulsante.classList.remove('active');
                    }
                })
                .catch(error => console.error("Errore:", error));
        });
    });
});