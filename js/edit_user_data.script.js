document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('overlay');

    // Otwieranie formularza po kliknięciu w przycisk
    document.querySelector('.edit-profile-button').addEventListener('click', function () {
        overlay.style.display = 'flex';
    });

    // Zamykanie formularza po kliknięciu poza jego obszarem
    overlay.addEventListener('click', function (event) {
        if (event.target === overlay) {
        overlay.style.display = 'none';
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('edit-user-profile');

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Zatrzymaj domyślną akcję formularza

        changePassword(); // Wywołaj funkcję do obsługi zmiany hasła
    });

    function changePassword() {
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);

                if (response.success) {
                    // Zaktualizuj stronę po pomyślnej zmianie hasła
                    location.reload();
                } else {
                    // Wyświetl błędy wewnątrz <p> na stronie
                    var errorBox = document.querySelector('.edit-form .error-box');
                    errorBox.textContent = response.message;
                }
            }
        };

        xhr.open('POST', form.action, true);
        xhr.send(formData);
    }
});

