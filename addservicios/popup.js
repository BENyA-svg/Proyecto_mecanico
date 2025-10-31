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

        // Cargar etapas para este servicio
        fetch('get_etapas.php?id_service=' + idServicio)
            .then(response => response.json())
            .then(data => {
                var datalist = document.getElementById("etapas_list");
                datalist.innerHTML = "";
                data.forEach(function(etapa) {
                    var option = document.createElement("option");
                    option.value = etapa.nombre;
                    datalist.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));

        overlayInsumo.classList.add("active");
        popupInsumo.classList.add("active");
    });
});

btnCerrarPopupInsumo.addEventListener("click", function() {
    overlayInsumo.classList.remove("active");
    popupInsumo.classList.remove("active");
});


var btnsExpandir = document.querySelectorAll(".btn-expandir"),
    overlayExpandir = document.getElementById("overlay-expandir"),
    popupExpandir = document.getElementById("popup-expandir"),
    btnCerrarPopupExpandir = document.getElementById("btn-cerrar-popup-expandir");

btnsExpandir.forEach(function(btn) {
    btn.addEventListener("click", function() {
       var idServicio = btn.getAttribute("data-id"); 
        document.getElementById("id_servicio_expandir").value = idServicio;

        // Actualizar título principal del popup
        var popupTitle = popupExpandir.querySelector("h2");
        if(popupTitle) popupTitle.textContent = translations.service_details;

        fetch('get_etapas.php?id_service=' + idServicio)
            .then(response => response.json())
            .then(etapas => {
                var etapasContainer = document.getElementById("etapas-container");
                etapasContainer.innerHTML = "";

                if (etapas.length > 0) {
                    etapas.forEach(function(etapa) {
                        var etapaDiv = document.createElement("div");
                        etapaDiv.className = "etapa";
                        etapaDiv.innerHTML = "<h5>" + etapa.nombre + "</h5>";
                        etapasContainer.appendChild(etapaDiv);
                    });
                    var stagesTitle = document.createElement("h4");
                    stagesTitle.textContent = translations.stages_of_service;
                    etapasContainer.prepend(stagesTitle);
                } else {
                    var noEtapasP = document.createElement("p");
                    noEtapasP.textContent = translations.no_etapas;
                    etapasContainer.innerHTML = '<h4>' + translations.stages_of_service + '</h4>';
                    etapasContainer.appendChild(noEtapasP);
                }
            })
            .catch(error => console.error('Error cargando etapas:', error));

        fetch('get_insumos.php?id_service=' + idServicio)
            .then(response => response.json())
            .then(insumos => {
                var insumosContainer = document.getElementById("insumos-container");
                insumosContainer.innerHTML = "";

                if (insumos.length > 0) {
                    insumos.forEach(function(insumo) {
                        var insumoDiv = document.createElement("div");
                        insumoDiv.className = "insumo";
                        insumoDiv.innerHTML = "<p><strong>" + translations.etapa_label + "</strong> " + insumo.etapa + "</p><p><strong>" + translations.insumo_label + "</strong> " + insumo.insumo + "</p><p><strong>" + translations.cantidad_label + "</strong> " + insumo.cantidad + "</p>";
                        insumosContainer.appendChild(insumoDiv);
                    });
                    var suppliesTitle = document.createElement("h4");
                    suppliesTitle.textContent = translations.supplies_per_stage;
                    insumosContainer.prepend(suppliesTitle);
                } else {
                    var noInsumosP = document.createElement("p");
                    noInsumosP.textContent = translations.no_insumos;
                    insumosContainer.innerHTML = '<h4>' + translations.supplies_per_stage + '</h4>';
                    insumosContainer.appendChild(noInsumosP);
                }
            })
            .catch(error => console.error('Error cargando insumos:', error));

        overlayExpandir.classList.add("active");
        popupExpandir.classList.add("active");
    });
});

btnCerrarPopupExpandir.addEventListener("click", function() {
    overlayExpandir.classList.remove("active");
    popupExpandir.classList.remove("active");
});
