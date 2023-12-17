// Funkcja do aktualizacji licznika
function updateCountdownTimers(endDates) {
    console.log('endDates:', endDates); // Dodaj ten log
    const timers = document.querySelectorAll('.timer');
    timers.forEach((timer, index) => {
        const endTime = new Date(endDates[index]).getTime();
        console.log('endTime:', endTime); // Dodaj ten log

        const now = new Date().getTime();
        const timeDifference = endTime - now;
        console.log('timeDifference:', timeDifference); // Dodaj ten log

        if (endTime >= now) {
            // Obliczanie pozostałego czasu
            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            // Aktualizacja zawartości elementu .timer
            timer.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        } else {
            timer.innerHTML = `-`;
        }
    });
}


