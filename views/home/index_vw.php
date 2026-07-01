<?php 
/**
 * ============================================================
 * ARQUIVO: index_vw.php (views/home/index_vw.php)
 * FUNÇÃO: Página inicial do site
 * DESCRIção: Exibe banner principal e cards de serviços em destaque
 * ============================================================
 */

// ============================================================
// CONFIGURAÇÃO DA PÁGINA
// Estas variáveis são usadas pelo template head_Vw.php
// ============================================================

$pageTitle = 'Barber Book - Início'; // Título exibido na aba do navegador e no Google
$meta_description = 'Barbearia Premium - Cortes modernos e atendimento de qualidade'; // Meta descrição para SEO
$activePage = 'inicio'; // Identificador usado no header_vw.php para destacar o link ativo no menu

// ============================================================
// INCLUSÃO DOS TEMPLATES COMUNS
// __DIR__ = diretório atual (views/home/)
// '/../template/' = sobe um nível e entra na pasta template
// ============================================================

require_once __DIR__ . '/../template/head_Vw.php';    // Inclui cabeçalho HTML (<head>)
require_once __DIR__ . '/../template/header_vw.php';  // Inclui menu de navegação (<header>)

// ============================================================
// SEÇÃO BANNER / HERO
// Área de destaque no topo da página com chamada para ação
// ============================================================
?>

<section class="banner"> <!-- Seção de destaque com imagem de fundo e texto sobreposto -->
    <div class="banner-content"> <!-- Conteúdo centralizado do banner -->
        <h2>Seu Estilo Está Aqui</h2> <!-- Título principal de impacto -->
        <p>Cortes modernos e atendimento de qualidade para o homem que valoriza estilo.</p> <!-- Subtítulo descritivo -->
        <!-- Botão de chamada para ação (CTA) que redireciona para a página de agendamento -->
        <a href="?page=agendamento" class="botao">Agendar Horário</a>
    </div>
</section>

<!-- ============================================================
     SEÇÃO DE SERVIÇOS EM DESTAQUE
     Apresenta os 3 principais serviços da barbearia
     ============================================================ -->
<section class="servicos"> <!-- Seção com fundo diferenciado -->
    <div class="container"> <!-- Container para limitar largura e centralizar -->
        
        <!-- Título da seção -->
        <div class="section-title">
            <h2>Nossos Serviços</h2> <!-- Título principal da seção -->
            <p>Oferecemos os melhores serviços para cuidar do seu visual</p> <!-- Descrição -->
        </div>

        <!-- Grid flexível para os cards de serviços -->
        <div class="cards">

            <!-- ============================================================
                 CARD 1: CORTE MASCULINO
                 ============================================================ -->
            <div class="card"> <!-- Card individual do serviço -->
                <div class="card-icon"> <!-- Ícone ilustrativo -->
                    <!-- SVG representando tesoura (corte) -->
                    <svg viewBox="0 0 24 24"><path d="M6 9l6-6 6 6"/><path d="M12 3v14"/><path d="M5 21h14"/></svg>
                </div>
                <h3>Corte Masculino</h3> <!-- Nome do serviço -->
                <p>Cortes modernos e personalizados</p> <!-- Breve descrição -->
                <span class="preco">R$ 30,00</span> <!-- Preço formatado -->
            </div>

            <!-- ============================================================
                 CARD 2: BARBA
                 ============================================================ -->
            <div class="card"> <!-- Card individual do serviço -->
                <div class="card-icon"> <!-- Ícone ilustrativo -->
                    <!-- SVG representando navalha (barba) -->
                    <svg viewBox="0 0 24 24"><path d="M3 20l3.5-3.5"/><path d="M14.5 6.5l3 3"/><path d="M17.5 3.5l3 3-12 12-6 2 2-6z"/><path d="M14 7l3 3"/></svg>
                </div>
                <h3>Barba</h3> <!-- Nome do serviço -->
                <p>Barba feita com acabamento perfeito</p> <!-- Breve descrição -->
                <span class="preco">R$ 20,00</span> <!-- Preço formatado -->
            </div>

            <!-- ============================================================
                 CARD 3: CORTE + BARBA (PACOTE COMPLETO)
                 ============================================================ -->
            <div class="card"> <!-- Card individual do serviço -->
                <div class="card-icon"> <!-- Ícone ilustrativo -->
                    <!-- SVG representando estrela (destaque/pacote premium) -->
                    <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                </div>
                <h3>Corte + Barba</h3> <!-- Nome do serviço -->
                <p>O pacote completo para seu visual</p> <!-- Breve descrição -->
                <span class="preco">R$ 45,00</span> <!-- Preço formatado -->
            </div>

        </div> <!-- Fim do grid de cards -->
    </div> <!-- Fim do container -->
</section> <!-- Fim da seção de serviços -->

<?php
// ============================================================
// INCLUSÃO DOS TEMPLATES FINAIS
// ============================================================

require_once __DIR__ . '/../template/footer_vw.php';  // Inclui rodapé (<footer>)
require_once __DIR__ . '/../template/aside_vw.php';   // Inclui WhatsApp flutuante + JS + </body></html>
