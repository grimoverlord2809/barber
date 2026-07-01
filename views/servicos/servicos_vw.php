<?php 
/**
 * ============================================================
 * ARQUIVO: servicos_vw.php (views/servicos/servicos_vw.php)
 * FUNÇÃO: Página de serviços detalhados
 * DESCRIÇÃO: Lista todos os 6 serviços oferecidos pela barbearia
 *            com preços e descrições completas
 * ============================================================
 */

// ============================================================
// CONFIGURAÇÃO DA PÁGINA
// ============================================================

$pageTitle = 'Serviços - Barber Book'; // Título para SEO e aba do navegador
$meta_description = 'Conheça nossos serviços de barbearia'; // Meta descrição para buscadores
$activePage = 'servicos'; // Identificador da página ativa no menu

// ============================================================
// INCLUSÃO DOS TEMPLATES COMUNS
// ============================================================

require_once __DIR__ . '/../template/head_Vw.php';    // Cabeçalho HTML
require_once __DIR__ . '/../template/header_vw.php';  // Menu de navegação

// ============================================================
// SEÇÃO DE SERVIÇOS DETALHADOS
// style="margin-top: 80px" compensa o header fixo
// ============================================================
?>

<section class="servicos" style="margin-top: 80px;"> <!-- Seção com margem para header fixo -->
    <div class="container"> <!-- Container centralizado -->
        
        <!-- Título da seção -->
        <div class="section-title">
            <h2>Nossos Serviços</h2> <!-- Título principal -->
            <p>Qualidade e precisão em cada detalhe</p> <!-- Subtítulo -->
        </div>

        <!-- Grid de cards com todos os serviços -->
        <div class="cards">

            <!-- CARD 1: CORTE MASCULINO -->
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M6 9l6-6 6 6"/><path d="M12 3v14"/><path d="M5 21h14"/></svg> <!-- Tesoura -->
                </div>
                <h3>Corte Masculino</h3>
                <p>Cortes modernos e personalizados para seu estilo</p>
                <span class="preco">R$ 30,00</span>
            </div>

            <!-- CARD 2: BARBA -->
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M3 20l3.5-3.5"/><path d="M14.5 6.5l3 3"/><path d="M17.5 3.5l3 3-12 12-6 2 2-6z"/><path d="M14 7l3 3"/></svg> <!-- Navalha -->
                </div>
                <h3>Barba</h3>
                <p>Barba feita com acabamento perfeito e toalha quente</p>
                <span class="preco">R$ 20,00</span>
            </div>

            <!-- CARD 3: CORTE + BARBA -->
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg> <!-- Estrela -->
                </div>
                <h3>Corte + Barba</h3>
                <p>O pacote completo para seu visual impecável</p>
                <span class="preco">R$ 45,00</span>
            </div>

            <!-- CARD 4: PIGMENTAÇÃO -->
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg> <!-- Info -->
                </div>
                <h3>Pigmentação</h3>
                <p>Pigmentação capilar para cobertura de fios brancos</p>
                <span class="preco">R$ 25,00</span>
            </div>

            <!-- CARD 5: HIDRATAÇÃO -->
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 2.69l5.66 5.66a8 8 0 11-11.31 0z"/></svg> <!-- Gota d'água -->
                </div>
                <h3>Hidratação</h3>
                <p>Hidratação capilar para fios saudáveis e brilhantes</p>
                <span class="preco">R$ 35,00</span>
            </div>

            <!-- CARD 6: CORTE INFANTIL -->
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg> <!-- Pessoa -->
                </div>
                <h3>Corte Infantil</h3>
                <p>Corte especial para os pequenos com muito carinho</p>
                <span class="preco">R$ 25,00</span>
            </div>

        </div> <!-- Fim do grid de cards -->
    </div> <!-- Fim do container -->
</section> <!-- Fim da seção de serviços -->

<?php
// ============================================================
// INCLUSÃO DOS TEMPLATES FINAIS
// ============================================================

require_once __DIR__ . '/../template/footer_vw.php';  // Rodapé
require_once __DIR__ . '/../template/aside_vw.php';   // WhatsApp flutuante + JS
