$servername = "localhost"; // Adres serwera MySQL
$username = "root"; // Nazwa użytkownika MySQL 
$password = ""; // Hasło do MySQL 
$database = "database"; // Nazwa bazy danych

// Nawiązanie połączenia z bazą danych
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Dane użytkownika do zapisania
$username = "nazwa_uzytkownika";
$email = "adres_email";
$password = "haslo_uzytkownika";

// Zapytanie SQL do wstawienia danych do tabeli "users"
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "Dane użytkownika zostały zapisane poprawnie.";
} else {
    echo "Błąd podczas zapisywania danych: " . mysqli_error($conn);
}

// Zapytanie SQL do pobrania wszystkich użytkowników
$sql = "SELECT * FROM users";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"] . ", Nazwa użytkownika: " . $row["username"] . ", Email: " . $row["email"] . "<br>";
    }
} else {
    echo "Brak danych użytkowników w bazie.";
}

mysqli_close()