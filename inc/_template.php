<?php

/**
 * Processa o título da página → Tag <title>...</title>:
 **/
if ($page_title == '')                      // Se o título da página não foi definido...
    $tag_title .= " ·:· " . $site_slogan;   // O título recebe o slogan:
else                                        // Se definiu um título...
    $tag_title .= " ·:· " . $page_title;    // O título recebe o título definido:

/**
 * Processa mensagem de 'Copyright' → Tag <footer>...</footer>:
 **/
$ytoday = intval(date('Y'));                // Obtém o ano atual:
if ($ytoday > $site_year)                   // Se o ano atual é maior do que o ano do site...
    $copyright .= "{$ytoday} {$site_name}"; // Mostra o ano do site e o ano atual na mensagem:
else                                        // Se o ano atual é o ano do site...
    $copyright .= $site_name;               // Mostra somente o ano do site na mensagem:

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/light.css" id="themeCSS">
    <title><?php echo $tag_title ?></title>
</head>

<body>

    <div id="wrap">

        <header>
            <h1 onclick="location.href='/'">
                <?php echo $site_name ?>
                <small><?php echo $site_slogan ?></small>
            </h1>
            <div id="theme" title="Trocar o tema">
                <i class="fa-solid fa-lightbulb"></i>
            </div>
        </header>

        <nav>
            <a href="/">Início</a>
            <a href="/contacts">Contatos</a>
            <a href="/about">Sobre</a>
        </nav>

        <main><?php echo $page_content ?></main>

        <footer>
            <div><?php echo $copyright ?><br></div>
            <small><a href="/policies">Políticas de privacidade</a></small>
        </footer>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="/script.js"></script>

</body>

</html>