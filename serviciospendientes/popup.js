var btnsAbrirPopup = document.querySelectorAll(".btn-abrir-popup"),
    overlay = document.querySelector(".overlay"),
    btnCerrarPopup = document.getElementById("btn-cerrar-popup"),
    popup = document.getElementById("popup");

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

