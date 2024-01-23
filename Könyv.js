
        // Ellenőrizzük, hogy a felhasználó regisztrált-e
        // Itt általában a valós autentikáció ellenőrzése lenne
 
        // Ha a felhasználó regisztrált, akkor jelenítse meg a véleményeket
        const isUserLoggedIn = false; // Itt általában a valós autentikáció ellenőrzése lenne

        if (isUserLoggedIn) {
            document.querySelector('.review-section p.hidden').classList.remove('hidden');
        } else {
            document.getElementById('notification-container').style.display = 'block';
        }

        function closeNotification() {
            document.getElementById('notification-container').style.display = 'none';
        }
 