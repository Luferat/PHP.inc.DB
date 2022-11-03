<?php

// Importa o arquivo de configuração:
require($_SERVER['DOCUMENT_ROOT'] . '/inc/_config.php');

/***********************************************
 * Todo o código PHP desta página começa aqui! *
 ***********************************************/

// Inicializa variáveis do aplicativo:
$author_articles = '';

// Obtém o ID da URL:
$id = intval($_SERVER['QUERY_STRING']);

// Verifica se o ID é igual a 0
if ($id == 0)
    // Se for, carrega página 404:
    header('Location: /404/');

// Escreve o SQL que obtém o artigo:
$sql = <<<SQL

SELECT *,                                                    -- Obtém todos os campos:
    DATE_FORMAT(adate, '%d de %M de %Y às %H:%i') AS adatebr -- Obtém a data formatada em PT-BR e armazena em 'adatebr':
FROM articles                                                -- Da tabela articles:
INNER JOIN users                                             -- Obtém também os dados do usuário:
    ON author = uid                                          -- Quando o ID do autor é o ID do usuário:
WHERE aid = '{$id}'                                          -- Filtra pelo ID do artigo:
    AND astatus = 'online'                                   -- "E" pelo status 'online':
    AND adate <= NOW();                                      -- "E" pela data de publicação menor ou igua a data atual:

SQL;

// Executa o SQL:
$res = $conn->query($sql);

// Verifica se o artigo existe:
if ($res->num_rows != 1)
    // Se não existe, carrega página 404 e encerra o programa:
    header('Location: /404/');

// Extrai os dados do artigo:
$art = $res->fetch_assoc();

// SQL que obtém OUTROS artigos do autor do artigo atual:
$sql = <<<SQL

SELECT aid, title                 -- Só precisamos do ID e do título:
FROM articles                     -- Dos artigos:
WHERE author = '{$art['author']}' -- Filtra pelo ID do autor:    
    AND astatus = 'online'        -- "E" pelo status 'online':
    AND adate <= NOW()            -- "E" pela data de publicação menor ou igua a data atual:
    AND aid != '{$id}'            -- "E" NÃO pega o artigo atual:
ORDER BY RAND()                   -- Obtém os artigos de forma aleatória:
LIMIT 5;                          -- Obtém no máximo 5 artigos:

SQL;

// Extrai a lista de artigos do autor:
$res = $conn->query($sql);

// Se tem artigos do autor:
if ($res->num_rows > 0) :

    // Inicializa a lista de artigos do autor:
    $author_articles = '<h3>+ Artigos</h3><ul>';

    // Loop para obter cada um dos artigos:
    while ($aart = $res->fetch_assoc()) :

        // Adiciona o artigo atula na lista:
        $author_articles .= "<li><a href=\"/view/?{$aart['aid']}'\">{$aart['title']}</a></li>";

    endwhile;

    // Conclui a lista:
    $author_articles .= "</ul>";

endif;

// Calcula idade do autor:
$age = agecalc($art['birth']);

// Formata a página para exibição:
$page_content .= <<<HTML

<article>

    <h2>{$art['title']}</h2>
    
    <div class="author_date">
        <small>Por {$art['name']}.</small><br>
        <small>Em {$art['adatebr']}.</small>
    </div>

    {$art['content']}

</article>

<aside>

    <div>
        <img src="{$art['photo']}" alt="{$art['name']}">
        <h3>{$art['name']}</h3>
        <ul>
            <li>E-mail: {$art['email']}</li>
            <li>Idade: {$age} anos</li>
        </ul>
        <p>{$art['bio']}</p>
    </div>    
    {$author_articles}

</div>

HTML;

// Define o título da página como título do artigo:
$page_title = $art['title'];

/************************************************
 * Todo o código PHP desta página termina aqui! *
 ************************************************/

// Importa template da página:
require($_SERVER['DOCUMENT_ROOT'] . '/inc/_template.php');
