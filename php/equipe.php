<?php
/**
 * CRUD - Equipe (Barbeiros)
 * Barbearia Premium
 * Padrão: tb_equipe | idEquipe
 */

require_once __DIR__ . '/conexao.php';

class Equipe {
    
    /**
     * Listar toda a equipe
     */
    public static function listar($apenasAtivos = true) {
        $db = getDB();
        
        $sql = "SELECT * FROM tb_equipe";
        if ($apenasAtivos) {
            $sql .= " WHERE ativoEquipe = 1";
        }
        $sql .= " ORDER BY nomeEquipe ASC";
        
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }
    
    /**
     * Buscar membro por ID
     */
    public static function buscarPorId($id) {
        $db = getDB();
        $sql = "SELECT * FROM tb_equipe WHERE idEquipe = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetch();
    }
    
    /**
     * Criar novo membro
     */
    public static function criar($dados) {
        $db = getDB();
        
        $sql = "INSERT INTO tb_equipe (nomeEquipe, especialidadeEquipe, bioEquipe, fotoEquipe, ativoEquipe) 
                VALUES (:nome, :especialidade, :bio, :foto, :ativo)";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':nome'          => $dados['nome'],
            ':especialidade' => $dados['especialidade'] ?? null,
            ':bio'           => $dados['bio'] ?? null,
            ':foto'          => $dados['foto'] ?? null,
            ':ativo'         => $dados['ativo'] ?? 1,
        ]);
        
        return $db->lastInsertId();
    }
    
    /**
     * Atualizar membro
     */
    public static function atualizar($id, $dados) {
        $db = getDB();
        
        $sql = "UPDATE tb_equipe SET 
                    nomeEquipe = :nome,
                    especialidadeEquipe = :especialidade,
                    bioEquipe = :bio,
                    fotoEquipe = :foto,
                    ativoEquipe = :ativo
                WHERE idEquipe = :id";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id'            => $id,
            ':nome'          => $dados['nome'],
            ':especialidade' => $dados['especialidade'] ?? null,
            ':bio'           => $dados['bio'] ?? null,
            ':foto'          => $dados['foto'] ?? null,
            ':ativo'         => $dados['ativo'] ?? 1,
        ]);
        
        return $stmt->rowCount() > 0;
    }
    
    /**
     * Excluir membro (desativar)
     */
    public static function excluir($id) {
        $db = getDB();
        
        $sql = "UPDATE tb_equipe SET ativoEquipe = 0 WHERE idEquipe = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->rowCount() > 0;
    }
    
    /**
     * Listar barbeiros disponíveis em uma data
     */
    public static function disponiveis($data) {
        $db = getDB();
        
        $sql = "SELECT e.* FROM tb_equipe e
                WHERE e.ativoEquipe = 1
                AND e.idEquipe NOT IN (
                    SELECT a.idEquipeAgendamento 
                    FROM tb_agendamento a
                    WHERE a.dataAgendamento = :data
                    AND a.statusAgendamento NOT IN ('cancelado')
                )
                ORDER BY e.nomeEquipe ASC";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([':data' => $data]);
        
        return $stmt->fetchAll();
    }
    
    /**
     * Obter avaliações do barbeiro
     */
    public static function avaliacoes($barbeiroId) {
        $db = getDB();
        
        $sql = "SELECT AVG(notaAvaliacao) as mediaNota, COUNT(*) as totalAvaliacoes
                FROM tb_avaliacao
                WHERE idEquipeAvaliacao = :barbeiro_id";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([':barbeiro_id' => $barbeiroId]);
        
        return $stmt->fetch();
    }
}
