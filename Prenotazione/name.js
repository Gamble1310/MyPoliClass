// Funzione per ottenere il valore del parametro "class" dalla URL
function getClassNameFromURL() {
    const params = new URLSearchParams(window.location.search);
    return params.get("class") || "N/A"; // Restituisce "N/A" se il parametro non è presente
}

// Aggiorna il testo della prenotazione con il nome dell'aula
function updateClassName() {
    const className = getClassNameFromURL();
    document.getElementById("class-name").textContent = className;
}

// Esegue la funzione al caricamento della pagina
window.onload = updateClassName;