document.addEventListener('DOMContentLoaded', function() {
    // Selezioniamo solo le card degli alloggi
    const cards = document.querySelectorAll('.card-alloggio');

    cards.forEach(card => {
        card.addEventListener('click', function() {
            const idAlloggio = this.getAttribute('data-id');
            
            // Verifichiamo che l'ID esista prima di inviare
            if (idAlloggio) {
                const formData = new FormData();
                formData.append('id_alloggio', idAlloggio);
                
                // navigator.sendBeacon garantisce l'invio anche se cambiamo pagina [cite: 84]
                navigator.sendBeacon('salva-ricerca.php', formData);
            }
        });
    });
});