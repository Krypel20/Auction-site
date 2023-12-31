// Funkcja do aktualizacji licznika
function updateCountdownTimers(endDates) {
    const timers = document.querySelectorAll('.timer');

    timers.forEach((timer, index) => {
        const endTime = new Date(endDates[index]).getTime();
        const now = new Date().getTime();
        const timeDifference = endTime - now;

        if (endTime >= now) {
            // Obliczanie pozostałego czasu
            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDifference / (1000 * 60 * 60)) % 24);
            const minutes = Math.floor((timeDifference / (1000 * 60)) % 60);
            const seconds = Math.floor((timeDifference / 1000) % 60);

            // Tworzenie łańcucha z wyświetlanym czasem
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

            // Aktualizacja zawartości elementu .timer
            timer.innerHTML = displayRemainingTime;
        } else {
            timer.innerHTML = `-`;
        }
    });
}
