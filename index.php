<?php
/**
 * ============================================================
 * ARQUIVO: index.php
 * FUNÇÃO: Router principal / Ponto de entrada do sistema
 * DESCRIÇÃO: Recebe as requisições HTTP e direciona para a 
 *            página correta com base no parâmetro 'page'
 * ============================================================
 */

// ============================================================
// DEFINIÇÃO DE CONSTANTES GLOBAIS
// ============================================================

// BASE_PATH: Caminho absoluto do sistema de arquivos até a raiz do projeto
// dirname(__FILE__) retorna o diretório onde este arquivo está localizado
define('BASE_PATH', dirname(__FILE__));

// BASE_URL: URL base do projeto para uso em links e assets
// Exemplo: se o projeto está em http://localhost/bar, BASE_URL = '/bar/'
define('BASE_URL', '/');

// ============================================================
// DEFINIÇÃO DAS ROTAS DISPONÍVEIS
// ============================================================

// Array associativo que mapeia nomes de rotas para arquivos PHP
// Chave = nome da rota usada na URL (?page=CHAVE)
// Valor = caminho do arquivo PHP correspondente
$rotas = [
    ''              => 'views/home/index_vw.php',      // Rota padrão (página inicial)
    'index'         => 'views/home/index_vw.php',      // Rota alternativa para página inicial
    'servicos'      => 'views/servicos/servicos_vw.php', // Página de serviços
    'equipe'        => 'views/equipe/equipe_vw.php',   // Página da equipe
    'sobre'         => 'views/sobre/sobre_vw.php',     // Página sobre a empresa
    'contato'       => 'views/contato/contato_vw.php', // Página de contato
    'agendamento'   => 'views/agedamento/agendamento_vw.php', // Página de agendamento
];

// ============================================================
// PROCESSAMENTO DA REQUISIÇÃO
// ============================================================

// Obtém o parâmetro 'page' da URL via método GET
// Exemplo: http://localhost/?page=servicos → $rota = 'servicos'
// Se não houver parâmetro, assume string vazia (página inicial)
$rota = isset($_GET['page']) ? trim($_GET['page'], '/') : '';

// ============================================================
// DIRECIONAMENTO DA ROTA
// ============================================================

// Verifica se a rota solicitada existe no array de rotas
if (array_key_exists($rota, $rotas)) {
    // Monta o caminho completo do arquivo PHP
    $arquivo = BASE_PATH . '/' . $rotas[$rota];
    
    // Verifica se o arquivo fisicamente existe no servidor
    if (file_exists($arquivo)) {
        // Inclui e executa o arquivo da página solicitada
        require_once $arquivo;
    } else {
        // Arquivo não encontrado no sistema de arquivos
        http_response_code(404); // Define código HTTP 404
        echo '<h1>404 - Arquivo não encontrado</h1>';
    }
} else {
    // Rota não existe no array de rotas disponíveis
    http_response_code(404); // Define código HTTP 404
    echo '<h1>404 - Página não encontrada</h1>';
}
