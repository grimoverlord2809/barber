<!-- 
============================================================
ARQUIVO: header_vw.php
FUNÇÃO: Template do cabeçalho de navegação
DESCRIÇÃO: Contém logo, menu de navegação e botão hambúrguer.
           Este arquivo é incluído em todas as páginas.
           Usa a variável PHP $activePage para destacar o link
           da página atual no menu de navegação.
============================================================
-->

<!-- ============================================================
     ELEMENTO HEADER - CABEÇALHO PRINCIPAL
     Contém o logo e a navegação do site
     ============================================================= -->
<header>

    <!-- Container para centralizar e limitar a largura do conteúdo -->
    <div class="container">

        <!-- ============================================================
             LOGO DO SITE
             Exibe o nome "Barber Book" com "Book" em destaque
             ============================================================= -->
        <div class="logo">
            <!-- Título principal com o nome da barbearia
                 O <span> permite estilizar "Book" separadamente no CSS -->
            <h1>Barber <span>Book</span></h1>
        </div>

        <!-- ============================================================
             NAVEGAÇÃO PRINCIPAL
             Menu horizontal com links para todas as páginas
             ============================================================= -->
        <nav>
            <!-- Lista não ordenada para os itens do menu -->
            <ul class="menu">

                <!-- Link para a Página Inicial
                     href="?page=" = rota vazia = página inicial
                     A classe 'active' é adicionada condicionalmente via PHP
                     quando $activePage === 'inicio' -->
                <li><a href="?page=" <?php echo ($activePage === 'inicio') ? 'class="active"' : ''; ?>>Início</a></li>

                <!-- Link para a Página de Serviços
                     Classe 'active' adicionada quando $activePage === 'servicos' -->
                <li><a href="?page=servicos" <?php echo ($activePage === 'servicos') ? 'class="active"' : ''; ?>>Serviços</a></li>

                <!-- Link para a Página da Equipe
                     Classe 'active' adicionada quando $activePage === 'equipe' -->
                <li><a href="?page=equipe" <?php echo ($activePage === 'equipe') ? 'class="active"' : ''; ?>>Equipe</a></li>

                <!-- Link para a Página Sobre
                     Classe 'active' adicionada quando $activePage === 'sobre' -->
                <li><a href="?page=sobre" <?php echo ($activePage === 'sobre') ? 'class="active"' : ''; ?>>Sobre</a></li>

                <!-- Link para a Página de Agendamento
                     Classe 'active' adicionada quando $activePage === 'agendamento' -->
                <li><a href="?page=agendamento" <?php echo ($activePage === 'agendamento') ? 'class="active"' : ''; ?>>Agendamento</a></li>

                <!-- Link para a Página de Contato
                     Classe 'active' adicionada quando $activePage === 'contato' -->
                <li><a href="?page=contato" <?php echo ($activePage === 'contato') ? 'class="active"' : ''; ?>>Contato</a></li>

            </ul>
        </nav>

        <!-- ============================================================
             BOTÃO HAMBÚRGUER (MENU MOBILE)
             Visível apenas em telas pequenas (responsivo)
             Três <span> representam as três linhas do ícone
             ============================================================= -->
        <div class="hamburger">
            <span></span> <!-- Primeira linha do ícone hambúrguer -->
            <span></span> <!-- Segunda linha do ícone hambúrguer -->
            <span></span> <!-- Terceira linha do ícone hambúrguer -->
        </div>

    </div> <!-- Fim do container -->
</header> <!-- Fim do cabeçalho -->
