var btnsAbrirPopup = document.querySelectorAll(".btn-añadir-auto"),
    overlay = document.querySelector(".overlay"),
    btnCerrarPopup = document.getElementById("btn-cerrar-popup"),
    popup = document.getElementById("popup");

// Popup para agregar servicio
btnsAbrirPopup.forEach(function(btn) {
    btn.addEventListener("click", function() {
        overlay.classList.add("active");
        popup.classList.add("active");
    });
});

btnCerrarPopup.addEventListener("click", function() {
    overlay.classList.remove("active");
    popup.classList.remove("active");
});

// Popup para agregar etapa
var btnsAbrirPopupEtapa = document.querySelectorAll(".btn-agregar-etapa"),
    overlayEtapa = document.getElementById("overlay-etapa"),
    btnCerrarPopupEtapa = document.getElementById("btn-cerrar-popup-etapa"),
    popupEtapa = document.getElementById("popup-etapa");

btnsAbrirPopupEtapa.forEach(function(btn) {
    btn.addEventListener("click", function() {
        var idServicio = btn.getAttribute("data-id");
        document.getElementById("id_servicio_etapa").value = idServicio;
        overlayEtapa.classList.add("active");
        popupEtapa.classList.add("active");
    });
});

btnCerrarPopupEtapa.addEventListener("click", function() {
    overlayEtapa.classList.remove("active");
    popupEtapa.classList.remove("active");
});

// Popup para agregar insumo
var btnsAbrirPopupInsumo = document.querySelectorAll(".btn-agregar-insumo"),
    overlayInsumo = document.getElementById("overlay-insumo"),
    btnCerrarPopupInsumo = document.getElementById("btn-cerrar-popup-insumo"),
    popupInsumo = document.getElementById("popup-insumo");

btnsAbrirPopupInsumo.forEach(function(btn) {
    btn.addEventListener("click", function() {
        var idServicio = btn.getAttribute("data-id");
        document.getElementById("id_servicio_insumo").value = idServicio;
        overlayInsumo.classList.add("active");
        popupInsumo.classList.add("active");
    });
});

btnCerrarPopupInsumo.addEventListener("click", function() {
    overlayInsumo.classList.remove("active");
    popupInsumo.classList.remove("active");
});
