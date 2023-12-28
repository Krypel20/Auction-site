var bidButtons = document.querySelectorAll(".bid-button");  
var isButtonDisabled = false;

bidButtons.forEach(function(button) {

    button.addEventListener("click", function () {
        var auctionId = button.getAttribute("data-auction-id");
        var currentMessageBox = document.querySelector(".message-box[data-auction-id='" + auctionId + "']");
        var currentFog = document.querySelector(".fog[data-auction-id='" + auctionId + "']");
        var errorMessageBox = document.querySelector(".error-message-box[data-auction-id='" + auctionId + "']");    
  });

});


// funkcja DOMContentLoaded   

document.addEventListener("DOMContentLoaded", function() {

  var currentMessageBox = document.querySelector(".message-box");
  
  // ...pozostały kod obsługi DOM
  
});


function sendAjaxRequest(auctionId, newPrice) {

  fetch('licytacja.php', {
    method: 'POST',
    body: new FormData(form), 
    credentials: 'include'
  })
  .then(response => {
    // kod obsługi odpowiedzi
  })
  .catch(error => {
    console.error('Błąd:', error);
  });

}