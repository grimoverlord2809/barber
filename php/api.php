<?php
/**
 * API - Processar Agendamentos
 * Barbearia Premium
 * Padrão: tb_tabela | idTabela
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/cliente.php';
require_once __DIR__ . '/servico.php';
require_once __DIR__ . '/equipe.php';
require_once __DIR__ . '/agendamento.php';

function enviarResposta($dados, $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode($dados);
    exit;
}

function obterDadosRequisicao() {
    $contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
    
    if (strpos($contentType, 'application/json') !== false) {
        return json_decode(file_get_contents('php://input'), true);
    }
    
    return $_POST;
}

try {
    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    $metodo = $_SERVER['REQUEST_METHOD'];
    
    switch ($acao) {
        
        // ==========================================
        // AGENDAMENTOS
        // ==========================================
        
        case 'listar_agendamentos':
            if ($metodo !== 'GET') {
                enviarResposta(['erro' => 'Método não permitido'], 405);
            }
            
            $filtros = [
                'data'       => $_GET['data'] ?? null,
                'barbeiro_id'=> $_GET['barbeiro_id'] ?? null,
                'status'     => $_GET['status'] ?? null,
            ];
            
            $agendamentos = Agendamento::listar($filtros);
            enviarResposta(['sucesso' => true, 'dados' => $agendamentos]);
            break;
        
        case 'criar_agendamento':
            if ($metodo !== 'POST') {
                enviarResposta(['erro' => 'Método não permitido'], 405);
            }
            
            $dados = obterDadosRequisicao();
            
            // Validações
            if (empty($dados['nome']) || empty($dados['telefone'])) {
                enviarResposta(['erro' => 'Nome e telefone são obrigatórios'], 400);
            }
            
            if (empty($dados['servico_id']) || empty($dados['barbeiro_id'])) {
                enviarResposta(['erro' => 'Serviço e barbeiro são obrigatórios'], 400);
            }
            
            if (empty($dados['data_agendamento']) || empty($dados['hora_inicio'])) {
                enviarResposta(['erro' => 'Data e horário são obrigatórios'], 400);
            }
            
            // Buscar ou criar cliente
            $cliente = Cliente::buscarPorTelefone($dados['telefone']);
            
            if (!$cliente) {
                $clienteId = Cliente::criar([
                    'nome'     => $dados['nome'],
                    'email'    => $dados['email'] ?? null,
                    'telefone' => $dados['telefone'],
                ]);
            } else {
                $clienteId = $cliente['idCliente'];
            }
            
            // Criar agendamento
            $resultado = Agendamento::criar([
                'cliente_id'       => $clienteId,
                'servico_id'       => $dados['servico_id'],
                'barbeiro_id'      => $dados['barbeiro_id'],
                'data_agendamento' => $dados['data_agendamento'],
                'hora_inicio'      => $dados['hora_inicio'],
                'observacoes'      => $dados['observacoes'] ?? null,
            ]);
            
            if (isset($resultado['erro'])) {
                enviarResposta(['erro' => $resultado['erro']], 400);
            }
            
            enviarResposta([
                'sucesso' => true,
                'mensagem' => 'Agendamento realizado com sucesso!',
                'id' => $resultado['id']
            ]);
            break;
        
        case 'cancelar_agendamento':
            if ($metodo !== 'POST') {
                enviarResposta(['erro' => 'Método não permitido'], 405);
            }
            
            $dados = obterDadosRequisicao();
            
            if (empty($dados['id'])) {
                enviarResposta(['erro' => 'ID do agendamento é obrigatório'], 400);
            }
            
            $resultado = Agendamento::cancelar($dados['id']);
            
            if ($resultado) {
                enviarResposta(['sucesso' => true, 'mensagem' => 'Agendamento cancelado']);
            } else {
                enviarResposta(['erro' => 'Erro ao cancelar agendamento'], 500);
            }
            break;
        
        // ==========================================
        // HORÁRIOS DISPONÍVEIS
        // ==========================================
        
        case 'horarios_disponiveis':
            if ($metodo !== 'GET') {
                enviarResposta(['erro' => 'Método não permitido'], 405);
            }
            
            if (empty($_GET['barbeiro_id']) || empty($_GET['data'])) {
                enviarResposta(['erro' => 'Barbeiro e data são obrigatórios'], 400);
            }
            
            $horarios = Agendamento::horariosDisponiveis($_GET['barbeiro_id'], $_GET['data']);
            enviarResposta(['sucesso' => true, 'dados' => $horarios]);
            break;
        
        // ==========================================
        // SERVIÇOS
        // ==========================================
        
        case 'listar_servicos':
            if ($metodo !== 'GET') {
                enviarResposta(['erro' => 'Método não permitido'], 405);
            }
            
            $servicos = Servico::listar();
            enviarResposta(['sucesso' => true, 'dados' => $servicos]);
            break;
        
        // ==========================================
        // EQUIPE
        // ==========================================
        
        case 'listar_equipe':
            if ($metodo !== 'GET') {
                enviarResposta(['erro' => 'Método não permitido'], 405);
            }
            
            $equipe = Equipe::listar();
            enviarResposta(['sucesso' => true, 'dados' => $equipe]);
            break;
        
        case 'equipe_disponivel':
            if ($metodo !== 'GET') {
                enviarResposta(['erro' => 'Método não permitido'], 405);
            }
            
            if (empty($_GET['data'])) {
                enviarResposta(['erro' => 'Data é obrigatória'], 400);
            }
            
            $equipe = Equipe::disponiveis($_GET['data']);
            enviarResposta(['sucesso' => true, 'dados' => $equipe]);
            break;
        
        // ==========================================
        // CLIENTES
        // ==========================================
        
        case 'buscar_cliente':
            if ($metodo !== 'GET') {
                enviarResposta(['erro' => 'Método não permitido'], 405);
            }
            
            if (empty($_GET['telefone'])) {
                enviarResposta(['erro' => 'Telefone é obrigatório'], 400);
            }
            
            $cliente = Cliente::buscarPorTelefone($_GET['telefone']);
            
            if ($cliente) {
                enviarResposta(['sucesso' => true, 'dados' => $cliente]);
            } else {
                enviarResposta(['sucesso' => false, 'mensagem' => 'Cliente não encontrado']);
            }
            break;
        
        // ==========================================
        // ESTATÍSTICAS
        // ==========================================
        
        case 'estatisticas':
            if ($metodo !== 'GET') {
                enviarResposta(['erro' => 'Método não permitido'], 405);
            }
            
            $mes = $_GET['mes'] ?? null;
            $ano = $_GET['ano'] ?? null;
            
            $stats = Agendamento::estatisticas($mes, $ano);
            enviarResposta(['sucesso' => true, 'dados' => $stats]);
            break;
        
        default:
            enviarResposta(['erro' => 'Ação não especificada'], 400);
    }
    
} catch (Exception $e) {
    if (DEBUG_MODE) {
        enviarResposta(['erro' => $e->getMessage()], 500);
    } else {
        enviarResposta(['erro' => 'Erro interno do servidor'], 500);
    }
}
