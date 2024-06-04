<?php
session_start();
include 'config.php';

$loggedIn = isset($_SESSION['user_id']);
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izobraževanje za Vse</title>
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
                <?php if ($loggedIn): ?>
                    <li><span>Prijavljen kot: <?= htmlspecialchars($username) ?></span></li>
                    <li><a href="logout.php">Odjava</a></li>
                <?php else: ?>
                    <li><a href="prijava.php">Prijava</a></li>
                    <li><a href="registracija.php">Registracija</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <section id="domov">
            <h2>Dobrodošli</h2>
            <p>Naša misija je zagotoviti kakovostno izobraževanje za vse generacije. Pri nas se lahko naučite novih spretnosti, poglobite svoje znanje ali se pripravite na poklicno pot.</p>
        </section>
        <section id="programi">
            <h2>Naši Programi</h2>
            <div class="program">
                <h3>Osnovno Izobraževanje</h3>
                <p>Programi za osnovno izobraževanje otrok in mladostnikov.</p>
            </div>
            <div class="program">
                <h3>Srednješolski Programi</h3>
                <p>Širok nabor srednješolskih programov za vse interese.</p>
            </div>
            <div class="program">
                <h3>Odrasli Izobraževanje</h3>
                <p>Tečaji in delavnice za odrasle, ki želijo nadgraditi svoje znanje ali pridobiti nove veščine.</p>
            </div>
        </section>
        <section id="storitve">
            <h2>Naše Storitve</h2>
            <p>Poleg izobraževalnih programov nudimo tudi svetovanje, mentorstvo in podporo pri iskanju zaposlitve.</p>
        </section>
        <section id="kontakt">
            <h2>Kontaktirajte Nas</h2>
            <form>
                <label for="ime">Ime:</label>
                <input type="text" id="ime" name="ime" required>
                
                <label for="email">E-pošta:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="sporocilo">Sporočilo:</label>
                <textarea id="sporocilo" name="sporocilo" required></textarea>
                
                <button type="submit">Pošlji</button>
            </form>
        </section>
        <?php if ($loggedIn): ?>
            <section id="registrirani-uporabniki">
                <h2>Registrirani Uporabniki</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Ime</th>
                            <th>Priimek</th>
                            <th>E-pošta</th>
                            <th>Uporabniško ime</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT ime, priimek, email, uporabnisko_ime FROM users";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . htmlspecialchars($row["ime"]). "</td><td>" . htmlspecialchars($row["priimek"]). "</td><td>" . htmlspecialchars($row["email"]). "</td><td>" . htmlspecialchars($row["uporabnisko_ime"]). "</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Ni registriranih uporabnikov.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 Izobraževanje za Vse. Vse pravice pridržane.</p>
    </footer>
</body>
</html>

