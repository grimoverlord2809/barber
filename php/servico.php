<?php
/**
 * CRUD - Serviços
 * Barbearia Premium
 * Padrão: tb_servico | idServico
 */

require_once __DIR__ . '/conexao.php';

class Servico {
    
    /**
     * Listar todos os serviços
     */
    public static function listar($apenasAtivos = true) {
        $db = getDB();
        
        $sql = "SELECT * FROM tb_servico";
        if ($apenasAtivos) {
            $sql .= " WHERE ativoServico = 1";
        }
        $sql .= " ORDER BY nomeServico ASC";
        
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }
    
    /**
     * Buscar serviço por ID
     */
    public static function buscarPorId($id) {
        $db = getDB();
        $sql = "SELECT * FROM tb_servico WHERE idServico = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetch();
    }
    
    /**
     * Criar novo serviço
     */
    public static function criar($dados) {
        $db = getDB();
        
        $sql = "INSERT INTO tb_servico (nomeServico, descricaoServico, precoServico, duracaoServico, ativoServico) 
                VALUES (:nome, :descricao, :preco, :duracao, :ativo)";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':nome'     => $dados['nome'],
            ':descricao'=> $dados['descricao'] ?? null,
            ':preco'    => $dados['preco'],
            ':duracao'  => $dados['duracao'] ?? 30,
            ':ativo'    => $dados['ativo'] ?? 1,
        ]);
        
        return $db->lastInsertId();
    }
    
    /**
     * Atualizar serviço
     */
    public static function atualizar($id, $dados) {
        $db = getDB();
        
        $sql = "UPDATE tb_servico SET 
                    nomeServico = :nome,
                    descricaoServico = :descricao,
                    precoServico = :preco,
                    duracaoServico = :duracao,
                    ativoServico = :ativo
                WHERE idServico = :id";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id'       => $id,
            ':nome'     => $dados['nome'],
            ':descricao'=> $dados['descricao'] ?? null,
            ':preco'    => $dados['preco'],
            ':duracao'  => $dados['duracao'] ?? 30,
            ':ativo'    => $dados['ativo'] ?? 1,
        ]);
        
        return $stmt->rowCount() > 0;
    }
    
    /**
     * Excluir serviço (desativar)
     */
    public static function excluir($id) {
        $db = getDB();
        
        $sql = "UPDATE tb_servico SET ativoServico = 0 WHERE idServico = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->rowCount() > 0;
    }
    
    /**
     * Listar serviços mais procurados
     */
    public static function maisProcurados($limite = 5) {
        $db = getDB();
        
        $sql = "SELECT s.*, COUNT(a.idAgendamento) as totalAgendamentos
                FROM tb_servico s
                LEFT JOIN tb_agendamento a ON s.idServico = a.idServicoAgendamento
                WHERE s.ativoServico = 1
                GROUP BY s.idServico
                ORDER BY totalAgendamentos DESC
                LIMIT :limite";
        
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
