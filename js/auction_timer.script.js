// Funkcja do aktualizacji licznika
function updateCountdownTimers(endDate) {
    const timer = document.querySelectorAll('.timer');
    const endTime = new Date(endDate).getTime();
    const now = new Date().getTime();
    const timeDifference = endTime - now;

    if (endTime >= now) {
        // Obliczanie pozostałego czasu
        const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeDifference / (1000 * 60 * 60)) % 24);
        const minutes = Math.floor((timeDifference / (1000 * 60)) % 60);
        const seconds = Math.floor((timeDifference / 1000) % 60);

        // Aktualizacja zawartości elementu .timer
        timer.forEach((timer) => {
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
        timer.innerHTML = `-`;
    }
}
