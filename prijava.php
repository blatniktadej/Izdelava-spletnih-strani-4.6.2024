<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uporabnisko_ime = $_POST['uporabnisko_ime'];
    $geslo = $_POST['geslo'];
    
    $sql = "SELECT id, geslo, uporabnisko_ime FROM users WHERE uporabnisko_ime = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Napaka pri pripravi poizvedbe: " . $conn->error);
    }
    $stmt->bind_param("s", $uporabnisko_ime);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $stored_password, $username);
    $stmt->fetch();
    
    if ($stmt->num_rows > 0) {
        if ($geslo === $stored_password) { // Preverjanje gesla brez hashiranja
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error = "Napačno geslo.";
        }
    } else {
        $error = "Uporabniško ime ne obstaja.";
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava - Izobraževanje za Vse</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Izobraževanje za Vse</h1>
        <nav>
            <ul>
                <li><a href="index.php">Domov</a></li>
                <li><a href="index.php#programi">Programi</a></li>
                <li><a href="index.php#storitve">Storitve</a></li>
                <li><a href="index.php#kontakt">Kontakt</a></li>
                <li><a href="prijava.php">Prijava</a></li>
                <li><a href="registracija.php">Registracija</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Prijava</h2>
            <form method="post" action="prijava.php">
                <label for="uporabnisko_ime">Uporabniško ime:</label>
                <input type="text" id="uporabnisko_ime" name="uporabnisko_ime" required>
                
                <label for="geslo">Geslo:</label>
                <input type="password" id="geslo" name="geslo" required>
                
                <?php if (isset($error)): ?>
                    <p class="error"><?= $error ?></p>
                <?php endif; ?>
                
                <button type="submit">Prijavi se</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Izobraževanje za Vse. Vse pravice pridržane.</p>
    </footer>
</body>
</html>
