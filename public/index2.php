<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Coming Soon</title>
</head>

<style>
    :root {
        --main-color: #0b121f;
        --second-color: #1f2833;
        --third-color: #B04F08;
        --third-colorHover: #814215;
        --white-color: #fff
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        height: 100%;
    }

    hr{
        opacity: 1;
    }

    body {
        font-size: 1rem;
        line-height: 1.65;
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .uc__wrapper {
        background: var(--main-color);
    }

    .uc__details, .uc__art {
        flex-basis: 50%;
    }

    .uc__art {
        background: url('uploads/images/background.jpg') no-repeat;
        background-size: cover;
    }

    .uc__art::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: inherit;
        filter: brightness(0.7);
    }

    .uc__art .timer,
    .uc__art .countdown-text {
        color: var(--white-color);
        z-index: 1;
    }

    .logo {
        max-width: 200px;
        margin-bottom: 1rem;
    }

    .separator {
        border: 1.5px solid var(--third-color);
    }

    .description {
        font-size: 18px;
        color: var(--white-color) !important;
        max-width: 600px;
    }

    .uc__buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .button-primary, .button-secondary {
        padding: 0.75em 2em;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .button-primary {
        background-color: var(--third-color);
        color: #fff;
        z-index: 1;
    }

    .button-primary:hover {
        background-color: var(--third-colorHover);
    }

    .button-secondary {
        background-color: transparent;
        color: #fff;
    }

    .button-secondary:hover {
        background-color: #fff;
        color: var(--main-color);
    }

    .timer {
        font-size: 4rem;
        color : var(--white-color);
    }

    .countdown-text {
        font-size: 1.7rem;
        text-align: center;
        color: var(--white-color);
    }

    .spanColor {
        color: var(--third-color);
    }

    form{
        z-index: 1;
        width: 500px;
    }

    form .form-control {
        padding: 1em 3em 1em 1.5em;
        border: 2px solid var(--third-color);
        color: var(--white-color) !important;
        background-color: rgba(31, 40, 51, 0.5);
        margin-bottom: 1em;
    }

    form .btn-primary {
        background-color: var(--third-color);
        border-color: var(--third-color);
        padding: 0.5em 1em;
        color: var(--white-color);
        height: 48px;
        margin-top: 6px;
        margin-right: 5px !important;
    }

    form .form-control::placeholder {
        color: var(--white-color);
        opacity: 1;
    }

    form .btn-primary:hover {
        background-color: var(--third-colorHover) !important;
        border-color: var(--third-colorHover) !important;
    }

    form .form-control:focus {
        background-color: rgba(31, 40, 51, 0.5);
    }

    /* modal */
    .modal-content {
        background-color: var(--white-color);
        color: var(--white-color);
    }

    .modal-header {
        border-bottom: 1px solid var(--third-color);
    }

    .modal-title {
        color: var(--third-color);
    }

    .modal-body {
        color: var(--main-color);
    }

    .modal-body a {
        color: var(--third-color);
    }

    .btn-close {
        filter: invert(0);
        opacity: 1;
    }

</style>
<body>
    <div class="uc__wrapper w-100 mw-1920 h-100 d-flex justify-content-between align-items-center flex-column flex-lg-row flex-md-column">
        <div class="uc__details d-flex flex-column align-items-center justify-content-center text-center p-4 ">
            <img src="uploads/images/logo_vacanows.png" alt="Logo" class="logo">
            <hr class="separator mb-4" width="40">
            <p class="description text-center text-muted mb-4 px-3">Our website is under construction. We'll be here soon with our new awesome site.</p>
            <div class="uc__buttons d-flex">
                <button class="button-primary border-0 fw-600" data-bs-toggle="modal" data-bs-target="#infoModal">More Informations</button>
            </div>
        </div>
        <div class="uc__art d-flex flex-column align-items-center justify-content-center text-center p-4 position-relative w-100 h-100">
            <div class="timer text-center fw-bold mb-4" id="timer"></div>
            <p class="countdown-text mb-4">Before the <span class="spanColor fw-bold">Grand opening</span></p>
            <form class="max-width position-relative" id="emailForm">
                <div class="position-relative d-flex align-items-center">
                    <input type="email" id="email" class="form-control rounded-pill" placeholder="Enter your email" aria-label="Email" required>
                    <button class="btn btn-primary rounded-pill position-absolute top-0 end-0 mx-1" type="submit">Sign Up</button>
                </div>
            </form>
            <div id="successMessage" class="text-white mt-3" style="display: none;">The email has been successfully registered.</div>
        </div>
    </div>

    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">More Informations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    For more information, please contact us at <a href="mailto:vacanows@mail.com">vacanows@gmail.com</a>.
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const timerElement = document.getElementById('timer');
            const countdownDate = new Date("December 30, 2024 23:59:59").getTime();

            const updateCountdown = () => {
                const now = new Date().getTime();
                const distance = countdownDate - now;

                if (distance < 0) {
                    timerElement.innerHTML = "EXPIRED";
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                timerElement.innerHTML = `${days}jours ${hours}h ${minutes}m ${seconds}s`;
            };

            setInterval(updateCountdown, 1000);

            const form = document.getElementById('emailForm');
            const successMessage = document.getElementById('successMessage');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                successMessage.style.display = 'block';
                successMessage.style.color = '#E76F51';
                successMessage.style.setProperty('color', '#E76F51', 'important');
                successMessage.style.fontWeight = 'bold';
                successMessage.style.zIndex = '1';
                form.reset();
            });
        });
    </script>
</body>
</html>
