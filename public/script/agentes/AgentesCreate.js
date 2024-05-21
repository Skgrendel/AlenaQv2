//Mostrar Contenido Predio
document.addEventListener("DOMContentLoaded", (event) => {
    const switchpredio = document.getElementById("switch-predio");
    const infoDiv = document.getElementById("info");
    const hiddenAnomalia = document.getElementById("hidden-anomalia");
    const hiddenComercio = document.getElementById("hidden-comercio");
    const nueva_opcion = document.getElementById("nueva_opcion");
    const medidor_anomalia = document.getElementById("medidor_anomalia");
    const lectura = document.getElementById("lectura");
    const hiddenimposibilidad = document.getElementById("hidden-imposibilidad");

    // Función para actualizar el estado del checkbox

    function updateState() {
        if (switchpredio.checked) {
            infoDiv.classList.remove("d-none"); // Show the div
            hiddenAnomalia.disabled = true;
            hiddenComercio.disabled = true;
        } else {
            infoDiv.classList.add("d-none"); // Hide the div
            hiddenAnomalia.disabled = false;
            hiddenComercio.disabled = false;
            nueva_opcion.disabled = true;
            medidor_anomalia.disabled = true;
            lectura.value = 0;
            hiddenimposibilidad.disabled = false;
            hiddenimposibilidad.value = 63;
        }
    }
    // Añadir evento change al checkbox
    switchpredio.addEventListener("change", updateState);
    // Inicializar el estado al cargar la página
    updateState();
});

//Mostrar Contenido Medidor

const switchMedidor = document.getElementById("switch-medidor");
const contmedidor = document.getElementById("cont-medidor");

switchMedidor.addEventListener("change", function () {
    if (this.checked) {
        contmedidor.classList.remove("d-none"); // Show the div
    } else {
        contmedidor.classList.add("d-none"); // Hide the div
    }
});

// Medidor Anomalia Coincide

const switchMedidorAnomalia = document.getElementById("switch-coincide");
const contmedidorAnomalia = document.getElementById("medidor_anomalia_container");
const medidor_anomalia = document.getElementById("medidor_anomalia");

switchMedidorAnomalia.addEventListener("change", function () {
    if (this.checked) {

        contmedidorAnomalia.classList.remove("d-none"); // Show the div
        medidor_anomalia.disabled = false;
    } else {
        contmedidorAnomalia.classList.add("d-none"); // Hide the div
        medidor_anomalia.disabled = true;
    }
});

//Anomalia Detectada

const switchAnomalia = document.getElementById("switch-anomalia");
const contAnomalia = document.getElementById("anomaliaContainer");

switchAnomalia.addEventListener("change", function () {
    if (this.checked) {
        contAnomalia.classList.remove("d-none"); // Show the div
    } else {
        contAnomalia.classList.add("d-none"); // Hide the div
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    //Lectura
    const switchLectura = document.getElementById("switch-lectura");
    const contLectura = document.getElementById("lectura_container");
    const contimposibilidad = document.getElementById("container_imposibilidad");
    const hiddenimposibilidad = document.getElementById("hidden-imposibilidad");

    // Función para actualizar el estado del checkbox

    function updateStateLectura() {
        if (switchLectura.checked) {
            contLectura.classList.remove("d-none"); // Show the div
            contimposibilidad.classList.add("d-none");
            hiddenimposibilidad.disabled = false;
            hiddenimposibilidad.value = 58;

        } else {
            contLectura.classList.add("d-none"); // Hide the div
            contimposibilidad.classList.remove("d-none"); // Hide the div
        }
    }
    switchLectura.addEventListener("change", updateStateLectura);
    // Añadir evento change al checkbox
    updateStateLectura();
});

//Evidencia
const switchEvidencia = document.getElementById("switch-evidencias");
const contEvidencia = document.getElementById("evidencias");

switchEvidencia.addEventListener("change", function () {
    if (this.checked) {
        contEvidencia.classList.remove("d-none"); // Show the div
    } else {
        contEvidencia.classList.add("d-none"); // Hide the div
    }
});
