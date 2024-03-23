console.log('sendMail.js loaded...')

$("#submitContactForm").click(function(e) {
    e.preventDefault();

    // Récupération des valeurs des champs
    const name = $("#contactName").val().trim();
    const email = $("#contactEmail").val().trim();
    const subject = $("#contactSubject").val().trim();
    const message = $("#contactMessage").val().trim();

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
