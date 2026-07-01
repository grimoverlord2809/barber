<?php 
/**
 * ============================================================
 * ARQUIVO: agendamento_vw.php (views/agedamento/agendamento_vw.php)
 * FUNÇÃO: Página de agendamento de horários
 * DESCRIÇÃO: Formulário completo para o cliente agendar um
 *            horário na barbearia, enviando os dados via WhatsApp
 * ============================================================
 */

// ============================================================
// CONFIGURAÇÃO DA PÁGINA
// ============================================================

$pageTitle = 'Agendamento - Barber Book'; // Título para SEO e aba do navegador
$meta_description = 'Agende seu horário na Barber Book'; // Meta descrição para buscadores
$activePage = 'agendamento'; // Identificador da página ativa no menu

// ============================================================
// INCLUSÃO DOS TEMPLATES COMUNS
// ============================================================

require_once __DIR__ . '/../template/head_Vw.php';    // Cabeçalho HTML
require_once __DIR__ . '/../template/header_vw.php';  // Menu de navegação

// ============================================================
// SEÇÃO DE FORMULÁRIO DE AGENDAMENTO
// ============================================================
?>

<section class="form-section" style="margin-top: 80px;"> <!-- Seção com margem para header fixo -->
    <div class="container"> <!-- Container centralizado -->
        
        <!-- Título da seção -->
        <div class="section-title">
            <h2>Agende seu Horário</h2> <!-- Título principal -->
            <p>Preencha o formulário abaixo e garanta seu horário</p> <!-- Subtítulo -->
        </div>

        <!-- ============================================================
             FORMULÁRIO DE AGENDAMENTO
             id="agendamentoForm" usado pelo JavaScript no aside_vw.php
             O formulário NÃO usa action nem method pois o JS intercepta
             ============================================================ -->
        <form id="agendamentoForm">

            <!-- CAMPO 1: NOME COMPLETO -->
            <div class="form-group"> <!-- Grupo de formulário com estilização -->
                <!-- type="text" = campo de texto simples
                     name="nome" = chave para acessar o dado via PHP/JS
                     placeholder = texto de exemplo dentro do campo
                     required = campo obrigatório (validação nativa do navegador) -->
                <input type="text" name="nome" placeholder="Seu nome completo" required>
            </div>

            <!-- CAMPO 2: TELEFONE (WHATSAPP) -->
            <div class="form-group">
                <!-- type="tel" = campo otimizado para telefones
                     Em dispositivos móveis exibe teclado numérico -->
                <input type="tel" name="telefone" placeholder="Telefone (WhatsApp)" required>
            </div>

            <!-- CAMPO 3: SELEÇÃO DE SERVIÇO -->
            <div class="form-group">
                <!-- select = menu suspenso de seleção
                     name="servico" = chave para acessar o valor selecionado -->
                <select name="servico" required>
                    <!-- Opção padrão desabilitada e selecionada (placeholder) -->
                    <option value="" disabled selected>Selecione o serviço</option>
                    <!-- Cada option tem um value único para identificação -->
                    <option value="corte">Corte Masculino - R$ 30,00</option>
                    <option value="barba">Barba - R$ 20,00</option>
                    <option value="corte-barba">Corte + Barba - R$ 45,00</option>
                    <option value="pigmentacao">Pigmentação - R$ 25,00</option>
                    <option value="hidratacao">Hidratação - R$ 35,00</option>
                    <option value="infantil">Corte Infantil - R$ 25,00</option>
                </select>
            </div>

            <!-- CAMPO 4: DATA DO AGENDAMENTO -->
            <div class="form-group">
                <!-- type="date" = seletor de data nativo do navegador
                     Em dispositivos móveis exibe calendário -->
                <input type="date" name="data" required>
            </div>

            <!-- CAMPO 5: HORÁRIO DO AGENDAMENTO -->
            <div class="form-group">
                <!-- type="time" = seletor de horário nativo do navegador
                     Em dispositivos móveis exibe relógio -->
                <input type="time" name="horario" required>
            </div>

            <!-- CAMPO 6: OBSERVAÇÕES (OPCIONAL) -->
            <div class="form-group">
                <!-- textarea = campo de texto multiline para observações
                     Não tem atributo 'required' pois é opcional -->
                <textarea name="observacoes" placeholder="Observações (opcional)"></textarea>
            </div>

            <!-- BOTÃO DE ENVIO DO FORMULÁRIO -->
            <!-- type="submit" = envia o formulário ao clicar
                 class="botao" = estilização CSS do botão -->
            <button type="submit" class="botao">Confirmar Agendamento</button>

        </form> <!-- Fim do formulário -->
    </div> <!-- Fim do container -->
</section> <!-- Fim da seção de agendamento -->

<?php
// ============================================================
// INCLUSÃO DOS TEMPLATES FINAIS
// ============================================================

require_once __DIR__ . '/../template/footer_vw.php';  // Rodapé
require_once __DIR__ . '/../template/aside_vw.php';   // WhatsApp flutuante + JS
