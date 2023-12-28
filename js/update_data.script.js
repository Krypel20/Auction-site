// Funkcja do pobierania aktualnej ceny za pomocą AJAX
function updateData(auctionId) {
    let currentPrice;
    let auctioneerName;

    // Wysyłanie zapytania AJAX do serwera
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `includes/get_current_data.inc.php?id=${auctionId}`, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Przypisanie wartości z odpowiedzi serwera
            // console.log('Debug AJAX Response:', xhr.responseText);
            const response = JSON.parse(xhr.responseText);
            currentPrice = response.result.currentPrice;
            auctioneerName = response.auctioneerName;

            // Aktualizacja wartości aktualnej ceny dla danej aukcji
            const currentPriceElement = document.querySelector(`.currentPrice[data-auction-id="${auctionId}"]`);
            if (currentPriceElement) {
                currentPriceElement.textContent = `Aktualna cena: ${currentPrice} zł`;
            }

            // Aktualizacja nazwy uzytkownika licytującego dana aukcje
            const auctioneerNameElement = document.querySelector(`#auctioneer_name[data-auction-id="${auctionId}"]`);
            if (auctioneerNameElement) {
                
                if(auctioneerName=='') auctioneerNameElement.textContent = `-`;
                else auctioneerNameElement.textContent = ` ${auctioneerName}`;
            }
        }
    };
    xhr.send();
}
