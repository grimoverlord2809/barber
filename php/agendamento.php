<?php
/**
 * CRUD - Agendamentos
 * Barbearia Premium
 * Padrão: tb_agendamento | idAgendamento
 */

require_once __DIR__ . '/conexao.php';

class Agendamento {
    
    /**
     * Listar agendamentos
     */
    public static function listar($filtros = []) {
        $db = getDB();
        
        $sql = "SELECT a.*, 
                       c.nomeCliente, 
                       c.telefoneCliente,
                       s.nomeServico, 
                       s.precoServico,
                       e.nomeEquipe
                FROM tb_agendamento a
                INNER JOIN tb_cliente c ON a.idClienteAgendamento = c.idCliente
                INNER JOIN tb_servico s ON a.idServicoAgendamento = s.idServico
                INNER JOIN tb_equipe e ON a.idEquipeAgendamento = e.idEquipe
                WHERE 1=1";
        
        $params = [];
        
        if (!empty($filtros['data'])) {
            $sql .= " AND a.dataAgendamento = :data";
            $params[':data'] = $filtros['data'];
        }
        
        if (!empty($filtros['barbeiro_id'])) {
            $sql .= " AND a.idEquipeAgendamento = :barbeiro_id";
            $params[':barbeiro_id'] = $filtros['barbeiro_id'];
        }
        
        if (!empty($filtros['status'])) {
            $sql .= " AND a.statusAgendamento = :status";
            $params[':status'] = $filtros['status'];
        }
        
        if (!empty($filtros['cliente_id'])) {
            $sql .= " AND a.idClienteAgendamento = :cliente_id";
            $params[':cliente_id'] = $filtros['cliente_id'];
        }
        
        $sql .= " ORDER BY a.dataAgendamento DESC, a.horaInicioAgendamento ASC";
        
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll();
    }
    
    /**
     * Buscar agendamento por ID
     */
    public static function buscarPorId($id) {
        $db = getDB();
        
        $sql = "SELECT a.*, 
                       c.nomeCliente, 
                       c.telefoneCliente,
                       s.nomeServico, 
                       s.precoServico,
                       s.duracaoServico,
                       e.nomeEquipe
                FROM tb_agendamento a
                INNER JOIN tb_cliente c ON a.idClienteAgendamento = c.idCliente
                INNER JOIN tb_servico s ON a.idServicoAgendamento = s.idServico
                INNER JOIN tb_equipe e ON a.idEquipeAgendamento = e.idEquipe
                WHERE a.idAgendamento = :id";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetch();
    }
    
    /**
     * Criar novo agendamento
     */
    public static function criar($dados) {
        $db = getDB();
        
        // Verificar disponibilidade
        if (!self::verificarDisponibilidade($dados['barbeiro_id'], $dados['data_agendamento'], $dados['hora_inicio'])) {
            return ['erro' => 'Horário já ocupado'];
        }
        
        // Buscar duração do serviço
        $servico = Servico::buscarPorId($dados['servico_id']);
        if (!$servico) {
            return ['erro' => 'Serviço não encontrado'];
        }
        
        // Calcular hora_fim
        $hora_inicio = strtotime($dados['hora_inicio']);
        $hora_fim = date('H:i:s', $hora_inicio + ($servico['duracaoServico'] * 60));
        
        $sql = "INSERT INTO tb_agendamento (idClienteAgendamento, idServicoAgendamento, idEquipeAgendamento, dataAgendamento, horaInicioAgendamento, horaFimAgendamento, observacoesAgendamento) 
                VALUES (:cliente_id, :servico_id, :barbeiro_id, :data, :hora_inicio, :hora_fim, :observacoes)";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':cliente_id'   => $dados['cliente_id'],
            ':servico_id'   => $dados['servico_id'],
            ':barbeiro_id'  => $dados['barbeiro_id'],
            ':data'         => $dados['data_agendamento'],
            ':hora_inicio'  => $dados['hora_inicio'],
            ':hora_fim'     => $hora_fim,
            ':observacoes'  => $dados['observacoes'] ?? null,
        ]);
        
        return ['sucesso' => true, 'id' => $db->lastInsertId()];
    }
    
    /**
     * Atualizar status do agendamento
     */
    public static function atualizarStatus($id, $status) {
        $db = getDB();
        
        $sql = "UPDATE tb_agendamento SET statusAgendamento = :status WHERE idAgendamento = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':status' => $status]);
        
        return $stmt->rowCount() > 0;
    }
    
    /**
     * Cancelar agendamento
     */
    public static function cancelar($id) {
        return self::atualizarStatus($id, 'cancelado');
    }
    
    /**
     * Confirmar agendamento
     */
    public static function confirmar($id) {
        return self::atualizarStatus($id, 'confirmado');
    }
    
    /**
     * Iniciar atendimento
     */
    public static function iniciar($id) {
        return self::atualizarStatus($id, 'em_andamento');
    }
    
    /**
     * Concluir agendamento
     */
    public static function concluir($id) {
        return self::atualizarStatus($id, 'concluido');
    }
    
    /**
     * Verificar disponibilidade de horário
     */
    public static function verificarDisponibilidade($barbeiroId, $data, $horaInicio) {
        $db = getDB();
        
        $sql = "SELECT COUNT(*) as total
                FROM tb_agendamento
                WHERE idEquipeAgendamento = :barbeiro_id
                  AND dataAgendamento = :data
                  AND horaInicioAgendamento = :hora_inicio
                  AND statusAgendamento NOT IN ('cancelado')";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':barbeiro_id' => $barbeiroId,
            ':data'        => $data,
            ':hora_inicio' => $horaInicio,
        ]);
        
        $result = $stmt->fetch();
        return $result['total'] == 0;
    }
    
    /**
     * Listar horários disponíveis para uma data
     */
    public static function horariosDisponiveis($barbeiroId, $data) {
        $db = getDB();
        
        // Buscar horários ocupados
        $sql = "SELECT horaInicioAgendamento, horaFimAgendamento 
                FROM tb_agendamento
                WHERE idEquipeAgendamento = :barbeiro_id
                  AND dataAgendamento = :data
                  AND statusAgendamento NOT IN ('cancelado')";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([':barbeiro_id' => $barbeiroId, ':data' => $data]);
        $ocupados = $stmt->fetchAll();
        
        // Horários padrão (9h às 20h, intervalos de 30min)
        $horarios = [];
        for ($hora = 9; $hora < 20; $hora++) {
            $horarios[] = sprintf('%02d:00', $hora);
            $horarios[] = sprintf('%02d:30', $hora);
        }
        
        // Remover horários ocupados
        foreach ($ocupados as $ocupado) {
            $inicio = date('H:i', strtotime($ocupado['horaInicioAgendamento']));
            $fim = date('H:i', strtotime($ocupado['horaFimAgendamento']));
            
            $horarios = array_filter($horarios, function($h) use ($inicio, $fim) {
                return $h < $inicio || $h >= $fim;
            });
        }
        
        return array_values($horarios);
    }
    
    /**
     * Agendamentos do dia
     */
    public static function doDia($data = null) {
        if (!$data) {
            $data = date('Y-m-d');
        }
        
        return self::listar(['data' => $data]);
    }
    
    /**
     * Estatísticas do mês
     */
    public static function estatisticas($mes = null, $ano = null) {
        $db = getDB();
        
        if (!$mes) $mes = date('m');
        if (!$ano) $ano = date('Y');
        
        $sql = "SELECT 
                    COUNT(*) as totalAgendamentos,
                    SUM(CASE WHEN statusAgendamento = 'concluido' THEN 1 ELSE 0 END) as concluidos,
                    SUM(CASE WHEN statusAgendamento = 'cancelado' THEN 1 ELSE 0 END) as cancelados,
                    SUM(CASE WHEN statusAgendamento = 'agendado' THEN 1 ELSE 0 END) as pendentes,
                    (SELECT SUM(s.precoServico) FROM tb_agendamento a2 
                     INNER JOIN tb_servico s ON a2.idServicoAgendamento = s.idServico
                     WHERE MONTH(a2.dataAgendamento) = :mes 
                     AND YEAR(a2.dataAgendamento) = :ano
                     AND a2.statusAgendamento = 'concluido') as faturamento
                FROM tb_agendamento
                WHERE MONTH(dataAgendamento) = :mes 
                  AND YEAR(dataAgendamento) = :ano";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([':mes' => $mes, ':ano' => $ano]);
        
        return $stmt->fetch();
    }
}
