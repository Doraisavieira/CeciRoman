<?php
$playlists = include '../php/exibirPlaylists.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceci Roman</title>
    <link rel="stylesheet" href="../css/p.css">
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
                <span><?php echo htmlspecialchars($playlists[4]['nome_playlist']); ?></span>
                <a href="<?php echo htmlspecialchars($playlists[4]['link_playlist']); ?>" 
                   target="_blank" class="playlist-link">Ouvir</a>
                <?php if ($playlists[4]['id_playlist']): ?>
                    <form action="../php/favPlaylist.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id_playlist" value="<?php echo $playlists[4]['id_playlist']; ?>">
                        <button type="submit" class="heart-button">❤️</button>
                    </form>
                <?php endif; ?>
            </div>

            <!-- Botão 2 -->
            <div class="playlist-button">
                <span><?php echo htmlspecialchars($playlists[5]['nome_playlist']); ?></span>
                <a href="<?php echo htmlspecialchars($playlists[5]['link_playlist']); ?>" 
                   target="_blank" class="playlist-link">Ouvir</a>
                <?php if ($playlists[5]['id_playlist']): ?>
                    <form action="favoritarPlaylist.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id_playlist" value="<?php echo $playlists[5]['id_playlist']; ?>">
                        <button type="submit" class="heart-button">❤️</button>
                    </form>
                <?php endif; ?>
            </div>

            <!-- Botão 3 -->
            <div class="playlist-button">
                <span><?php echo htmlspecialchars($playlists[6]['nome_playlist']); ?></span>
                <a href="<?php echo htmlspecialchars($playlists[6]['link_playlist']); ?>" 
                   target="_blank" class="playlist-link">Ouvir</a>
                <?php if ($playlists[6]['id_playlist']): ?>
                    <form action="favoritarPlaylist.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id_playlist" value="<?php echo $playlists[6]['id_playlist']; ?>">
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
