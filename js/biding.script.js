document.addEventListener("DOMContentLoaded", function () {
    var bidButtons = document.querySelectorAll(".bid-button");
    var isButtonDisabled = false;

    bidButtons.forEach(function (button, index) {

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

                confirmYesButton.addEventListener("click", function () {
                    console.log("Button clicked");
                    var auctionIdToSend = auctionId;
                    var newPriceToSend = document.getElementById("new_price_" + auctionId).value;

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
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

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

                confirmNoButton.addEventListener("click", function () {
                    console.log("Button clicked");
                    // Zamykanie komunikatu
                    currentMessageBox.style.display = "none";
                    currentFog.style.display = 'none';
                });

                // Dodaj obsługę przycisku OK w komunikacie o błędzie
                var confirmOkButton = errorMessageBox.querySelector(".confirm-ok");
                confirmOkButton.addEventListener("click", function () {
                    console.log("Button clicked");
                    // Zamykanie komunikatu o błędzie
                    errorMessageBox.style.display = "none";
                    currentFog.style.display = 'none';
                });
            }
        });
    });
});
