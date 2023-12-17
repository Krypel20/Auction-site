document.addEventListener("DOMContentLoaded", function () {
    var bidButtons = document.querySelectorAll(".bid-button");
    var messageBoxes = document.querySelectorAll(".message-box");

    bidButtons.forEach(function (button, index) {
        button.addEventListener("click", function () {
            var auctionId = button.getAttribute("data-auction-id");
            var currentMessageBox = document.querySelector(".message-box[data-auction-id='" + auctionId + "']");
            var currentFog = document.querySelector(".fog[data-auction-id='" + auctionId + "']");

            if (currentMessageBox) 
            {
                currentMessageBox.style.display = "block";
                currentFog.style.display = 'flex';

                var confirmYesButton = currentMessageBox.querySelector(".confirm-yes");
                var confirmNoButton = currentMessageBox.querySelector(".confirm-no");
                confirmYesButton.addEventListener("click", function () {
                    var auctionIdToSend = auctionId;
                    var newPriceToSend = document.getElementById("new_price_" + auctionId).value;

                    // Po potwierdzeniu wywołaj zapytanie Ajax
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
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error =>{
                        console.error('Błąd zapytania Ajax:', error);
                    });

                    currentMessageBox.style.display = "none";
                    currentFog.style.display = 'none';
                });

                confirmNoButton.addEventListener("click", function () 
                {
                    currentMessageBox.style.display = "none";
                    currentFog.style.display = 'none';
                });
            }
        });
    });
});

