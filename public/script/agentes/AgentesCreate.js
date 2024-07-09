//Mostrar Contenido Predio
document.addEventListener("DOMContentLoaded", (event) => {
    const anomaliasi = document.getElementById("anomaliasi");
    const prediosi = document.getElementById("prediosi");
    const lecturasi = document.getElementById("lecturasi");
    const lecturano = document.getElementById("lecturano");
    const prediono = document.getElementById("prediono");
    const anomaliano = document.getElementById("anomaliano");
    const medidorsi = document.getElementById("medidorsi");
    const medidorcsi = document.getElementById("medidorcsi");
    const medidorno = document.getElementById("medidorno");
    const medidorcno = document.getElementById("medidorcno");
    const infoDiv = document.getElementById("info");
    const nombre_comercio = document.getElementById("nombre_comercio");
    const contmedidor = document.getElementById("cont-medidor")
    const contlectura = document.getElementById("lectura_container")
    const Anomalia = document.getElementById("slcanomalia");
    const Comercio = document.getElementById("slcComercio");
    const medidor_anomalia = document.getElementById("medidor_anomalia");
    const medidor_anomalia_container = document.getElementById("medidor_anomalia_container");
    const imposibilidad = document.getElementById("imposibilidad");
    const anomaliaContainer = document.getElementById("anomaliaContainer");
    const lectura = document.getElementById("lectura");

    // Función para actualizar el estado del checkbox
    const updateState = () => {
        if (prediono.checked) {
            infoDiv.classList.add("d-none");
            medidor_anomalia.disabled = true;
            nombre_comercio.value = "Comercio No encontrado"
            Anomalia.value = 17; // Medidor no encontrado
            Comercio.value = 55; // comercio no enconrado
            imposibilidad.value = 58; //imposibilidad falta de medidor
            lectura.value = 0;
            console.log("entro aca")
        }

        if (prediosi.checked) {
            infoDiv.classList.remove("d-none");
            medidor_anomalia.disabled = false;
            nombre_comercio.value = ""
            Comercio.value = "";
        }

        if (anomaliasi.checked) {
            anomaliaContainer.classList.remove("d-none");
        }

        if (anomaliano.checked) {
            anomaliaContainer.classList.add("d-none");
            Anomalia.value = 8; // Sin anomalias
        }

        if (lecturano.checked) {
            contlectura.classList.add("d-none");
            lectura.value = 0;
        }

        if (lecturasi.checked) {
            contlectura.classList.remove("d-none");
            lectura.value = "";
        }

        if (medidorsi.checked) {
            contmedidor.classList.remove("d-none");
        }

        if (medidorno.checked) {
            contmedidor.classList.add("d-none");
            medidor_anomalia.disabled = true;
            lectura.value = 0;
            Anomalia.value = 17; // Medidor no encontrado
            imposibilidad.value = 58; //imposibilidad falta de medidor
        }

        if (medidorcsi.checked) {
            medidor_anomalia_container.classList.add("d-none");
            medidor_anomalia.disabled = true;
        }

        if (medidorcno.checked) {
            medidor_anomalia_container.classList.remove("d-none");
            medidor_anomalia.disabled = false;

        }

    };

    // Add event listeners to radio buttons
    prediosi.addEventListener("change", updateState);
    medidorsi.addEventListener("change", updateState);
    medidorcsi.addEventListener("change", updateState);
    anomaliasi.addEventListener("change", updateState);
    lecturasi.addEventListener("change", updateState);
    prediono.addEventListener("change", updateState);
    lecturano.addEventListener("change", updateState);
    medidorno.addEventListener("change", updateState);
    medidorcno.addEventListener("change", updateState);
    anomaliano.addEventListener("change", updateState);

    // Initialize the state on page load
    updateState();
});

