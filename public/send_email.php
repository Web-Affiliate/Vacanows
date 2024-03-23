<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $to = "vacanows@gmail.com";

    $email_subject = "Nouveau message de contact - $subject";

    $email_body = "Nom: $name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message";

    // Entêtes de l'e-mail
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $email_subject, $email_body, $headers)) {
        http_response_code(200);
        echo "Le message a été envoyé avec succès.";
    } else {
        // Réponse HTTP 500 (Erreur interne du serveur) en cas d'échec de l'envoi de l'e-mail
        http_response_code(500);
        echo "Une erreur s'est produite lors de l'envoi du message.";
    }
} else {
    // Réponse HTTP 405 (Méthode non autorisée) si la méthode de requête n'est pas POST
    http_response_code(405);
    echo "Méthode non autorisée.";
}
?>
