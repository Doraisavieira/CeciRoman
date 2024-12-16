<?php
$playlists = include '../php/exibirPlaylists.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceci Roman</title>
    <link rel="stylesheet" href="../css/pExatas.css">
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
                <span><?php echo htmlspecialchars($playlists[1]['nome_playlist']); ?></span>
                <a href="<?php echo htmlspecialchars($playlists[1]['link_playlist']); ?>" 
                   target="_blank" class="playlist-link">Ouvir</a>
                <?php if ($playlists[1]['id_playlist']): ?>
                    <form action="../php/favPlaylist.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id_playlist" value="<?php echo $playlists[1]['id_playlist']; ?>">
                        <button type="submit" class="heart-button">❤️</button>
                    </form>
                <?php endif; ?>
            </div>

            <!-- Botão 2 -->
            <div class="playlist-button">
                <span><?php echo htmlspecialchars($playlists[2]['nome_playlist']); ?></span>
                <a href="<?php echo htmlspecialchars($playlists[2]['link_playlist']); ?>" 
                   target="_blank" class="playlist-link">Ouvir</a>
                <?php if ($playlists[2]['id_playlist']): ?>
                    <form action="favoritarPlaylist.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id_playlist" value="<?php echo $playlists[2]['id_playlist']; ?>">
                        <button type="submit" class="heart-button">❤️</button>
                    </form>
                <?php endif; ?>
            </div>

            <!-- Botão 3 -->
            <div class="playlist-button">
                <span><?php echo htmlspecialchars($playlists[3]['nome_playlist']); ?></span>
                <a href="<?php echo htmlspecialchars($playlists[3]['link_playlist']); ?>" 
                   target="_blank" class="playlist-link">Ouvir</a>
                <?php if ($playlists[3]['id_playlist']): ?>
                    <form action="favoritarPlaylist.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id_playlist" value="<?php echo $playlists[3]['id_playlist']; ?>">
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
