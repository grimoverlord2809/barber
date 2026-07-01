-- ================================================
-- BANCO DE DADOS: barbearia
-- Barbearia Premium - Sistema de Gestão
-- Padrão: tb_tabela | idTabela
-- ================================================

CREATE DATABASE IF NOT EXISTS barbearia
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE barbearia;

-- ================================================
-- TABELA: tb_cliente
-- ================================================
CREATE TABLE IF NOT EXISTS tb_cliente (
    idCliente INT AUTO_INCREMENT PRIMARY KEY,
    nomeCliente VARCHAR(100) NOT NULL,
    emailCliente VARCHAR(150) UNIQUE,
    telefoneCliente VARCHAR(20) NOT NULL,
    cpfCliente VARCHAR(14) UNIQUE,
    dataNascimentoCliente DATE,
    observacoesCliente TEXT,
    criadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_telefone (telefoneCliente),
    INDEX idx_email (emailCliente)
) ENGINE=InnoDB;

-- ================================================
-- TABELA: tb_servico
-- ================================================
CREATE TABLE IF NOT EXISTS tb_servico (
    idServico INT AUTO_INCREMENT PRIMARY KEY,
    nomeServico VARCHAR(100) NOT NULL,
    descricaoServico TEXT,
    precoServico DECIMAL(10, 2) NOT NULL,
    duracaoServico INT NOT NULL DEFAULT 30,
    ativoServico BOOLEAN DEFAULT TRUE,
    criadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_ativo (ativoServico)
) ENGINE=InnoDB;

-- ================================================
-- TABELA: tb_equipe (barbeiros)
-- ================================================
CREATE TABLE IF NOT EXISTS tb_equipe (
    idEquipe INT AUTO_INCREMENT PRIMARY KEY,
    nomeEquipe VARCHAR(100) NOT NULL,
    especialidadeEquipe VARCHAR(100),
    bioEquipe TEXT,
    fotoEquipe VARCHAR(255),
    ativoEquipe BOOLEAN DEFAULT TRUE,
    criadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_ativo (ativoEquipe)
) ENGINE=InnoDB;

-- ================================================
-- TABELA: tb_horario_funcionamento
-- ================================================
CREATE TABLE IF NOT EXISTS tb_horario_funcionamento (
    idHorario INT AUTO_INCREMENT PRIMARY KEY,
    diaSemanaHorario TINYINT NOT NULL COMMENT '0=Domingo, 1=Segunda, ..., 6=Sabado',
    horaAberturaHorario TIME NOT NULL,
    horaFechamentoHorario TIME NOT NULL,
    ativoHorario BOOLEAN DEFAULT TRUE,
    
    UNIQUE KEY uk_dia_semana (diaSemanaHorario),
    INDEX idx_dia_semana (diaSemanaHorario)
) ENGINE=InnoDB;

-- ================================================
-- TABELA: tb_agendamento
-- ================================================
CREATE TABLE IF NOT EXISTS tb_agendamento (
    idAgendamento INT AUTO_INCREMENT PRIMARY KEY,
    idClienteAgendamento INT NOT NULL,
    idServicoAgendamento INT NOT NULL,
    idEquipeAgendamento INT NOT NULL,
    dataAgendamento DATE NOT NULL,
    horaInicioAgendamento TIME NOT NULL,
    horaFimAgendamento TIME NOT NULL,
    statusAgendamento ENUM('agendado', 'confirmado', 'em_andamento', 'concluido', 'cancelado') DEFAULT 'agendado',
    observacoesAgendamento TEXT,
    criadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (idClienteAgendamento) REFERENCES tb_cliente(idCliente) ON DELETE CASCADE,
    FOREIGN KEY (idServicoAgendamento) REFERENCES tb_servico(idServico) ON DELETE RESTRICT,
    FOREIGN KEY (idEquipeAgendamento) REFERENCES tb_equipe(idEquipe) ON DELETE RESTRICT,
    
    INDEX idx_data (dataAgendamento),
    INDEX idx_status (statusAgendamento),
    INDEX idx_barbeiro_data (idEquipeAgendamento, dataAgendamento),
    INDEX idx_cliente (idClienteAgendamento)
) ENGINE=InnoDB;

-- ================================================
-- TABELA: tb_mensagem_contato
-- ================================================
CREATE TABLE IF NOT EXISTS tb_mensagem_contato (
    idMensagem INT AUTO_INCREMENT PRIMARY KEY,
    nomeMensagem VARCHAR(100) NOT NULL,
    emailMensagem VARCHAR(150) NOT NULL,
    telefoneMensagem VARCHAR(20),
    assuntoMensagem VARCHAR(200) NOT NULL,
    mensagemContato TEXT NOT NULL,
    lidaMensagem BOOLEAN DEFAULT FALSE,
    criadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    INDEX idx_lida (lidaMensagem),
    INDEX idx_criado (criadoEm)
) ENGINE=InnoDB;

-- ================================================
-- TABELA: tb_avaliacao
-- ================================================
CREATE TABLE IF NOT EXISTS tb_avaliacao (
    idAvaliacao INT AUTO_INCREMENT PRIMARY KEY,
    idAgendamentoAvaliacao INT NOT NULL,
    idClienteAvaliacao INT NOT NULL,
    idEquipeAvaliacao INT NOT NULL,
    notaAvaliacao TINYINT NOT NULL CHECK (notaAvaliacao BETWEEN 1 AND 5),
    comentarioAvaliacao TEXT,
    criadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (idAgendamentoAvaliacao) REFERENCES tb_agendamento(idAgendamento) ON DELETE CASCADE,
    FOREIGN KEY (idClienteAvaliacao) REFERENCES tb_cliente(idCliente) ON DELETE CASCADE,
    FOREIGN KEY (idEquipeAvaliacao) REFERENCES tb_equipe(idEquipe) ON DELETE CASCADE,
    
    INDEX idx_barbeiro (idEquipeAvaliacao),
    INDEX idx_nota (notaAvaliacao)
) ENGINE=InnoDB;

-- ================================================
-- TABELA: tb_usuario (painel admin)
-- ================================================
CREATE TABLE IF NOT EXISTS tb_usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nomeUsuario VARCHAR(100) NOT NULL,
    emailUsuario VARCHAR(150) NOT NULL UNIQUE,
    senhaUsuario VARCHAR(255) NOT NULL,
    nivelUsuario ENUM('admin', 'funcionario') DEFAULT 'funcionario',
    ativoUsuario BOOLEAN DEFAULT TRUE,
    criadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ultimoAcesso TIMESTAMP NULL,
    
    INDEX idx_email (emailUsuario),
    INDEX idx_nivel (nivelUsuario)
) ENGINE=InnoDB;

-- ================================================
-- DADOS INICIAIS
-- ================================================

-- Serviços
INSERT INTO tb_servico (nomeServico, descricaoServico, precoServico, duracaoServico) VALUES
('Corte Masculino', 'Cortes modernos e personalizados para seu estilo', 30.00, 30),
('Barba', 'Barba feita com acabamento perfeito e toalha quente', 20.00, 20),
('Corte + Barba', 'O pacote completo para seu visual impecável', 45.00, 45),
('Pigmentação', 'Pigmentação capilar para cobertura de fios brancos', 25.00, 40),
('Hidratação', 'Hidratação capilar para fios saudáveis e brilhantes', 35.00, 30),
('Corte Infantil', 'Corte especial para os pequenos com muito carinho', 25.00, 25);

-- Equipe
INSERT INTO tb_equipe (nomeEquipe, especialidadeEquipe, bioEquipe) VALUES
('João Silva', 'Especialista em Degradê', '10 anos de experiência em cortes modernos'),
('Carlos Oliveira', 'Especialista em Barba', 'Mestre na arte da barba e acabamento'),
('Pedro Santos', 'Cortes Modernos', 'Criativo e sempre atualizado nas tendências');

-- Horários de funcionamento
INSERT INTO tb_horario_funcionamento (diaSemanaHorario, horaAberturaHorario, horaFechamentoHorario) VALUES
(0, '00:00:00', '00:00:00'),  -- Domingo - Fechado
(1, '09:00:00', '20:00:00'),  -- Segunda
(2, '09:00:00', '20:00:00'),  -- Terça
(3, '09:00:00', '20:00:00'),  -- Quarta
(4, '09:00:00', '20:00:00'),  -- Quinta
(5, '09:00:00', '20:00:00'),  -- Sexta
(6, '09:00:00', '18:00:00');  -- Sábado

-- Usuário admin padrão (senha: admin123)
INSERT INTO tb_usuario (nomeUsuario, emailUsuario, senhaUsuario, nivelUsuario) VALUES
('Administrador', 'admin@barbearia.com', '$2y$10$YourHashedPasswordHere', 'admin');

-- ================================================
-- VIEWS ÚTEIS
-- ================================================

-- View: Agendamentos com detalhes completos
CREATE OR REPLACE VIEW vw_agendamento_completo AS
SELECT 
    a.idAgendamento,
    c.nomeCliente,
    c.telefoneCliente,
    s.nomeServico,
    s.precoServico,
    e.nomeEquipe,
    a.dataAgendamento,
    a.horaInicioAgendamento,
    a.horaFimAgendamento,
    a.statusAgendamento,
    a.observacoesAgendamento,
    a.criadoEm
FROM tb_agendamento a
INNER JOIN tb_cliente c ON a.idClienteAgendamento = c.idCliente
INNER JOIN tb_servico s ON a.idServicoAgendamento = s.idServico
INNER JOIN tb_equipe e ON a.idEquipeAgendamento = e.idEquipe;

-- View: Faturamento por dia
CREATE OR REPLACE VIEW vw_faturamento_diario AS
SELECT 
    dataAgendamento AS dataFaturamento,
    COUNT(*) AS totalAgendamentos,
    SUM(s.precoServico) AS faturamentoTotal
FROM tb_agendamento a
INNER JOIN tb_servico s ON a.idServicoAgendamento = s.idServico
WHERE a.statusAgendamento = 'concluido'
GROUP BY dataAgendamento;

-- View: Avaliações por barbeiro
CREATE OR REPLACE VIEW vw_avaliacao_barbeiro AS
SELECT 
    e.nomeEquipe AS barbeiro,
    COUNT(av.idAvaliacao) AS totalAvaliacoes,
    ROUND(AVG(av.notaAvaliacao), 1) AS mediaNota
FROM tb_avaliacao av
INNER JOIN tb_equipe e ON av.idEquipeAvaliacao = e.idEquipe
GROUP BY e.idEquipe, e.nomeEquipe;

-- ================================================
-- PROCEDURES
-- ================================================

-- Procedure: Verificar disponibilidade de horário
DELIMITER //
CREATE PROCEDURE sp_verificar_disponibilidade(
    IN p_idEquipe INT,
    IN p_data DATE,
    IN p_horaInicio TIME
)
BEGIN
    DECLARE v_count INT;
    
    SELECT COUNT(*) INTO v_count
    FROM tb_agendamento
    WHERE idEquipeAgendamento = p_idEquipe
      AND dataAgendamento = p_data
      AND horaInicioAgendamento = p_horaInicio
      AND statusAgendamento NOT IN ('cancelado');
    
    SELECT v_count AS ocupado, 
           CASE WHEN v_count = 0 THEN 'Disponível' ELSE 'Ocupado' END AS situacao;
END //
DELIMITER ;

-- Procedure: Cancelar agendamento
DELIMITER //
CREATE PROCEDURE sp_cancelar_agendamento(
    IN p_idAgendamento INT
)
BEGIN
    UPDATE tb_agendamento 
    SET statusAgendamento = 'cancelado',
        atualizadoEm = CURRENT_TIMESTAMP
    WHERE idAgendamento = p_idAgendamento;
    
    SELECT ROW_COUNT() AS linhasAfetadas;
END //
DELIMITER ;

-- ================================================
-- TRIGGERS
-- ================================================

-- Trigger: Atualizar horário_fim automaticamente
DELIMITER //
CREATE TRIGGER trg_calcular_hora_fim
BEFORE INSERT ON tb_agendamento
FOR EACH ROW
BEGIN
    DECLARE v_duracao INT;
    
    SELECT duracaoServico INTO v_duracao
    FROM tb_servico
    WHERE idServico = NEW.idServicoAgendamento;
    
    SET NEW.horaFimAgendamento = ADDTIME(NEW.horaInicioAgendamento, SEC_TO_TIME(v_duracao * 60));
END //
DELIMITER ;

-- ================================================
-- FIM DO SCRIPT
-- ================================================
