<?php

// Importa o arquivo de configuração:
require($_SERVER['DOCUMENT_ROOT'] . '/inc/_config.php');

/***********************************************
 * Todo o código PHP desta página começa aqui! *
 ***********************************************/

// Define o título da página:
$page_title = '';

// Inicializa o conteúdo da página:
$content = '<h2>Artigos Recentes</h2>';

// query para obter todos os artigos do site:
$sql = "

SELECT aid, title, thumbnail, resume
FROM articles
    WHERE astatus = 'online'
    AND adate <= NOW()
ORDER by adate DESC

";

// Executa query e armazena em '$res':
$res = $conn->query($sql);

// Se não existem artigos...
if ($res->num_rows == 0) :

    // Exibe mensagem para o usuário:
    $content .= "<p>Ooooops! Nenhum artigo encontrado...";

// Se achou os artigos...
else :

    // Loop para obter cada um dos artigos:
    while ($art = $res->fetch_assoc()) :

        /**
         * Formata os artigos para exibição, concatenando a visualização (HTML)
         * de cada artigo em '$content':
         **/
        $content .= <<<HTML

<div class="artbox" onclick="location.href='/view/?{$art['aid']}'">
    <img src="{$art['thumbnail']}" alt="{$art['title']}">
    <h3>{$art['title']}</h3>
    <div>{$art['resume']}</div>
</div>

HTML;

    endwhile;

endif;

// Saída para o template:
$page_content = <<<HTML

<article>
    {$content}
</article>

<aside>
    Conteúdo complementar...
</aside>

HTML;

/************************************************
 * Todo o código PHP desta página termina aqui! *
 ************************************************/

// Importa template da página:
require($_SERVER['DOCUMENT_ROOT'] . '/inc/_template.php');
?>