<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $_POST['ime'];
    $priimek = $_POST['priimek'];
    $email = $_POST['email'];
    $uporabnisko_ime = $_POST['uporabnisko_ime'];
    $geslo = $_POST['geslo']; // Brez hashiranja gesla
    
    $sql = "INSERT INTO users (ime, priimek, email, uporabnisko_ime, geslo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $ime, $priimek, $email, $uporabnisko_ime, $geslo);
    
    if ($stmt->execute()) {
        header("Location: prijava.php");
        exit();
    } else {
        $error = "Prišlo je do napake pri registraciji.";
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
    <title>Registracija - Izobraževanje za Vse</title>
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
            <h2>Registracija</h2>
            <form method="post" action="registracija.php">
                <label for="ime">Ime:</label>
                <input type="text" id="ime" name="ime" required>
                
                <label for="priimek">Priimek:</label>
                <input type="text" id="priimek" name="priimek" required>
                
                <label for="email">E-pošta:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="uporabnisko_ime">Uporabniško ime:</label>
                <input type="text" id="uporabnisko_ime" name="uporabnisko_ime" required>
                
                <label for="geslo">Geslo:</label>
                <input type="password" id="geslo" name="geslo" required>
                
                <?php if (isset($error)): ?>
                    <p class="error"><?= $error ?></p>
                <?php endif; ?>
                
                <button type="submit">Registriraj se</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Izobraževanje za Vse. Vse pravice pridržane.</p>
    </footer>
</body>
</html>
