<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceci Roman</title>
    <link rel="stylesheet" href="../css/perfil.css">
</head>
<body>
    <header>
        <div class="logo">Ceci Roman <span class="note">♪</span></div>
        <nav>
            <a href="../html/playlist.html">Playlists</a>
            <a href="../html/questionario.html">Questionário</a>
            <a href="../html/perfil.php">Meu perfil</a>
            <a href="../html/telaApresentacao.html" class="home-icon">🏠</a>
        </nav>
    </header>
    <main>
        <section class="info-section">
            <div class="info-item">
                <p>Seu gênero musical é: 
                    <?php
                    $servername = "localhost"; 
                    $username = "root";        
                    $password = "";          
                    $dbname = "CeciRoman";     

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Falha na conexão: " . $conn->connect_error);
                    }

                    $user_id = $_SESSION['id_usuario'];

                    $sql = "SELECT genero_preferido FROM usuarios WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_usuario); 
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo htmlspecialchars($row['genero_preferido']);
                    } else {
                        echo "Não definido";
                    }
                    $stmt->close();
                    $conn->close();
                    ?>
                </p>
            </div>
            <div class="info-item">
                <button style="background-image: url('../img/logoMusFavs.png');" onclick="window.location.href='../php/pFavoritas.php'" aria-label="Suas favoritas"></button>
                <p>Suas favoritas</p>
            </div>
            <div class="info-item">
                <button style="background-image: url('../img/logoTocRecs.png');"onclick="window.location.href='../php/tocadasRecs.php'"aria-label="Tocadas recentemente"></button>
                <p>Tocadas recentemente</p>
            </div>
        </section>
        <div class="button-container">
            <button onclick="window.location.href='alterarDados.html'">Altere seus dados</button>
        </div>
    </main>
</body>
</html>
