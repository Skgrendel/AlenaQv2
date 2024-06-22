//Mostrar Contenido Predio
document.addEventListener("DOMContentLoaded", (event) => {
    const anomaliasi = document.getElementById("anomaliasi");
    const prediosi = document.getElementById("prediosi");
    const prediono = document.getElementById("prediono");
    const anomaliano = document.getElementById("anomaliano");
    const medidorsi = document.getElementById("medidorsi");
    const medidorcsi = document.getElementById("medidorcsi");
    const medidorno = document.getElementById("medidorno");
    const medidorcno = document.getElementById("medidorcno");
    const infoDiv = document.getElementById("info");
    const nombre_comercio = document.getElementById("nombre_comercio");
    const contmedidor = document.getElementById("cont-medidor")
    const Anomalia = document.getElementById("anomalia");
    const Comercio = document.getElementById("comercio");
    const medidor_anomalia = document.getElementById("medidor_anomalia");
    const medidor_anomalia_container = document.getElementById("medidor_anomalia_container");
    const imposibilidad = document.getElementById("imposibilidad");
    const anomaliaContainer = document.getElementById("anomaliaContainer");
    const lectura = document.getElementById("lectura");

    // Función para actualizar el estado del checkbox
    const updateState = () => {

        if (prediosi.checked) {
            infoDiv.classList.remove("d-none"); // Show the div
            medidor_anomalia.disabled = false;
            nombre_comercio.value = ""
            Comercio.value = "";
        }
        if (anomaliasi.checked) {
            anomaliaContainer.classList.remove("d-none"); // Show the div
            Anomalia.value = "";
        }

        if (anomaliano.checked) {
            anomaliaContainer.classList.add("d-none"); // Show the div
            Anomalia.value = 8;
        }

        if (medidorsi.checked) {
            contmedidor.classList.remove("d-none"); // Show the div
        }

        if (medidorno.checked) {
            contmedidor.classList.add("d-none"); // Show the div
            medidor_anomalia.disabled = true;
            lectura.value = 0;
            Anomalia.value = 67;
            imposibilidad.value = 60;
        }
        if (medidorcsi.checked) {
            medidor_anomalia_container.classList.add("d-none"); // Show the div
            medidor_anomalia.disabled = true;
        }

        if (medidorcno.checked) {
            medidor_anomalia_container.classList.remove("d-none"); // Show the div
            medidor_anomalia.disabled = false;
            
        }

        if (prediono.checked) {
            infoDiv.classList.add("d-none"); // Hide the div
            medidor_anomalia.disabled = true;
            nombre_comercio.value = "Comercio No encontrado"
            Anomalia.value = 67;
            Comercio.value = 70;
            imposibilidad.value = 60;
            lectura.value = 0;
        }


    };

    // Add event listeners to radio buttons
    prediosi.addEventListener("change", updateState);
    medidorsi.addEventListener("change", updateState);
    medidorcsi.addEventListener("change", updateState);
    anomaliasi.addEventListener("change", updateState);
    prediono.addEventListener("change", updateState);
    medidorno.addEventListener("change", updateState);
    medidorcno.addEventListener("change", updateState);
    anomaliano.addEventListener("change", updateState);

    // Initialize the state on page load
    updateState();
});


document.addEventListener("DOMContentLoaded", (event) => {

const switchEvidencia = document.getElementById("switch-evidencias");
const contEvidencia = document.getElementById("evidencias");

switchEvidencia.addEventListener("change", function () {
    if (this.checked) {
        contEvidencia.classList.remove("d-none"); // Show the div
    } else {
        contEvidencia.classList.add("d-none"); // Hide the div
    }
});

});
