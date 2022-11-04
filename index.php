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
$sql = <<<SQL

SELECT aid, title, thumbnail, resume    -- Seleciona apenas os campos necessários:
FROM articles                           -- Da tabela articles:
    WHERE astatus = 'online'            -- Filtra pelo status 'online':
    AND adate <= NOW()                  -- "E" pela data de publicação menor ou igua a data atual:
ORDER by adate DESC                     -- Ordena pela data de publicação mais recente:

SQL;

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
    <div class="artimg" style="background-image: url('{$art['thumbnail']}')" title="{$art['title']}"></div>
    <div>
        <h3 class="arttitle">{$art['title']}</h3>
        <div class="artresume">{$art['resume']}</div>
    </div>
</div> 

HTML;

    // Fim do loop dos artigos:
    endwhile;

endif;

// Saída para o template:
$page_content = <<<HTML

<article>
    {$content}
</article>

<aside>
    <h3>Conteúdo complementar</h3>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed et harum natus.</p>
</aside>

HTML;

/************************************************
 * Todo o código PHP desta página termina aqui! *
 ************************************************/

// Importa template da página:
require($_SERVER['DOCUMENT_ROOT'] . '/inc/_template.php');
