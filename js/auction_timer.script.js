// Funkcja do aktualizacji licznika
function updateCountdownTimers(endDate) {
    const timers = document.querySelectorAll('.timer');
    const endTime = new Date(endDate).getTime();
    const now = new Date().getTime();
    const timeDifference = endTime - now;

    if (endTime >= now) {
        // Obliczanie pozostałego czasu
        const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

        // Aktualizacja zawartości elementu .timer
        timers.forEach((timer) => {
            // Sprawdź warunki dla dni, godzin, minut i sekund
            let displayRemainingTime = "Pozostało ";
        
            if (days > 0) {
                displayRemainingTime += `${days}d `;
            }
        
            if (hours > 0 || days > 0) {
                displayRemainingTime += `${hours}h `;
            }
        
            if (minutes > 0 || hours > 0 || days > 0) {
                displayRemainingTime += `${minutes}m `;
            }
        
            displayRemainingTime += `${seconds}s`;
        
            timer.innerHTML = displayRemainingTime;
        });
    } else {
        timers.forEach((timer) => {
            timer.innerHTML = `-`;
        });
    }
}
