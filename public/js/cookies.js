document.addEventListener('DOMContentLoaded', function() {
    var acceptCookiesBtn = document.getElementById('acceptCookiesBtn');
    var rejectCookiesBtn = document.getElementById('rejectCookiesBtn');
    var cookieLink = document.getElementById('cookie-link');

    acceptCookiesBtn.addEventListener('click', function() {
        setCookie('cookieConsent', 'accepted', 365); // Durée de vie d'un an
        hidePopup();
    });

    rejectCookiesBtn.addEventListener('click', function() {
        setCookie('cookieConsent', 'rejected', 7); // Durée de vie d'une semaine
        hidePopup();
    });

    cookieLink.addEventListener('click', function() {
        var cookieConsent = getCookie('cookieConsent');
        if (!cookieConsent) {
            showPopup();
        }
    });

    // Vérifier si le cookie a déjà été accepté ou rejeté
    var cookieConsent = getCookie('cookieConsent');
    if (!cookieConsent) {
        showPopup(); // Afficher le popup si le cookie n'existe pas
    } else if (cookieConsent && (cookieConsent === 'accepted' || cookieConsent === 'rejected')) {
        hidePopup(); // Masquer le popup si le cookie a déjà été accepté ou rejeté
    }

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        if (match) return match[2];
    }

    function hidePopup() {
        var cookieConsentPopup = document.getElementById('cookieConsentPopup');
        cookieConsentPopup.classList.remove('show'); // Supprime la classe pour masquer le popup
    }

    function showPopup() {
        var cookieConsentPopup = document.getElementById('cookieConsentPopup');
        cookieConsentPopup.classList.add('show'); // Ajoute la classe pour afficher le popup
    }
});
