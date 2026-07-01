<?php 
/**
 * ============================================================
 * ARQUIVO: sobre_vw.php (views/sobre/sobre_vw.php)
 * FUNÇÃO: Página "Sobre Nós"
 * DESCRIÇÃO: Apresenta a história, missão, visão e valores
 *            da barbearia Barber Book
 * ============================================================
 */

// ============================================================
// CONFIGURAÇÃO DA PÁGINA
// ============================================================

$pageTitle = 'Sobre - Barber Book'; // Título para SEO e aba do navegador
$meta_description = 'Conheça a história da Barber Book'; // Meta descrição para buscadores
$activePage = 'sobre'; // Identificador da página ativa no menu

// ============================================================
// INCLUSÃO DOS TEMPLATES COMUNS
// ============================================================

require_once __DIR__ . '/../template/head_Vw.php';    // Cabeçalho HTML
require_once __DIR__ . '/../template/header_vw.php';  // Menu de navegação

// ============================================================
// SEÇÃO SOBRE A EMPRESA
// ============================================================
?>

<section class="sobre" style="margin-top: 80px;"> <!-- Seção com margem para header fixo -->
    <div class="container"> <!-- Container centralizado -->
        
        <!-- Título da seção -->
        <div class="section-title">
            <h2>Sobre Nós</h2> <!-- Título principal -->
        </div>

        <!-- Conteúdo descritivo da empresa -->
        <div class="sobre-content">

            <!-- Parágrafo 1: História da empresa -->
            <p>
                A <strong>Barber Book</strong> nasceu com a missão de proporcionar estilo, conforto e atendimento 
                de excelência para seus clientes. Fundada em 2020, tornou-se referência em cuidados 
                masculinos na região.
            </p>

            <!-- Parágrafo 2: Filosofia e valores -->
            <p>
                Acreditamos que cada homem merece se sentir confiante e bem-consigo mesmo. 
                Por isso, investimos constantemente em capacitação profissional e em um ambiente 
                aconchegante e moderno.
            </p>

            <!-- ============================================================
                 GRID DE VALORES DA EMPRESA
                 6 valores fundamentais organizados em grid responsivo
                 ============================================================ -->
            <div class="valores">

                <!-- VALOR 1: MISSÃO -->
                <div class="valor-item">
                    <div class="valor-icon">
                        <!-- Ícone SVG: rosto sorrindo (felizidade/satisfação) -->
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                    </div>
                    <h4>Missão</h4> <!-- Título do valor -->
                    <p>Oferecer serviços de qualidade e superar as expectativas dos nossos clientes.</p>
                </div>

                <!-- VALOR 2: VISÃO -->
                <div class="valor-item">
                    <div class="valor-icon">
                        <!-- Ícone SVG: globo (visão global/amplo alcance) -->
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
                    </div>
                    <h4>Visão</h4>
                    <p>Ser referência em cuidados masculinos e moda masculina.</p>
                </div>

                <!-- VALOR 3: QUALIDADE -->
                <div class="valor-item">
                    <div class="valor-icon">
                        <!-- Ícone SVG: check/sucesso (qualidade aprovada) -->
                        <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h4>Qualidade</h4>
                    <p>Excelência em cada serviço prestado.</p>
                </div>

                <!-- VALOR 4: RESPEITO -->
                <div class="valor-item">
                    <div class="valor-icon">
                        <!-- Ícone SVG: grupo de pessoas (respeito mútuo) -->
                        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                    </div>
                    <h4>Respeito</h4>
                    <p>Tratar cada cliente com cordialidade e profissionalismo.</p>
                </div>

                <!-- VALOR 5: PONTUALIDADE -->
                <div class="valor-item">
                    <div class="valor-icon">
                        <!-- Ícone SVG: relógio (pontualidade/tempo) -->
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h4>Pontualidade</h4>
                    <p>Valorizar o tempo dos nossos clientes.</p>
                </div>

                <!-- VALOR 6: PROFISSIONALISMO -->
                <div class="valor-item">
                    <div class="valor-icon">
                        <!-- Ícone SVG: livro (conhecimento/aprendizado) -->
                        <svg viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
                    </div>
                    <h4>Profissionalismo</h4>
                    <p>Equipe qualificada e em constante atualização.</p>
                </div>

            </div> <!-- Fim do grid de valores -->
        </div> <!-- Fim do conteúdo sobre -->
    </div> <!-- Fim do container -->
</section> <!-- Fim da seção sobre -->

<?php
// ============================================================
// INCLUSÃO DOS TEMPLATES FINAIS
// ============================================================

require_once __DIR__ . '/../template/footer_vw.php';  // Rodapé
require_once __DIR__ . '/../template/aside_vw.php';   // WhatsApp flutuante + JS
