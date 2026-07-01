# Barber Book - Sistema de Gestão para Barbearia

Sistema completo de gestão para barbearia desenvolvido em **PHP 8.4** com arquitetura **MVC simplificada**, banco de dados **MySQL** e interface **responsiva**.

---

## Índice

1. [Visão Geral](#visão-geral)
2. [Funcionalidades](#funcionalidades)
3. [Estrutura do Projeto](#estrutura-do-projeto)
4. [Requisitos](#requisitos)
5. [Instalação](#instalação)
6. [Configuração do Banco de Dados](#configuração-do-banco-de-dados)
7. [Como Rodar](#como-rodar)
8. [Arquitetura e Padrões](#arquitetura-e-padrões)
9. [Documentação dos Arquivos](#documentação-dos-arquivos)
10. [Banco de Dados](#banco-de-dados)
11. [API REST](#api-rest)
12. [Design e Estilização](#design-e-estilização)
13. [Nomenclatura de Arquivos](#nomenclatura-de-arquivos)
14. [Troubleshooting](#troubleshooting)
15. [Autor](#autor)

---

## Visão Geral

O **Barber Book** é um sistema web para gerenciamento de barbearias que permite:

- Visualização de serviços, equipe e informações da empresa
- Agendamento de horários via formulário integrado ao WhatsApp
- CRUD completo para clientes, serviços, equipe e agendamentos
- API REST para integrações
- Painel administrativo (estrutura preparada)

---

## Funcionalidades

### Páginas Públicas
| Página | Arquivo | Descrição |
|--------|---------|-----------|
| **Início** | `index.php` | Banner principal + serviços em destaque |
| **Serviços** | `views/servicos/servicos_vw.php` | Lista completa de 6 serviços com preços |
| **Equipe** | `views/equipe/equipe_vw.php` | Apresentação dos 3 barbeiros |
| **Sobre** | `views/sobre/sobre_vw.php` | História, missão, visão e valores |
| **Contato** | `views/contato/contato_vw.php` | Endereço, telefone, horários |
| **Agendamento** | `views/agedamento/agendamento_vw.php` | Formulário de agendamento via WhatsApp |

### Backend (PHP)
| Arquivo | Função |
|---------|--------|
| `php/config.php` | Configurações do banco de dados e do sistema |
| `php/conexao.php` | Conexão PDO com MySQL (padrão Singleton) |
| `php/api.php` | API REST para operações CRUD |
| `php/cliente.php` | CRUD de clientes |
| `php/servico.php` | CRUD de serviços |
| `php/equipe.php` | CRUD de equipe (barbeiros) |
| `php/agendamento.php` | CRUD de agendamentos |

### Banco de Dados
| Tabela | Descrição |
|--------|-----------|
| `tb_cliente` | Cadastro de clientes |
| `tb_servico` | Serviços oferecidos |
| `tb_equipe` | Barbeiros da equipe |
| `tb_horario_funcionamento` | Horários de abertura/fechamento |
| `tb_agendamento` | Agendamentos realizados |
| `tb_mensagem_contato` | Mensagens de contato |
| `tb_avaliacao` | Avaliações de clientes |
| `tb_usuario` | Usuários do painel admin |

---

## Estrutura do Projeto

```
bar/
├── index.php                          # Router principal (ponto de entrada)
├── readme.md                          # Esta documentação
│
├── assets/
│   ├── css/
│   │   └── style.css                  # Estilos CSS (797 linhas)
│   └── img/
│       ├── banner.jpg                 # Imagem do banner
│       ├── fundo.jpg                  # Imagem de fundo
│       └── download.jpg               # Imagem auxiliar
│
├── database/
│   ├── barbearia.sql                  # Script SQL completo (298 linhas)
│   └── README.md                      # Documentação do banco
│
├── php/
│   ├── config.php                     # Configurações gerais
│   ├── conexao.php                    # Conexão com o banco (Singleton)
│   ├── api.php                        # API REST endpoints
│   ├── cliente.php                    # CRUD de clientes
│   ├── servico.php                    # CRUD de serviços
│   ├── equipe.php                     # CRUD de equipe
│   └── agendamento.php               # CRUD de agendamentos
│
└── views/
    ├── template/
    │   ├── head_Vw.php               # Template: <head> HTML
    │   ├── header_vw.php             # Template: menu de navegação
    │   ├── footer_vw.php             # Template: rodapé
    │   └── aside_vw.php              # Template: WhatsApp + JS
    │
    ├── home/
    │   └── index_vw.php              # Página inicial
    ├── servicos/
    │   └── servicos_vw.php           # Página de serviços
    ├── equipe/
    │   └── equipe_vw.php             # Página da equipe
    ├── sobre/
    │   └── sobre_vw.php              # Página sobre
    ├── contato/
    │   └── contato_vw.php            # Página de contato
    └── agedamento/
        └── agendamento_vw.php        # Página de agendamento
```

---

## Requisitos

### Servidor
- **PHP** 8.0 ou superior (testado com PHP 8.4.16)
- **MySQL** 5.7+ ou **MariaDB** 10.3+
- **Servidor Web** Apache ou PHP built-in server

### Extensões PHP
- `PDO` e `pdo_mysql` (conexão com banco)
- `json` (API REST)
- `mbstring` (manipulação de strings)

---

## Instalação

### 1. Clonar ou copiar o projeto

```bash
# Copie a pasta 'bar' para o diretório do seu servidor
# Exemplo: C:\Users\SeuNome\Downloads\Processo\bar
```

### 2. Configurar o banco de dados

```bash
# Acesse o MySQL e execute o script SQL
mysql -u root -p < database/barbearia.sql
```

### 3. Configurar as credenciais

Edite o arquivo `php/config.php`:

```php
define('DB_HOST', 'localhost');    // Host do banco
define('DB_NAME', 'barbearia');    // Nome do banco
define('DB_USER', 'root');         // Usuário do banco
define('DB_PASS', '');             // Senha do banco
```

### 4. Iniciar o servidor

```bash
# Navegue até a pasta do projeto
cd bar

# Inicie o servidor PHP embutido
php -S localhost:8000
```

### 5. Acessar o sistema

Abra o navegador e acesse:
```
http://localhost:8000/
```

---

## Configuração do Banco de Dados

### Criação automática

Execute o script `database/barbearia.sql` que cria:

- 8 tabelas com relationships e indexes
- Dados iniciais (serviços, equipe, horários)
- Views para relatórios
- Procedures para verificação de disponibilidade
- Trigger para cálculo automático de hora_fim

### Padrão de nomenclatura

```
Tabelas:  tb_nomeTabela      (ex: tb_cliente, tb_agendamento)
Colunas:  nomeColunaTabela   (ex: idCliente, nomeServico)
```

---

## Como Rodar

### Opção 1: Servidor PHP embutido (desenvolvimento)

```bash
# Na pasta do projeto
php -S localhost:8000

# Acessar: http://localhost:8000/
```

### Opção 2: Apache (produção)

1. Copie a pasta `bar` para `htdocs/` (XAMPP) ou `www/` (WAMP)
2. Inicie Apache e MySQL
3. Acesse `http://localhost/bar/`

### Rotas disponíveis

```
http://localhost:8000/                    → Página inicial
http://localhost:8000/?page=servicos      → Serviços
http://localhost:8000/?page=equipe        → Equipe
http://localhost:8000/?page=sobre         → Sobre
http://localhost:8000/?page=contato       → Contato
http://localhost:8000/?page=agendamento   → Agendamento
```

---

## Arquitetura e Padrões

### Router (index.php)

O sistema usa um router simples baseado no parâmetro `$_GET['page']`:

```php
// URL: ?page=servicos → views/servicos/servicos_vw.php
// URL: ?page=equipe   → views/equipe/equipe_vw.php
// URL: (vazio)        → views/home/index_vw.php
```

### Template Engine (PHP nativo)

Cada página inclui 4 templates comuns:

```php
<?php require_once __DIR__ . '/../template/head_Vw.php'; ?>    // <head>
<?php require_once __DIR__ . '/../template/header_vw.php'; ?>  // Menu
<?php // ... conteúdo da página ... ?>
<?php require_once __DIR__ . '/../template/footer_vw.php'; ?>  // Rodapé
<?php require_once __DIR__ . '/../template/aside_vw.php'; ?>   // WhatsApp + JS
```

### Padrão Singleton (Database)

A conexão com o banco usa Singleton para garantir uma única instância:

```php
$db = Database::getInstance()->getConnection();
// ou
$db = getDB(); // Função auxiliar
```

### CRUD Classes

Cada entidade tem uma classe estática com métodos CRUD:

```php
Cliente::listar();           // Listar todos
Cliente::buscarPorId(1);     // Buscar por ID
Cliente::criar($dados);      // Criar novo
Cliente::atualizar(1, $dados); // Atualizar
Cliente::excluir(1);         // Excluir
```

---

## Documentação dos Arquivos

### Frontend (Views)

| Arquivo | Linhas | Função |
|---------|--------|--------|
| `head_Vw.php` | 13 | Cabeçalho HTML, meta tags, CSS, fontes |
| `header_vw.php` | 24 | Menu de navegação com link ativo dinâmico |
| `footer_vw.php` | 43 | Rodapé com copyright dinâmico |
| `aside_vw.php` | 22 | WhatsApp flutuante + JavaScript do menu |
| `index_vw.php` | 57 | Página inicial (banner + serviços) |
| `servicos_vw.php` | 76 | 6 cards de serviços |
| `equipe_vw.php` | 49 | 3 cards de membros |
| `sobre_vw.php` | 83 | História + 6 valores |
| `contato_vw.php` | 90 | Contato + horários |
| `agendamento_vw.php` | 56 | Formulário de agendamento |

### Backend (PHP)

| Arquivo | Linhas | Função |
|---------|--------|--------|
| `index.php` | 35 | Router principal |
| `config.php` | 31 | Configurações do sistema |
| `conexao.php` | 61 | Conexão PDO (Singleton) |
| `api.php` | 242 | API REST (8 endpoints) |
| `cliente.php` | 163 | CRUD de clientes (8 métodos) |
| `servico.php` | 121 | CRUD de serviços (6 métodos) |
| `equipe.php` | 138 | CRUD de equipe (7 métodos) |
| `agendamento.php` | 264 | CRUD de agendamentos (10 métodos) |

### Banco de Dados

| Arquivo | Linhas | Função |
|---------|--------|--------|
| `barbearia.sql` | 298 | Script completo do banco |

---

## Banco de Dados

### Diagrama de Relacionamentos

```
tb_cliente (1) ──── (N) tb_agendamento (N) ──── (1) tb_servico
                          │
                          └── (N) ──── (1) tb_equipe

tb_agendamento (1) ──── (N) tb_avaliacao
tb_cliente (1) ──── (N) tb_avaliacao
tb_equipe (1) ──── (N) tb_avaliacao
```

### Views SQL

- **vw_agendamento_completo** → Agendamentos com dados do cliente, serviço e barbeiro
- **vw_faturamento_diario** → Faturamento total por dia
- **vw_avaliacao_barbeiro** → Média de notas por barbeiro

### Procedures

- **sp_verificar_disponibilidade** → Verifica se um horário está livre
- **sp_cancelar_agendamento** → Cancela um agendamento

### Trigger

- **trg_calcular_hora_fim** → Calcula automaticamente a hora_fim baseada na duração do serviço

---

## API REST

### Endpoints

| Método | Ação | Descrição |
|--------|------|-----------|
| `GET` | `?acao=listar_agendamentos` | Lista agendamentos com filtros |
| `POST` | `?acao=criar_agendamento` | Cria novo agendamento |
| `POST` | `?acao=cancelar_agendamento` | Cancela um agendamento |
| `GET` | `?acao=horarios_disponiveis` | Horários livres para uma data |
| `GET` | `?acao=listar_servicos` | Lista todos os serviços |
| `GET` | `?acao=listar_equipe` | Lista toda a equipe |
| `GET` | `?acao=equipe_disponivel` | Barbeiros disponíveis em uma data |
| `GET` | `?acao=buscar_cliente` | Busca cliente por telefone |
| `GET` | `?acao=estatisticas` | Estatísticas do mês |

### Exemplo de requisição (criar agendamento)

```bash
curl -X POST "http://localhost:8000/php/api.php?acao=criar_agendamento" \
  -H "Content-Type: application/json" \
  -d '{
    "nome": "João Silva",
    "telefone": "11999998888",
    "servico_id": 1,
    "barbeiro_id": 1,
    "data_agendamento": "2026-06-20",
    "hora_inicio": "10:00"
  }'
```

### Resposta de sucesso

```json
{
  "sucesso": true,
  "mensagem": "Agendamento realizado com sucesso!",
  "id": 1
}
```

---

## Design e Estilização

### Paleta de Cores

| Variável | Cor | Uso |
|----------|-----|-----|
| `--primary` | `#D4AF37` (Dourado) | Botões, links, destaques |
| `--dark` | `#0a0a0a` | Fundo principal |
| `--dark-light` | `#1a1a1a` | Fundo de seções |
| `--gray` | `#2a2a2a` | Cards e formulários |
| `--text` | `#ffffff` | Texto principal |
| `--text-muted` | `#999999` | Texto secundário |

### Fonte

- **Josefin Sans** (Google Fonts)
- Pesos: 300, 400, 600, 700

### Responsividade

| Breakpoint | Comportamento |
|------------|---------------|
| `> 992px` | Menu horizontal completo |
| `≤ 992px` | Menu hambúrguer (mobile) |
| `≤ 768px` | Cards em coluna única |
| `≤ 480px` | Botões e cards menores |

---

## Nomenclatura de Arquivos

### Convenção adotada

```
Arquivo:     nomePagina_vw.php
Exemplo:     servicos_vw.php, equipe_vw.php

Template:    nomeTemplate_vw.php
Exemplo:     header_vw.php, footer_vw.php

Pasta views: nomePagina/
Exemplo:     views/servicos/, views/equipe/
```

### Sufixo `_vw.php`

- **vw** = "view" (visualização)
- Indica que o arquivo é uma página/visualização
- Diferencia dos arquivos de backend (`conexao.php`, `api.php`)

---

## Troubleshooting

### Erro 404 - Página não encontrada

**Causa:** A rota não existe no array de rotas do `index.php`

**Solução:** Verifique se a página está listada no array `$rotas` em `index.php`

### Erro 500 - Erro interno do servidor

**Causa:** Erro de PHP ou conexão com banco

**Solução:**
1. Verifique se o PHP está instalado: `php -v`
2. Ative modo debug em `config.php`: `define('DEBUG_MODE', true);`
3. Verifique as credenciais do banco em `config.php`

### CSS não carrega

**Caminho incorreto:** Verifique se `BASE_URL` está definido corretamente

```php
// Em index.php
define('BASE_URL', '/'); // Para localhost:8000/
```

### Banco de dados não conecta

1. Verifique se o MySQL está rodando
2. Verifique as credenciais em `php/config.php`
3. Execute o script `database/barbearia.sql`

---

## Autor

**Valdeney Sousa Amaral** - Sistema de Gestão para Barbearia

Desenvolvido com PHP 8.4, MySQL e CSS puro.

---

## Licença

Projeto educacional - Todos os direitos reservados.
