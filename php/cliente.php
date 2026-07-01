<?php
/**
 * CRUD - Clientes
 * Barbearia Premium
 * Padrão: tb_cliente | idCliente
 */

require_once __DIR__ . '/conexao.php';

class Cliente {
    
    /**
     * Listar todos os clientes
     */
    public static function listar($busca = null) {
        $db = getDB();
        
        if ($busca) {
            $sql = "SELECT * FROM tb_cliente 
                    WHERE nomeCliente LIKE :busca OR telefoneCliente LIKE :busca OR emailCliente LIKE :busca
                    ORDER BY nomeCliente ASC";
            $stmt = $db->prepare($sql);
            $stmt->execute([':busca' => "%$busca%"]);
        } else {
            $sql = "SELECT * FROM tb_cliente ORDER BY nomeCliente ASC";
            $stmt = $db->query($sql);
        }
        
        return $stmt->fetchAll();
    }
    
    /**
     * Buscar cliente por ID
     */
    public static function buscarPorId($id) {
        $db = getDB();
        $sql = "SELECT * FROM tb_cliente WHERE idCliente = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetch();
    }
    
    /**
     * Buscar cliente por telefone
     */
    public static function buscarPorTelefone($telefone) {
        $db = getDB();
        $sql = "SELECT * FROM tb_cliente WHERE telefoneCliente = :telefone";
        $stmt = $db->prepare($sql);
        $stmt->execute([':telefone' => $telefone]);
        
        return $stmt->fetch();
    }
    
    /**
     * Criar novo cliente
     */
    public static function criar($dados) {
        $db = getDB();
        
        $sql = "INSERT INTO tb_cliente (nomeCliente, emailCliente, telefoneCliente, cpfCliente, dataNascimentoCliente, observacoesCliente) 
                VALUES (:nome, :email, :telefone, :cpf, :data_nascimento, :observacoes)";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':nome'            => $dados['nome'],
            ':email'           => $dados['email'] ?? null,
            ':telefone'        => $dados['telefone'],
            ':cpf'             => $dados['cpf'] ?? null,
            ':data_nascimento' => $dados['data_nascimento'] ?? null,
            ':observacoes'     => $dados['observacoes'] ?? null,
        ]);
        
        return $db->lastInsertId();
    }
    
    /**
     * Atualizar cliente
     */
    public static function atualizar($id, $dados) {
        $db = getDB();
        
        $sql = "UPDATE tb_cliente SET 
                    nomeCliente = :nome,
                    emailCliente = :email,
                    telefoneCliente = :telefone,
                    cpfCliente = :cpf,
                    dataNascimentoCliente = :data_nascimento,
                    observacoesCliente = :observacoes
                WHERE idCliente = :id";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id'              => $id,
            ':nome'            => $dados['nome'],
            ':email'           => $dados['email'] ?? null,
            ':telefone'        => $dados['telefone'],
            ':cpf'             => $dados['cpf'] ?? null,
            ':data_nascimento' => $dados['data_nascimento'] ?? null,
            ':observacoes'     => $dados['observacoes'] ?? null,
        ]);
        
        return $stmt->rowCount() > 0;
    }
    
    /**
     * Excluir cliente
     */
    public static function excluir($id) {
        $db = getDB();
        
        $sql = "DELETE FROM tb_cliente WHERE idCliente = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->rowCount() > 0;
    }
    
    /**
     * Contar total de clientes
     */
    public static function contar() {
        $db = getDB();
        $sql = "SELECT COUNT(*) as total FROM tb_cliente";
        $stmt = $db->query($sql);
        $result = $stmt->fetch();
        
        return $result['total'];
    }
    
    /**
     * Buscar cliente por email
     */
    public static function buscarPorEmail($email) {
        $db = getDB();
        $sql = "SELECT * FROM tb_cliente WHERE emailCliente = :email";
        $stmt = $db->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        return $stmt->fetch();
    }
    
    /**
     * Listar clientes mais frequentes
     */
    public static function maisFrequentes($limite = 10) {
        $db = getDB();
        
        $sql = "SELECT c.*, COUNT(a.idAgendamento) as totalAgendamentos
                FROM tb_cliente c
                LEFT JOIN tb_agendamento a ON c.idCliente = a.idClienteAgendamento
                GROUP BY c.idCliente
                ORDER BY totalAgendamentos DESC
                LIMIT :limite";
        
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
