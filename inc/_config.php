<?php

// PHP em UTF-8:
header('Content-Type: text/html; charset=utf-8');

// Fuso horário de Brasília:
date_default_timezone_set('America/Sao_Paulo');

/**************************************
 * Inicializa variáveis do aplicativo *
 **************************************/
$page_title = '';                           // Título dinâmico da página:
$page_content = '';                         // Conteúdo dinâmico da página:
$site_name = 'PHP.inc.DB';                  // Nome do site:
$site_slogan = 'Só um site dinâmico...';    // Slogan do site:
$tag_title = $site_name;                    // Formato da tag <title>:
$site_year = 2022;                          // Ano de lançamento do site:
$copyright = "&copy; {$site_year} ";        // Mensagem de Copyright no rodapé:

/***************************************************
 * Configurações de acesso ao banco de dados MySQL *
 ***************************************************/

/**
 * Se no endereço do site temos a palavra 'localhost', provavelmente estamos
 * usando o XAMPP...
 **/
if (strpos($_SERVER['SERVER_NAME'], 'localhost') >= 0) :

    // Configurações de acesso ao banco de dados usando o XAMPP:
    $hostname = 'localhost';    // Endereço do servidor MySQL:
    $username = 'root';         // Nome de usuário do MySQL: 
    $password = '';             // Senha do usuário do MySQL:
    $database = 'phpincdb';     // Nome do bando de dados:

// Se não estamos no XAMMP, estamos no provedor de hospedagem...
else :

    /**
     * Configurações de acesso ao banco de dados do provedor:
     * OBS: preencha com os dados fornecidos pelo provedor.
     **/
    $hostname = '';
    $username = '';
    $password = '';
    $database = '';

endif;

// Conexão com o banco de dados:
$conn = new mysqli($hostname, $username, $password, $database);

// Seta transações com MySQL/MariaDB para UTF-8:
$conn->query("SET NAMES 'utf8'");
$conn->query('SET character_set_connection=utf8');
$conn->query('SET character_set_client=utf8');
$conn->query('SET character_set_results=utf8');

// Seta dias da semana e meses do MySQL/MariaDB para "português do Brasil":
$conn->query('SET GLOBAL lc_time_names = pt_BR');
$conn->query('SET lc_time_names = pt_BR');

/*******************************************************************
 * Funções de uso geral                                            *
 * Essas funções podem ser usadas em qualquer parte do aplicativo. *
 *******************************************************************/

// Função para DEBUG:
function debug($variable, $exit = true, $dump = false)
{
    echo '<pre>';
    if ($dump) var_dump($variable);
    else print_r($variable);
    echo '</pre>';
    if ($exit) die();
};

/**
 * Converte uma data para outro formato:
 * Exemplos:
 *      dt_convert('2022-10-31');
 *      dt_convert('2022-10-31', 'd/m/Y');
 *      dt_convert('31-10-2022', 'Y-m-d');
 *      dt_convert('31/10/2022 12:34:59', 'Y-m-d H:i');
 **/
function dt_convert($date, $format = 'Y-m-d H:i:s')
{
    $date = str_replace('/', '-', $date);
    $d = date_create($date);
    return date_format($d, $format);
}

/**
 * Calcula a idade com base na data de nascimento, levando em consideração 
 * o ano, mês e dia do nascimento:
 * OBS: a data deve estar no formado 'Y-m-d'.
 **/
function agecalc($birth)
{
    $date = new DateTime($birth);   // Converte a data de nascimento para segundos:
    $now = new DateTime();          // Obtém a data atual em segundos:
    $interval = $now->diff($date);  // Calcula a diferença entre as datas:
    return $interval->y;            // Extrai o tempo em anos dos segundos e retorna:
}
