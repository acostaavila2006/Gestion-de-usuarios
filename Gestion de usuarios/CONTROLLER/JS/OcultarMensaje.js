// Script para ocultar el mensaje después de 3 segundos

    setTimeout(() => {
        let msg = document.getElementById("mensaje");
        if (msg) {
            msg.style.transition = "opacity 1s ease";
            msg.style.opacity = "0";
            setTimeout(() => msg.remove(), 1000); // lo elimina del DOM después de desvanecerse
        }
    }, 3000);
