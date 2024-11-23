

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ape Stage Solutions - Início</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Paleta de Cores Padrão */
        :root {
            --primary-color: #000000;
            --primary-light: #2d2d2d;
            --background-color: #f0f4f8;
            --section-background: #b0b0b0;
            --text-light: #ffffff;
            --text-dark: #333333;
            --title-light: #e0e0e0;
            --gradient-start: #2d2d2d;
            --gradient-end: #1a1a1a;
        }

        /* Estilos Gerais */
        body {
            background-color: var(--background-color);
            font-family: 'Roboto', sans-serif;
            transition: margin-right 0.3s ease; /* Suaviza a transição do conteúdo */
        }

        /* Navbar */
        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-item {
            color: var(--text-light);
        }

        .navbar-item:hover {
            background-color: var(--primary-light);
            color: var(--text-light);
        }

        /* Barra Lateral - Do lado direito */
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: var(--primary-color);
            padding-top: 60px; /* Ajustado para não cobrir o conteúdo */
            transition: width 0.3s ease; /* Animação de largura */
            overflow-x: hidden;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 18px;
            color: var(--text-light);
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            background-color: var(--primary-light);
        }

        .sidenav .close-btn {
            position: absolute;
            top: 0;
            left: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        /* Botão para abrir/fechar */
        .open-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: var(--primary-light);
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 30px;
            display: block;
            cursor: pointer;
            z-index: 2; /* Garante que o botão fique acima da navbar */
            transition: background-color 0.3s ease; /* Suaviza a transição de cor */
        }

        .open-btn:hover {
            background-color: var(--primary-color);
        }

        /* Responsividade */
        @media screen and (max-width: 768px) {
            .sidenav {
                width: 0;
                padding-top: 60px;
            }

            .sidenav.open {
                width: 250px;
            }

            .sidenav a {
                text-align: center;
                padding: 8px;
            }
        }

        /* Hero Section */
        .hero-body {
            background-image: url('img/bape-white-silhouette-l4at6bqd8ucy22jy.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 2em;
        }

        /* Funcionalidades - Efeito de Profundidade */
        .section-funcionalidades {
            background-color: var(--section-background);
            padding: 3rem 1.5rem;
        }

        .feature-box {
            background: linear-gradient(145deg, var(--gradient-start), var(--gradient-end));
            color: var(--text-light);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2), 0px 10px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.25), 0px 15px 30px rgba(0, 0, 0, 0.2);
        }

        .feature-box h3 {
            color: var(--title-light);
            font-weight: 700;
        }

        .feature-box .icon {
            font-size: 2.5rem;
            color: var(--title-light);
            transition: color 0.4s ease, transform 0.4s ease;
        }

        .feature-box:hover .icon {
            color: #ffdd57;
            transform: scale(1.1);
        }

        /* Footer */
        .footer {
            background-color: var(--primary-color);
            color: var(--text-light);
        }
    </style>
</head>

<body>

 
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="close-btn" onclick="closeNav()">×</a>
        <a href="login.php">Login</a>
        <a href="registro.php">Registro</a>
    </div>

    
    <button class="open-btn" onclick="openNav()">&#9776;</button>

  
    <header class="navbar">
        <div class="navbar-brand">
            <a class="navbar-item" href="#">
                <span class="ml-2 has-text-weight-bold is-size-4">Ape Stage Solutions</span>
            </a>
        </div>
    </header>

    <section class="hero is-medium">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title is-1">Bem-vindo ao Painel da Ape Stage Solutions</h1>
                <p class="subtitle is-4">Gerencie e acompanhe o progresso de seus estagiários com eficiência.</p>
            </div>
        </div>
    </section>

  
    <section class="section section-funcionalidades">
        <div class="container">
            <h2 class="title has-text-centered">Funcionalidades Principais</h2>
            <div class="columns is-multiline mt-6">
                <div class="column is-4">
                    <div class="feature-box has-text-centered">
                        <span class="icon is-large">
                            <i class="fas fa-user-shield"></i>
                        </span>
                        <h3 class="title is-5 mt-3">Segurança de Dados</h3>
                        <p>Acesso seguro e gerenciamento de informações sensíveis com controle de permissões.</p>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="feature-box has-text-centered">
                        <span class="icon is-large">
                            <i class="fas fa-clock"></i>
                        </span>
                        <h3 class="title is-5 mt-3">Cadastro Simples</h3>
                        <p>Insira e atualize informações de estagiários de forma rápida e eficiente.</p>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="feature-box has-text-centered">
                        <span class="icon is-large">
                            <i class="fas fa-chart-line"></i>
                        </span>
                        <h3 class="title is-5 mt-3">Relatórios de Progresso</h3>
                        <p>Acompanhe o desenvolvimento dos estagiários com relatórios detalhados.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="content has-text-centered">
            <p>&copy; <?php echo date("Y"); ?> Ape Stage Solutions. Todos os direitos reservados.</p>
            <p>Facilitando a gestão de estágios e promovendo eficiência.</p>
        </div>
    </footer>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.body.style.marginRight = "250px"; /* Empurra o conteúdo da página */
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.body.style.marginRight = "0";  /* Retorna o conteúdo ao normal */
        }
    </script>

</body>
</html>
