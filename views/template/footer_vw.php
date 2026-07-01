<!-- 
============================================================
ARQUIVO: footer_vw.php
FUNÇÃO: Template do rodapé do site
DESCRIÇÃO: Contém informações da empresa, links rápidos,
           contato, redes sociais e copyright.
           Este arquivo é incluído em todas as páginas.
============================================================
-->

<!-- ============================================================
     ELEMENTO FOOTER - RODAPÉ DO SITE
     Contém informações institucionais e links úteis
     ============================================================= -->
<footer>

    <!-- Container para centralizar o conteúdo do rodapé -->
    <div class="container">

        <!-- ============================================================
             CONTEÚDO PRINCIPAL DO RODAPÉ
             Grid com 4 seções de informações
             ============================================================= -->
        <div class="footer-content">

            <!-- ============================================================
                 SEÇÃO 1: INFORMAÇÕES DA EMPRESA
                 Nome e descrição da barbearia
                 ============================================================= -->
            <div class="footer-section">
                <h4>Barber Book</h4> <!-- Nome da empresa -->
                <p>Seu estilo começa aqui. Cortes modernos e atendimento de qualidade.</p> <!-- Tagline -->
            </div>

            <!-- ============================================================
                 SEÇÃO 2: LINKS RÁPIDOS
                 Navegação para as principais páginas
                 ============================================================= -->
            <div class="footer-section">
                <h4>Links Rápidos</h4> <!-- Título da seção -->
                <a href="?page=">Início</a>           <!-- Link para página inicial -->
                <a href="?page=servicos">Serviços</a>   <!-- Link para serviços -->
                <a href="?page=equipe">Equipe</a>       <!-- Link para equipe -->
                <a href="?page=agendamento">Agendamento</a> <!-- Link para agendamento -->
            </div>

            <!-- ============================================================
                 SEÇÃO 3: INFORMAÇÕES DE CONTATO
                 Telefone e perfil do Instagram
                 ============================================================= -->
            <div class="footer-section">
                <h4>Contato</h4> <!-- Título da seção -->
                <p>WhatsApp: (86) 99950-4284</p> <!-- Número de WhatsApp -->
                <p>Instagram: @barberbook</p> <!-- Perfil do Instagram -->
            </div>

            <!-- ============================================================
                 SEÇÃO 4: REDES SOCIAIS
                 Ícones clicáveis para as redes sociais
                 ============================================================= -->
            <div class="footer-section">
                <h4>Redes Sociais</h4> <!-- Título da seção -->

                <!-- Container flexível para os ícones de redes sociais -->
                <div class="redes-sociais">

                    <!-- Link para o Instagram (ícone SVG) -->
                    <a href="#" aria-label="Instagram"> <!-- aria-label para acessibilidade -->
                        <!-- Ícone SVG representando o logo do Instagram -->
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/> <!-- Fundo arredondado -->
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/> <!-- Câmera -->
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/> <!-- Flash -->
                        </svg>
                    </a>

                    <!-- Link para o WhatsApp (ícone SVG) -->
                    <a href="#" aria-label="WhatsApp"> <!-- aria-label para acessibilidade -->
                        <!-- Ícone SVG representando o logo do WhatsApp -->
                        <svg viewBox="0 0 24 24">
                            <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/>
                        </svg>
                    </a>

                    <!-- Link para o Facebook (ícone SVG) -->
                    <a href="#" aria-label="Facebook"> <!-- aria-label para acessibilidade -->
                        <!-- Ícone SVG representando o logo do Facebook -->
                        <svg viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                        </svg>
                    </a>

                </div> <!-- Fim do container de redes sociais -->
            </div> <!-- Fim da seção de redes sociais -->

        </div> <!-- Fim do conteúdo principal do rodapé -->

        <!-- ============================================================
             PARTE INFERIOR DO RODAPÉ
             Exibe o ano atual dinamicamente e direitos autorais
             ============================================================= -->
        <div class="footer-bottom">
            <!-- date('Y') retorna o ano atual (ex: 2026)
                 O operador &copy; exibe o símbolo © -->
            <p>&copy; <?php echo date('Y'); ?> Barber Book. Todos os direitos reservados.</p>
        </div>

    </div> <!-- Fim do container -->
</footer> <!-- Fim do rodapé -->
