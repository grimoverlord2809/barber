# Banco de Dados - Barbearia Premium

## Padrão de Nomenclatura

| Elemento | Padrão | Exemplo |
|----------|--------|---------|
| Tabelas | `tb_nome_tabela` | `tb_cliente`, `tb_servico` |
| Colunas ID | `idNomeTabela` | `idCliente`, `idServico` |
| Colunas | `nomeColunaTabela` | `nomeCliente`, `precoServico` |

## Estrutura de Pastas

```
bar/
├── database/
│   ├── barbearia.sql      # Script SQL para criar o banco
│   └── README.md          # Esta documentação
├── php/
│   ├── config.php          # Configurações gerais
│   ├── conexao.php         # Conexão com o banco (PDO)
│   ├── cliente.php         # CRUD de clientes
│   ├── servico.php         # CRUD de serviços
│   ├── equipe.php          # CRUD da equipe
│   ├── agendamento.php     # CRUD de agendamentos
│   └── api.php             # API REST para o frontend
```

## Tabelas do Banco de Dados

| Tabela | Descrição | ID Principal |
|--------|-----------|--------------|
| `tb_cliente` | Cadastro dos clientes | `idCliente` |
| `tb_servico` | Serviços oferecidos | `idServico` |
| `tb_equipe` | Barbeiros da equipe | `idEquipe` |
| `tb_horario_funcionamento` | Horário de abertura/fechamento | `idHorario` |
| `tb_agendamento` | Agendamentos realizados | `idAgendamento` |
| `tb_mensagem_contato` | Mensagens do formulário | `idMensagem` |
| `tb_avaliacao` | Avaliações dos clientes | `idAvaliacao` |
| `tb_usuario` | Usuários do painel admin | `idUsuario` |

## Estrutura das Tabelas

### tb_cliente
```sql
- idCliente (INT, PK, AUTO_INCREMENT)
- nomeCliente (VARCHAR 100)
- emailCliente (VARCHAR 150, UNIQUE)
- telefoneCliente (VARCHAR 20)
- cpfCliente (VARCHAR 14, UNIQUE)
- dataNascimentoCliente (DATE)
- observacoesCliente (TEXT)
- criadoEm (TIMESTAMP)
- atualizadoEm (TIMESTAMP)
```

### tb_servico
```sql
- idServico (INT, PK, AUTO_INCREMENT)
- nomeServico (VARCHAR 100)
- descricaoServico (TEXT)
- precoServico (DECIMAL 10,2)
- duracaoServico (INT - minutos)
- ativoServico (BOOLEAN)
- criadoEm (TIMESTAMP)
- atualizadoEm (TIMESTAMP)
```

### tb_equipe
```sql
- idEquipe (INT, PK, AUTO_INCREMENT)
- nomeEquipe (VARCHAR 100)
- especialidadeEquipe (VARCHAR 100)
- bioEquipe (TEXT)
- fotoEquipe (VARCHAR 255)
- ativoEquipe (BOOLEAN)
- criadoEm (TIMESTAMP)
- atualizadoEm (TIMESTAMP)
```

### tb_agendamento
```sql
- idAgendamento (INT, PK, AUTO_INCREMENT)
- idClienteAgendamento (INT, FK → tb_cliente)
- idServicoAgendamento (INT, FK → tb_servico)
- idEquipeAgendamento (INT, FK → tb_equipe)
- dataAgendamento (DATE)
- horaInicioAgendamento (TIME)
- horaFimAgendamento (TIME)
- statusAgendamento (ENUM)
- observacoesAgendamento (TEXT)
- criadoEm (TIMESTAMP)
- atualizadoEm (TIMESTAMP)
```

### tb_usuario
```sql
- idUsuario (INT, PK, AUTO_INCREMENT)
- nomeUsuario (VARCHAR 100)
- emailUsuario (VARCHAR 150, UNIQUE)
- senhaUsuario (VARCHAR 255)
- nivelUsuario (ENUM: admin, funcionario)
- ativoUsuario (BOOLEAN)
- criadoEm (TIMESTAMP)
- ultimoAcesso (TIMESTAMP)
```

## Como Configurar

### 1. Criar o Banco de Dados

```sql
mysql -u root -p < database/barbearia.sql
```

Ou pelo phpMyAdmin:
1. Acesse o phpMyAdmin
2. Clique em "Import"
3. Selecione o arquivo `database/barbearia.sql`
4. Clique em "Executar"

### 2. Configurar Conexão

Edite o arquivo `php/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'barbearia');
define('DB_USER', 'root');
define('DB_PASS', '');
```

## Endpoints da API

| Ação | Método | URL |
|------|--------|-----|
| Listar agendamentos | GET | `api.php?acao=listar_agendamentos` |
| Criar agendamento | POST | `api.php?acao=criar_agendamento` |
| Cancelar agendamento | POST | `api.php?acao=cancelar_agendamento` |
| Horários disponíveis | GET | `api.php?acao=horarios_disponiveis` |
| Listar serviços | GET | `api.php?acao=listar_servicos` |
| Listar equipe | GET | `api.php?acao=listar_equipe` |
| Buscar cliente | GET | `api.php?acao=buscar_cliente` |
| Estatísticas | GET | `api.php?acao=estatisticas` |

## Dados Iniciais

### Serviços (tb_servico)
| Nome | Preço | Duração |
|------|-------|---------|
| Corte Masculino | R$ 30,00 | 30 min |
| Barba | R$ 20,00 | 20 min |
| Corte + Barba | R$ 45,00 | 45 min |
| Pigmentação | R$ 25,00 | 40 min |
| Hidratação | R$ 35,00 | 30 min |
| Corte Infantil | R$ 25,00 | 25 min |

### Equipe (tb_equipe)
| Nome | Especialidade |
|------|---------------|
| João Silva | Especialista em Degradê |
| Carlos Oliveira | Especialista em Barba |
| Pedro Santos | Cortes Modernos |

### Usuário Admin
- **Email:** admin@barbearia.com
- **Senha:** admin123

## Foreign Keys

```
tb_agendamento.idClienteAgendamento  → tb_cliente.idCliente
tb_agendamento.idServicoAgendamento  → tb_servico.idServico
tb_agendamento.idEquipeAgendamento   → tb_equipe.idEquipe
tb_avaliacao.idAgendamentoAvaliacao  → tb_agendamento.idAgendamento
tb_avaliacao.idClienteAvaliacao      → tb_cliente.idCliente
tb_avaliacao.idEquipeAvaliacao       → tb_equipe.idEquipe
```
