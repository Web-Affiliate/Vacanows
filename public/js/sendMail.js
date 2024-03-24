console.log('sendMail.js loaded...');

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
    const nameInput = document.getElementById("contactName");
    const emailInput = document.getElementById("contactEmail");
    const subjectInput = document.getElementById("contactSubject");
    const messageInput = document.getElementById("contactMessage");
    const messageContainer = document.getElementById("contactMessageContainer");

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        // Récupération des valeurs des champs
        const name = nameInput.value.trim();
        const email = emailInput.value.trim();
        const subject = subjectInput.value.trim();
        const message = messageInput.value.trim();

        if (name === "" || email === "" || subject === "" || message === "") {
            console.error("Veuillez remplir tous les champs du formulaire.");
            return;
        }

        $.ajax({
            type: "POST",
            url: "/sendMail",
            data: {
                name: name,
                email: email,
                subject: subject,
                message: message
            },
            dataType: 'json',
            success: function(response) {
                console.log(response.message);
            },
            error: function(err) {
                // Gestion des erreurs
                console.error("Une erreur s'est produite lors de l'envoi du formulaire:", err);
            }
        });

    });

    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function appendErrorMessage(message) {
        const errorMessage = document.createElement("p");
        errorMessage.classList.add("text-danger");
        errorMessage.textContent = message;
        messageContainer.appendChild(errorMessage);
    }
});
