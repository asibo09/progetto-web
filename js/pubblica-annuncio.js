let currentStep = 0;
const steps = ["tipologia", "localita", "caratteristiche", "convivenza", "prezzi", "descrizione", "foto", "contatti"];

function showSection(id) {
    document.querySelectorAll('.form-section').forEach(s => s.classList.add('d-none'));
    document.querySelectorAll('#step-menu .list-group-item').forEach(b => b.classList.remove('active'));
    const target = document.getElementById('sec-' + id);
    const btn = document.getElementById('btn-' + id);
    if (target && btn) {
        target.classList.remove('d-none');
        btn.classList.add('active');
        currentStep = steps.indexOf(id);
        updateNavButtons();
    }
}

function nextPrev(n) {
    let next = currentStep + n;
    if (next >= 0 && next < steps.length) showSection(steps[next]);
}

function updateNavButtons() {
    document.getElementById('prevBtn').classList.toggle('d-none', currentStep === 0);
    document.getElementById('nextBtn').classList.toggle('d-none', currentStep === steps.length - 1);
}

function toggleSiNo(id) {
    let el = document.getElementById(id);
    if (el) el.value = (el.value === "Sì") ? "No" : "Sì";
    validateSidebar();
}

function toggleStrings(id, s1, s2) {
    let el = document.getElementById(id);
    if (el) el.value = (el.value === s1) ? s2 : s1;
    validateSidebar();
}

function changeVal(id, delta) {
    let el = document.getElementById(id);
    if (!el) return;

    //parseFloat per supportare decimali 
    let currentVal = parseFloat(el.value) || 0;
    let newVal = currentVal + delta;

    if (newVal >= 0) {
        // se delta è un decimale, usiamo toFixed per arrotondare ad un decimale; altrimenti lo trattiamo come intero
        el.value = (delta % 1 !== 0) ? newVal.toFixed(1) : newVal;

        //se stanze rigenera blocchi stanze
        if (id === 'stanze') {
            generaBlocchiStanze();
        }

        //se nr coinquilino rigenere i suoi campi genere e occupazione
        if (id === 'current-coinq') {
            updateRequiredFields(newVal);
        }
    }
    
    validateSidebar();
}

function generaBlocchiStanze() {
    const container = document.getElementById('stanze-dinamiche-container');
    const inputStanze = document.getElementById('stanze'); // CORRETTO: era stanze_input
    if (!container || !inputStanze) return;

    const numeroStanze = parseInt(inputStanze.value) || 1;
    let htmlStanze = "";

    for (let i = 1; i <= numeroStanze; i++) {
        htmlStanze += `
            <div class="stanza-block ${i < numeroStanze ? 'mb-5' : ''}">
                <h2 class="h4 fw-bold mb-4">Caratteristiche Stanza numero ${i}</h2>
                <div class="row g-4">
                    <div class="col-6">
                        <label for="mq-${i}" class="form-label small fw-semibold">Superficie stanza (mq) *</label>
                        <input type="number" id="mq-${i}" name="mq-${i}" class="form-control" placeholder="Es. 18" required>
                    </div>
                    <div class="col-6">
                        <label for="prezzo-${i}" class="form-label small fw-semibold">Prezzo per stanza (€) *</label>
                        <input type="number" id="prezzo-${i}" name="prezzo-${i}" class="form-control" placeholder="Es. 400" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label small fw-semibold d-block">Letto Singolo</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" onclick="changeVal('letto-s-${i}', -1)">-</button>
                            <input type="number" id="letto-s-${i}" name="letto-s-${i}" class="form-control text-center fw-bold" value="1">
                            <button class="btn btn-outline-secondary" type="button" onclick="changeVal('letto-s-${i}', 1)">+</button>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label small fw-semibold d-block">Letto Matrimoniale</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" onclick="changeVal('letto-m-${i}', -1)">-</button>
                            <input type="number" id="letto-m-${i}" name="letto-m-${i}" class="form-control text-center fw-bold" value="0">
                            <button class="btn btn-outline-secondary" type="button" onclick="changeVal('letto-m-${i}', 1)">+</button>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label small fw-semibold d-block">Bagno</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" onclick="toggleStrings('bagno-${i}', 'Condiviso', 'Privato')">-</button>
                            <input type="text" id="bagno-${i}" name="bagno-${i}" class="form-control text-center bg-white fw-bold" value="Privato" readonly>
                            <button class="btn btn-outline-secondary" type="button" onclick="toggleStrings('bagno-${i}', 'Condiviso', 'Privato')">+</button>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label small fw-semibold d-block">Balcone</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" onclick="toggleSiNo('balcone-${i}')">-</button>
                            <input type="text" id="balcone-${i}" name="balcone-${i}" class="form-control text-center bg-white fw-bold" value="No" readonly>
                            <button class="btn btn-outline-secondary" type="button" onclick="toggleSiNo('balcone-${i}')">+</button>
                        </div>
                    </div>
                </div>
            </div>
            ${i < numeroStanze ? '<hr class="my-5 opacity-25">' : ''}
        `;
    }
    container.innerHTML = htmlStanze;
    validateSidebar();
}

function handleFiles(input) {
    const container = document.getElementById('preview-container');
    const files = input.files;

    for (let i = 0; i < files.length; i++) {
        if (document.querySelectorAll('.preview-item').length >= 20) {
            alert("Puoi caricare al massimo 20 foto");
            break;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            const div = document.createElement('div');
            div.className = 'col-4 col-md-3 preview-item position-relative';
            div.innerHTML = `
                <div class="ratio ratio-1x1 rounded-3 overflow-hidden border shadow-sm">
                    <img src="${e.target.result}" class="img-fit w-100 h-100" alt="Anteprima" style="object-fit: cover;">
                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 p-0 d-flex align-items-center justify-content-center rounded-circle" 
                            style="width:22px; height:22px;" onclick="removePhoto(this)">
                        <i class="bi bi-x fs-6"></i>
                    </button>
                </div>
            `;
            container.appendChild(div);
            updateFotoCount();
            validateSidebar();
        }
        reader.readAsDataURL(files[i]);
    }
    
}

function removePhoto(btn) {
    btn.closest('.preview-item').remove();
    updateFotoCount();
    validateSidebar();
}

function updateFotoCount() {
    const count = document.querySelectorAll('.preview-item').length;
    const counterEl = document.getElementById('foto-count');
    if (counterEl) counterEl.innerText = count;
}

function validateSidebar() {
    steps.forEach(id => {
        const section = document.getElementById('sec-' + id);
        const statusSpan = document.getElementById('status-' + id);
        if (!section || !statusSpan) return;

        const fields = section.querySelectorAll('[required]');
        let isComplete = true;
        fields.forEach(f => {
            if (!f.checkValidity() || f.value.trim() === "") isComplete = false;
        });

        //controllo per foto
        if (id === 'foto') {
            isComplete = document.querySelectorAll('.preview-item').length > 0;
        }

        statusSpan.innerHTML = isComplete 
            ? '<i class="bi bi-check-circle-fill text-success"></i>' 
            : '<i class="bi bi-exclamation-circle-fill text-danger"></i>';
    });
}

//funzione per far si che i campi opzionali degli inquilini una volta che si indica che sono presenti diventino obbligatori
function updateRequiredFields(val) {
    const isRequired = parseInt(val) > 0;
    const inputs = document.querySelectorAll('input[name="genere-inq"], input[name="occ-inq"]');
    const starGenere = document.getElementById('star-genere');
    const starOcc = document.getElementById('star-occ');

    inputs.forEach(input => {
        input.required = isRequired;
    });
    if (isRequired) {
        starGenere.classList.remove('d-none');
        starOcc.classList.remove('d-none');
    } else {
        starGenere.classList.add('d-none');
        starOcc.classList.add('d-none');
    }
}

//inizializzazione
document.addEventListener("DOMContentLoaded", () => {
    generaBlocchiStanze();
    const form = document.getElementById('form-annuncio');
    if (form) {
        form.addEventListener('input', validateSidebar);
    }
    validateSidebar();
});

//validazione form
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById('form-annuncio');

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            //blocca invio form
            event.preventDefault();
            event.stopPropagation();

            //primo campo non valido
            const firstInvalid = form.querySelector(':invalid');
            if (firstInvalid) {
                //risale alla sua sezione
                const section = firstInvalid.closest('.form-section');
                if (section) {
                    const sectionId = section.id.replace('sec-', '');
                    showSection(sectionId);
                    setTimeout(() => firstInvalid.focus(), 300);
                }
            }
        }
        form.classList.add('was-validated');
    }, false);
});