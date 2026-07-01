<?php 
/**
 * ============================================================
 * ARQUIVO: equipe_vw.php (views/equipe/equipe_vw.php)
 * FUNÇÃO: Página da equipe de profissionais
 * DESCRIÇÃO: Apresenta os barbeiros da equipe com fotos,
 *            nomes, especialidades e experiências
 * ============================================================
 */

// ============================================================
// CONFIGURAÇÃO DA PÁGINA
// ============================================================

$pageTitle = 'Equipe - Barber Book'; // Título para SEO e aba do navegador
$meta_description = 'Conheça nossa equipe de profissionais'; // Meta descrição para buscadores
$activePage = 'equipe'; // Identificador da página ativa no menu

// ============================================================
// INCLUSÃO DOS TEMPLATES COMUNS
// ============================================================

require_once __DIR__ . '/../template/head_Vw.php';    // Cabeçalho HTML
require_once __DIR__ . '/../template/header_vw.php';  // Menu de navegação

// ============================================================
// SEÇÃO DA EQUIPE
// ============================================================
?>

<section class="equipe" style="margin-top: 80px;"> <!-- Seção com margem para header fixo -->
    <div class="container"> <!-- Container centralizado -->
        
        <!-- Título da seção -->
        <div class="section-title">
            <h2>Nossa Equipe</h2> <!-- Título principal -->
            <p>Profissionais qualificados e apaixonados pelo que fazem</p> <!-- Subtítulo -->
        </div>

        <!-- Grid de cards com os membros da equipe -->
        <div class="cards">

            <!-- MEMBRO 1: JOÃO SILVA -->
            <div class="card card-membro"> <!-- Card com classe extra para estilização de equipe -->
                <div class="avatar-icon"> <!-- Ícone de avatar (foto padrão) -->
                    <!-- SVG representando pessoa/usuário -->
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <h3>João Silva</h3> <!-- Nome do profissional -->
                <p class="cargo">Especialista em Degradê</p> <!-- Cargo/especialidade -->
                <p>10 anos de experiência em cortes modernos</p> <!-- Breve descrição -->
            </div>

            <!-- MEMBRO 2: CARLOS OLIVEIRA -->
            <div class="card card-membro">
                <div class="avatar-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <h3>Carlos Oliveira</h3>
                <p class="cargo">Especialista em Barba</p>
                <p>Mestre na arte da barba e acabamento</p>
            </div>

            <!-- MEMBRO 3: PEDRO SANTOS -->
            <div class="card card-membro">
                <div class="avatar-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <h3>Pedro Santos</h3>
                <p class="cargo">Cortes Modernos</p>
                <p>Criativo e sempre atualizado nas tendências</p>
            </div>

        </div> <!-- Fim do grid de cards -->
    </div> <!-- Fim do container -->
</section> <!-- Fim da seção da equipe -->

<?php
// ============================================================
// INCLUSÃO DOS TEMPLATES FINAIS
// ============================================================

require_once __DIR__ . '/../template/footer_vw.php';  // Rodapé
require_once __DIR__ . '/../template/aside_vw.php';   // WhatsApp flutuante + JS
