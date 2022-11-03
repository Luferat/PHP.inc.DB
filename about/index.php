<?php

// Importa o arquivo de configuração:
require($_SERVER['DOCUMENT_ROOT'] . '/inc/_config.php');

/***********************************************
 * Todo o código PHP desta página começa aqui! *
 ***********************************************/

// Define o título da página:
$page_title = 'Sobre...';

/**************************************************************
 * Define o conteúdo "visual" da página:                      *
 * Observe que temos, por padrão, um design com duas colunas. *
 * A coluna "aside", porém, será opcional para cada página.   *
 **************************************************************/
$page_content = <<<HTML

<article>

    <h2>{$page_title}</h2>
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Soluta, sint sequi nam tempora quis doloremque cupiditate eos quaerat nulla laudantium perspiciatis. Nisi esse commodi ipsam nostrum fuga omnis iure quos.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum excepturi laudantium maxime voluptatibus quia deserunt voluptatum delectus odit consequatur, eligendi reiciendis nulla quas laborum rerum mollitia, voluptatem sequi velit omnis.</p>

</article>

<aside>

    <h3>Conteúdo complementar</h3>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint incidunt assumenda, ab dignissimos illum.</p>

</aside>

HTML;

/************************************************
 * Todo o código PHP desta página termina aqui! *
 ************************************************/

// Importa template da página:
require($_SERVER['DOCUMENT_ROOT'] . '/inc/_template.php');
?>