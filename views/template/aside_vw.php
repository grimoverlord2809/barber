<!-- 
============================================================
ARQUIVO: aside_vw.php
FUNÇÃO: Template de elementos flutuantes e scripts JS
DESCRIÇÃO: Contém o botão flutuante do WhatsApp e o script
           JavaScript para o menu hambúrguer responsivo.
           Este arquivo é incluído no FINAL de todas as páginas,
           logo antes do fechamento de </body> e </html>.
============================================================
-->

<!-- ============================================================
     BOTÃO FLUTUANTE DO WHATSAPP
     Link fixo no canto inferior da tela para contato rápido
     ============================================================= -->

<!-- Link para o WhatsApp com número internacional
     target="_blank" = abre em nova aba/janela
     aria-label = texto alternativo para leitores de tela (acessibilidade) -->
<a href="https://wa.me/5586999504284" class="whatsapp" target="_blank" aria-label="WhatsApp">
    <!-- Ícone SVG do WhatsApp (ícone de chat) -->
    <svg viewBox="0 0 24 24">
        <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/>
    </svg>
</a>

<!-- ============================================================
     SCRIPT JAVASCRIPT - INTERATIVIDADE DO MENU HAMBÚRGUER
     Controla a abertura/fechamento do menu mobile
     ============================================================= -->
<script>
    // Seleciona o elemento do menu hambúrguer (ícone de 3 linhas)
    // querySelector retorna o primeiro elemento que corresponde ao seletor CSS
    const hamburger = document.querySelector('.hamburger');

    // Seleciona o elemento do menu de navegação (lista de links)
    const menu = document.querySelector('.menu');

    // Adiciona um evento de clique ao botão hambúrguer
    // Quando o usuário clica, o menu abre ou fecha (toggle)
    hamburger.addEventListener('click', () => {
        // toggle('active') adiciona/remove a classe 'active'
        // Se a classe existe → remove; se não existe → adiciona
        // Isso permite animar a transição via CSS
        hamburger.classList.toggle('active');
        menu.classList.toggle('active');
    });

    // Seleciona TODOS os links dentro do menu (.menu a)
    // forEach percorre cada link e adiciona um evento de clique
    document.querySelectorAll('.menu a').forEach(link => {
        // Quando o usuário clica em qualquer link do menu
        link.addEventListener('click', () => {
            // Remove a classe 'active' do hambúrguer (fecha o ícone)
            hamburger.classList.remove('active');
            // Remove a classe 'active' do menu (esconde o menu mobile)
            menu.classList.remove('active');
        });
    });

    // ============================================================
    // FORMULÁRIO DE AGENDAMENTO
    // Intercepta o envio e redireciona para o WhatsApp
    // ============================================================
    const formAgendamento = document.getElementById('agendamentoForm');
    if (formAgendamento) {
        formAgendamento.addEventListener('submit', function(e) {
            e.preventDefault(); // Impede envio padrão do formulário

            // Obtém os dados do formulário
            const formData = new FormData(this);
            const nome = formData.get('nome');
            const telefone = formData.get('telefone');
            const servico = formData.get('servico');
            const data = formData.get('data');
            const horario = formData.get('horario');
            const observacoes = formData.get('observacoes');

            // Monta a mensagem para o WhatsApp
            let mensagem = `Olá! Gostaria de agendar um horário.\n\n`;
            mensagem += `Nome: ${nome}\n`;
            mensagem += `Telefone: ${telefone}\n`;
            mensagem += `Serviço: ${servico}\n`;
            mensagem += `Data: ${data}\n`;
            mensagem += `Horário: ${horario}\n`;
            if (observacoes) {
                mensagem += `Observações: ${observacoes}\n`;
            }

            // Codifica a mensagem para URL
            const mensagemEncoded = encodeURIComponent(mensagem);

            // Número do WhatsApp da barbearia (formato internacional)
            const numeroWhatsApp = '5586999504284';

            // Monta a URL do WhatsApp com a mensagem
            const urlWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${mensagemEncoded}`;

            // Abre o WhatsApp em nova aba/janela
            window.open(urlWhatsApp, '_blank');
        });
    }
</script>

<!-- ============================================================
     FECHAMENTO DOS ELEMENTOS RAIZ DO HTML
     ============================================================= -->
</body> <!-- Fim do corpo do documento -->
</html> <!-- Fim do documento HTML -->
