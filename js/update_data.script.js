// Funkcja do pobierania aktualnej ceny za pomocą AJAX
function updateCurrentPrice(auctionId) {
    let currentPrice;
    
    // Wysyłanie zapytania AJAX do serwera
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `includes/get_current_price.inc.php?id=${auctionId}`, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Przypisanie wartości currentPrice z odpowiedzi serwera
            currentPrice = JSON.parse(xhr.responseText).currentPrice;
            // Aktualizacja wartości currentPrice dla danego aukcyjnego elementu
            const currentPriceElement = document.querySelector(`#current_price_${auctionId}`);
            if (currentPriceElement) {
                currentPriceElement.textContent = `Aktualna cena: ${currentPrice} zł`;
            }
        }
    };

    xhr.send();
}