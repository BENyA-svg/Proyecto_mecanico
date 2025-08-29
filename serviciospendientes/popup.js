var btnsAbrirPopup = document.querySelectorAll(".btn-abrir-popup"),
    overlay = document.querySelector(".overlay"),
    btnCerrarPopup = document.getElementById("btn-cerrar-popup"),
    popup = document.getElementById("popup");

var popupVehiculo = document.getElementById("popup-vehiculo"),
    popupTipo = document.getElementById("popup-tipo"),
    popupFecha = document.getElementById("popup-fecha"),
    popupDesc = document.getElementById("popup-desc"),
    popupEstado = document.getElementById("popup-estado");

    btnsAbrirPopup.forEach(function(btn) {
    btn.addEventListener("click", function() {
        popupVehiculo.textContent = "Vehículo: " + btn.dataset.vehiculo;
        popupTipo.textContent = "Tipo de servicio: " + btn.dataset.tipo;
        popupFecha.textContent = "Fecha: " + btn.dataset.fecha;
        popupDesc.textContent = "Descripción: " + btn.dataset.desc;
        popupEstado.textContent = "Estado: " + btn.dataset.estado;
        overlay.classList.add("active");
        popup.classList.add("active");
    });
});


btnCerrarPopup.addEventListener("click", function() {
    overlay.classList.remove("active");
    popup.classList.remove("active");
});