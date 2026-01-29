document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById('modalPrenotazione');

    if (modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const idAlloggio = button.getAttribute('data-id');

            console.log("Apertura modal per alloggio ID:", idAlloggio); // DEBUG

            const select = modal.querySelector('#stanzaSelect');
            const btnConfirm = modal.querySelector('#btn-conferma-prenota');
            const hiddenInput = modal.querySelector('#modal-id-alloggio');

            hiddenInput.value = idAlloggio;
            select.innerHTML = '<option value="">Caricamento stanze...</option>';
            btnConfirm.disabled = true;

            // Chiamata all'API
            fetch(`api-stanze.php?id=${idAlloggio}`)
                .then(response => {
                    if (!response.ok) throw new Error('Errore di rete');
                    return response.json();
                })
                .then(stanze => {
                    console.log("Stanze ricevute:", stanze); // DEBUG

                    select.innerHTML = '';
                    if (stanze.length > 0) {
                        stanze.forEach((s, index) => {
                            const opt = document.createElement('option');
                            opt.value = s.id_stanza;
                            opt.textContent = `Stanza ${index + 1}: ${s.metratura_stanza}mq - €${s.prezzo_stanza}`;
                            select.appendChild(opt);
                        });
                        btnConfirm.disabled = false;
                    } else {
                        select.innerHTML = '<option value="">Nessuna stanza disponibile</option>';
                    }
                })
                .catch(err => {
                    console.error("Errore Fetch:", err); // DEBUG
                    select.innerHTML = '<option value="">Errore nel caricamento</option>';
                });
        });
    }
});