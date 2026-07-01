<?php 
/**
 * ============================================================
 * ARQUIVO: contato_vw.php (views/contato/contato_vw.php)
 * FUNÇÃO: Página de contato e informações
 * DESCRIÇÃO: Exibe endereço, telefone, WhatsApp, Instagram,
 *            horário de funcionamento e botão para WhatsApp
 * ============================================================
 */

// ============================================================
// CONFIGURAÇÃO DA PÁGINA
// ============================================================

$pageTitle = 'Contato - Barber Book'; // Título para SEO e aba do navegador
$meta_description = 'Entre em contato com a Barber Book'; // Meta descrição para buscadores
$activePage = 'contato'; // Identificador da página ativa no menu

// ============================================================
// INCLUSÃO DOS TEMPLATES COMUNS
// ============================================================

require_once __DIR__ . '/../template/head_Vw.php';    // Cabeçalho HTML
require_once __DIR__ . '/../template/header_vw.php';  // Menu de navegação

// ============================================================
// SEÇÃO DE CONTATO E INFORMAÇÕES
// ============================================================
?>

<section class="form-section" style="margin-top: 80px;"> <!-- Seção com margem para header fixo -->
    <div class="container"> <!-- Container centralizado -->
        
        <!-- Título da seção -->
        <div class="section-title">
            <h2>Entre em Contato</h2> <!-- Título principal -->
            <p>Estamos prontos para atender você</p> <!-- Subtítulo -->
        </div>

        <!-- ============================================================
             GRID DE INFORMAÇÕES DE CONTATO
             4 cards com dados de contato da barbearia
             ============================================================ -->
        <div class="contato-info">

            <!-- CARD 1: ENDEREÇO -->
            <div class="info-item">
                <div class="icon-svg">
                    <!-- Ícone SVG: pin de localização -->
                    <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <h4>Endereço</h4>
                <p>Rua das Flores, 123<br>Centro - São Paulo/SP</p>
            </div>

            <!-- CARD 2: TELEFONE -->
            <div class="info-item">
                <div class="icon-svg">
                    <!-- Ícone SVG: telefone -->
                    <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                </div>
                <h4>Telefone</h4>
                <p>(86) 99950-4284</p>
            </div>

            <!-- CARD 3: WHATSAPP -->
            <div class="info-item">
                <div class="icon-svg">
                    <!-- Ícone SVG: WhatsApp -->
                    <svg viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>
                </div>
                <h4>WhatsApp</h4>
                <p>(86) 99950-4284</p>
            </div>

            <!-- CARD 4: INSTAGRAM -->
            <div class="info-item">
                <div class="icon-svg">
                    <!-- Ícone SVG: Instagram -->
                    <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </div>
                <h4>Instagram</h4>
                <p>@barberbook</p>
            </div>

        </div> <!-- Fim do grid de contato -->

        <!-- ============================================================
             SEÇÃO DE HORÁRIO DE FUNCIONAMENTO
             ============================================================ -->
        <div style="margin-top: 60px;"> <!-- Margem superior para separação visual -->
            
            <div class="section-title">
                <h2>Horário de Funcionamento</h2> <!-- Título dos horários -->
            </div>

            <!-- Grid de horários -->
            <div class="contato-info">

                <!-- HORÁRIO: SEGUNDA A SEXTA -->
                <div class="info-item">
                    <div class="icon-svg">
                        <!-- Ícone SVG: calendário -->
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <h4>Segunda a Sexta</h4>
                    <p>09:00 - 20:00</p>
                </div>

                <!-- HORÁRIO: SÁBADO -->
                <div class="info-item">
                    <div class="icon-svg">
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <h4>Sábado</h4>
                    <p>09:00 - 18:00</p>
                </div>

                <!-- HORÁRIO: DOMINGO -->
                <div class="info-item">
                    <div class="icon-svg">
                        <!-- Ícone SVG: círculo com linha (fechado) -->
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                    </div>
                    <h4>Domingo</h4>
                    <p>Fechado</p>
                </div>

            </div> <!-- Fim do grid de horários -->
        </div>

        <!-- ============================================================
             BOTÃO DE CHAMADA PARA AÇÃO (CTA)
             Redireciona para o WhatsApp da barbearia
             ============================================================ -->
        <div style="text-align: center; margin-top: 60px;">
            <!-- Link externo para WhatsApp com número internacional -->
            <a href="https://wa.me/5586999504284" class="botao" target="_blank">Fale Conosco no WhatsApp</a>
        </div>

    </div> <!-- Fim do container -->
</section> <!-- Fim da seção de contato -->

<?php
// ============================================================
// INCLUSÃO DOS TEMPLATES FINAIS
// ============================================================

require_once __DIR__ . '/../template/footer_vw.php';  // Rodapé
require_once __DIR__ . '/../template/aside_vw.php';   // WhatsApp flutuante + JS
