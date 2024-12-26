<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="t">𝕽𝕰𝕯 𝕰𝕯𝕲𝕰</title>
    <link rel="icon" href="./img/logored.png" type="image/x-icon"> <!-- Caminho do ícone -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .t {
      color: red; /* Define a cor do texto como vermelho */
      font-size: 2em; /* Ajuste o tamanho da fonte conforme necessário */
      text-align: center; /* Centraliza o texto */
    }

        body {
            font-family: 'Roboto', sans-serif;
            background: #0d0d0d;
            color: #fff;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.95);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(255, 0, 0, 0.8);
            backdrop-filter: blur(5px);
        }

        .navbar h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            color: #ff3333;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 2rem;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 1.1rem;
            position: relative;
            transition: color 0.3s ease;
        }

        .navbar ul li a:hover {
            color: #ff3333;
        }

        .navbar ul li a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 100%;
            height: 2px;
            background: #ff3333;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .navbar ul li a:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .banner {
            width: 100%;
            height: 80vh;
            background-color: white;
            background: url('./img/banner.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            box-shadow: 0 4px 15px rgba(255, 0, 0, 0.6);
        }

        .banner h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 4rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            animation: fadeIn 1.5s ease;
        }

        .banner p {
            font-size: 1.5rem;
            margin-top: 1rem;
            opacity: 0.9;
        }

        main {
            margin-top: 80px;
            padding: 2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .section-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #ff3333;
        }

        .projetos {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            width: 100%;
            max-width: 1200px;
        }

        .projeto {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(255, 0, 0, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .projeto:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(255, 0, 0, 0.6);
        }

        .projeto h3 {
            color: #ff3333;
            margin-bottom: 1rem;
        }

        .projeto a {
            color: #ff3333;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-top: 1rem;
        }

        .projeto a:hover {
            color: #fff;
        }

        footer {
            background: rgba(255, 0, 0, 0.1);
            text-align: center;
            padding: 2rem;
            margin-top: auto;
            box-shadow: 0 -4px 10px rgba(255, 0, 0, 0.4);
        }

        footer a {
            color: #ff3333;
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .po {
    width: 800px;
    height: auto;
    overflow: hidden; /* Faz o div não aumentar a altura por causa da imagem */
}

.po img {
    border: 1px solid red;
    width: 100%;
}

/* Estiliza a barra de rolagem */
::-webkit-scrollbar {
    width: 10px; /* Largura da barra de rolagem */
    height: 10px; /* Altura da barra de rolagem horizontal */
}

/* Estiliza o fundo da barra de rolagem */
::-webkit-scrollbar-track {
    background:rgb(0, 0, 0); /* Cor de fundo da trilha */
    border-radius: 10px;
}

/* Estiliza o polegar da barra de rolagem (parte que o usuário arrasta) */
::-webkit-scrollbar-thumb {
    background: rgb(97, 50, 50); /* Cor do polegar */
    border-radius: 10px;
}

/* Estiliza o polegar quando o usuário passa o mouse sobre ele */
::-webkit-scrollbar-thumb:hover {
    background: rgb(126, 2, 2); /* Cor do polegar ao passar o mouse */
}

    </style>
</head>

<body>
    <div class="navbar">
    <h1 class="t">𝕽𝕰𝕯 𝕰𝕯𝕲𝕰</h1>
        <ul>
            <li><a href="index.html">Início</a></li>
            <li><a href="projetos.html">Projetos</a></li>
            <li><a href="contato.php">Contato</a></li>
        </ul>
    </div>

    <section class="banner">
        <div>
            <h1> 
                <img class="po" src="./img/rededge-letra.png" alt="">
            </h1>
            <p>𝕿𝖗𝖆𝖓𝖘𝖋𝖔𝖗𝖒𝖎𝖓𝖌 𝖎𝖉𝖊𝖆𝖘 𝖎𝖓𝖙𝖔 𝖉𝖎𝖌𝖎𝖙𝖆𝖑 𝖊𝖝𝖕𝖊𝖗𝖎𝖊𝖓𝖈𝖊𝖘</p>
        </div>
    </section>

    <main>
        <section id="projetos">
            <h2 class="section-title">𝕻𝖗𝖔𝖏𝖊𝖙𝖔𝖘 𝕽𝖊𝖈𝖊𝖓𝖙𝖊𝖘</h2>
            <div class="projetos">
                <div class="projeto">
                    <h3>NAVBAR Modelo 1.4</h3>
                    <p>Menu de navegação moderno e responsivo.</p>
                    <a href="./nav/navbar.php" target="_blank">Ver Mais</a>
                </div>
                <div class="projeto">
                    <h3>Task Manager</h3>
                    <p>Organize tarefas com praticidade.</p>
                    <a href="./p2/main.php" target="_blank">Ver Mais</a>
                </div>
                <div class="projeto">
                    <h3>LOGIN PRO</h3>
                    <p>Login seguro com integração PHP.</p>
                    <a href="./log/login.php" target="_blank">Ver Mais</a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 RedEdge - Desenvolvido por <a href="https://www.instagram.com/cwb_harryy/">cwb_harry</a></p>
    </footer>
</body>

</html>
