document.addEventListener("DOMContentLoaded", function () {
    var bidButtons = document.querySelectorAll(".bid-button");

    bidButtons.forEach(function (button) {

        button.addEventListener("click", function () {
            var auctionId = button.getAttribute("data-auction-id");
            var currentMessageBox = document.querySelector(".message-box[data-auction-id='" + auctionId + "']");
            var currentFog = document.querySelector(".fog[data-auction-id='" + auctionId + "']");
            var errorMessageBox = document.querySelector(".error-message-box[data-auction-id='" + auctionId + "']");
            
            if (currentMessageBox) {
                currentMessageBox.style.display = "block";
                currentFog.style.display = 'flex';

                var confirmYesButton = currentMessageBox.querySelector(".confirm-yes");
                var confirmNoButton = currentMessageBox.querySelector(".confirm-no");

                //Obsługa przycisku 'Tak' w komunikacie o potwierdzeniu chęci licytacji
                confirmYesButton.addEventListener("click", function () {
                    console.log("Button clicked");
                    
                    // Pobranie identyfikatora aukcji i nowej ceny do wysłania
                    var auctionIdToSend = auctionId;
                    var newPriceToSend = document.getElementById("new_price_" + auctionId).value;

                    // Wysłanie żądania POST za pomocą fetch do pliku PHP obsługującego licytację
                    fetch('includes/presentAuctions.inc.php', {
                        method: 'POST',
                        body: new URLSearchParams({
                            'confirm-licit': '1',
                            'auction_id': auctionIdToSend,
                            'new_price': newPriceToSend,
                        }),
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        credentials: 'include',
                    })
                    
                    // Obsługa odpowiedzi w formacie JSON
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        console.log(JSON.stringify(data))
                        // Wyświetlanie błędów
                        if (data.error && !data.success) {
                            currentMessageBox.style.display = "none";
                            errorMessageBox.style.display = "block";
                            errorMessageBox.querySelector(".error-box").innerHTML = `<p>${data.error}</p>`;
                        } else {
                            // Licytacja udana
                            if (data.success) {
                                console.log(data.success);
                                currentFog.style.display = 'none';
                                currentMessageBox.style.display = "none";
                                return 0;
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Błąd zapytania Ajax:', error);
                    });
                });

                //Obsługa przycisku 'Nie' w komunikacie o potwierdzeniu chęci licytacji - zamykanie komunikatu
                confirmNoButton.addEventListener("click", function () {
                    console.log("Button clicked");
                    currentMessageBox.style.display = "none";
                    currentFog.style.display = 'none';
                });

                //Obsługa przycisku 'OK' w komunikacie o błędzie - zamykanie komunikatu
                var confirmOkButton = errorMessageBox.querySelector(".confirm-ok");
                confirmOkButton.addEventListener("click", function () {
                    console.log("Button clicked");
                    errorMessageBox.style.display = "none";
                    currentFog.style.display = 'none';
                });
            }
        });
    });
});
