var btnsAbrirPopup = document.querySelectorAll(".btn-añadir-insumo"),
    overlay = document.querySelector(".overlay"),
    btnCerrarPopup = document.getElementById("btn-cerrar-popup"),
    popup = document.getElementById("popup");
var btnsEditar = document.querySelectorAll(".btn-editar");
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

btnsEditar.forEach(function(btn) {
    btn.addEventListener("click", function(e) {
        e.preventDefault();
        overlay.classList.add("active");
        popup.classList.add("active");
        // Autocompletar campos
        document.getElementById("nombre").value = btn.getAttribute("data-nombre") || "";
        document.getElementById("tipo").value = btn.getAttribute("data-tipo") || "";
        document.getElementById("cantidad").value = btn.getAttribute("data-cantidad") || "";
        document.getElementById("precio").value = btn.getAttribute("data-precio") || "";
    });
});
