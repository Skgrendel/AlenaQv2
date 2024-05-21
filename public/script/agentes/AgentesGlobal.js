//Mostrar Opcion para agregar nuevo Comercio
document.getElementById("comercio").addEventListener("change", function() {
    var divComercioNuevo = document.getElementById("div-comercio-nuevo");
    if (this.options[this.selectedIndex].textContent === "Otros") {
        divComercioNuevo.style.display = "block";
    } else {
        divComercioNuevo.style.display = "none";
    }
});

// Mostrar Validacion de Subida de Archivos

document.addEventListener("DOMContentLoaded", function() {
    for (let i = 1; i <= 6; i++) {
        document.getElementById(`foto${i}-button`).addEventListener("click", function() {
            document.getElementById(`foto${i}-input`).click();
        });

        document.getElementById(`foto${i}-input`).addEventListener("change", function() {
            var button = document.getElementById(`foto${i}-button`);
            if (this.files && this.files.length > 0) {
                document.querySelector(`#foto${i}-button .btn-text-inner`).textContent =
                    "Archivo seleccionado";
                button.classList.remove("btn-info");
                button.classList.add("btn-success");
            } else {
                document.querySelector(`#foto${i}-button .btn-text-inner`).textContent =
                    "Foto Inmueble";
                button.classList.remove("btn-success");
                button.classList.add("btn-info");
            }
        });
    }
});

// Mostrar la barra de Procesos

$(document).ready(function() {
    $('#reporte').submit(function() {
        $('#submitButtonReporte').addClass('d-none');
        $('#progressBarReporte').removeClass('d-none');
    });
});

// Cambio de Estilo en el Seletor de Anomalias

document.addEventListener("DOMContentLoaded", function(event) {
    new TomSelect("#anomalia", {
        persist: false,
        createOnBlur: true,
    });
});

//Obtener La ubicacion Actual del Lector

function obtenerUbicacion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            // Obtener latitud y longitud
            var latitud = position.coords.latitude;
            var longitud = position.coords.longitude;

            // Colocar latitud y longitud en los elementos de entrada
            document.getElementById('latitud').value = latitud;
            document.getElementById('longitud').value = longitud;
        }, function(error) {
            // Manejar los errores
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("El usuario no permitió la solicitud de geolocalización.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("La información de ubicación no está disponible.");
                    break;
                case error.TIMEOUT:
                    alert("La solicitud para obtener la ubicación del usuario ha expirado.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Ha ocurrido un error desconocido.");
                    break;
            }
        });
    } else {
        alert("Geolocalización no es soportada por este navegador.");
    }
}

// Llamar a la función para obtener la ubicación al cargar la página
window.onload = obtenerUbicacion;

