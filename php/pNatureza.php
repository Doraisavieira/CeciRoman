<?php
$playlists = include '../php/exibirPlaylists.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceci Roman</title>
    <link rel="stylesheet" href="../css/pNatureza.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">Ceci Roman <span class="note">♪</span></div>
        <nav>
            <a href="../html/playlist.html">Playlists</a>
            <a href="../html/questionario.html">Questionário</a>
            <a href="../html/telaApresentacao.html" class="home-icon">🏠</a>
        </nav>
    </header>
    <main class="container">
        <section class="menu">
            <!-- Botão 1 -->
            <div class="playlist-button">
                <span><?php echo htmlspecialchars($playlists[13]['nome_playlist']); ?></span>
                <a href="<?php echo htmlspecialchars($playlists[13]['link_playlist']); ?>" 
                   target="_blank" class="playlist-link">Ouvir</a>
                <?php if ($playlists[13]['id_playlist']): ?>
                    <form action="../php/favPlaylist.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id_playlist" value="<?php echo $playlists[13]['id_playlist']; ?>">
                        <button type="submit" class="heart-button">❤️</button>
                    </form>
                <?php endif; ?>
            </div>

            <!-- Botão 2 -->
            <div class="playlist-button">
                <span><?php echo htmlspecialchars($playlists[14]['nome_playlist']); ?></span>
                <a href="<?php echo htmlspecialchars($playlists[14]['link_playlist']); ?>" 
                   target="_blank" class="playlist-link">Ouvir</a>
                <?php if ($playlists[14]['id_playlist']): ?>
                    <form action="favoritarPlaylist.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id_playlist" value="<?php echo $playlists[14]['id_playlist']; ?>">
                        <button type="submit" class="heart-button">❤️</button>
                    </form>
                <?php endif; ?>
            </div>

            <!-- Botão 3 -->
            <div class="playlist-button">
                <span><?php echo htmlspecialchars($playlists[15]['nome_playlist']); ?></span>
                <a href="<?php echo htmlspecialchars($playlists[15]['link_playlist']); ?>" 
                   target="_blank" class="playlist-link">Ouvir</a>
                <?php if ($playlists[15]['id_playlist']): ?>
                    <form action="favoritarPlaylist.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id_playlist" value="<?php echo $playlists[15]['id_playlist']; ?>">
                        <button type="submit" class="heart-button">❤️</button>
                    </form>
                <?php endif; ?>
            </div>
        </section>
        <section class="image-container">
            <img src="../img/violaoAzul.png" alt="Violão" class="violao-img">
        </section>
    </main>
</body>
</html>
