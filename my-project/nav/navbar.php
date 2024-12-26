<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Punk Navbar</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(145deg, #1b1b1b, #282828);
            color: #e5e5e5;
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background: #141414;
            color: #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            position: fixed;
            width: 100%;
            z-index: 1000;
            border-bottom: 2px solid #333;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.8);
            transition: all 0.3s ease;
        }

        .navbar:hover {
            background: #1f1f1f;
            border-color: #555;
        }

        .navbar .menu-btn {
            font-size: 25px;
            color: #f5f5f5;
            cursor: pointer;
            background: none;
            border: none;
            transition: transform 0.3s ease;
        }

        .navbar .menu-btn:active {
             color: #888;
             font-size: 28px;
        }

        .navbar-logo img {
            max-height: 50px;
            filter: drop-shadow(2px 2px 5px #000);
        }

        .navbar-links a {
            color: #bbb;
            margin-left: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .navbar-links a:hover {
            color: #f39c12;
            transform: scale(1.1);
        }

        .navbar-links a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 100%;
            height: 2px;
            background: #f39c12;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .navbar-links a:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .logout a {
            color: #bbb;
            padding: 10px 20px;
            border: 2px solid #444;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .logout a:hover {
            background: #f39c12;
            color: #141414;
            transform: translateY(-2px);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: -270px;
            width: 270px;
            height: 100%;
            background: #1b1b1b;
            color: #e5e5e5;
            transition: all 0.3s ease;
            z-index: 999;
            padding-top: 80px;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.8);
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar a {
            display: block;
            padding: 15px 20px;
            font-size: 16px;
            color: #bbb;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .sidebar a:hover {
            background: #f39c12;
            color: #141414;
            transform: scale(1.05);
        }

        .menu-title {
            font-size: 14px;
            color: #888;
            padding: 15px 20px;
            border-bottom: 1px solid #333;
            text-transform: uppercase;
        }

        /* Animação de hover */
        .sidebar a:hover img {
            filter: drop-shadow(2px 2px 3px #000);
        }

        /* Conteúdo principal */
        .content {
            margin-left: 30px;
            padding: 100px 20px 0;
            transition: margin-left 0.3s ease;
        }

        .content.active {
            margin-left: 300px;
        }

        /* Pesquisa */
        .search-container {
            position: relative;
            width: 90%;
            margin: 20px auto;
        }

        .search-container input {
            width: 100%;
            padding: 10px 15px;
            border-radius: 5px;
            background: #333;
            color: #f5f5f5;
            border: none;
            outline: none;
        }

        .search-container input::placeholder {
            color: #bbb;
        }

        .search-container .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            filter: brightness(0.8);
        }

        /* Scroll customizado */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #333;
        }

        ::-webkit-scrollbar-thumb {
            background: #555;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #777;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <button class="menu-btn" onclick="toggleSidebar()">☰</button>
        <div class="navbar-logo"><img src="#" alt="Logo"></div>
        <div class="navbar-links">
            <a href="#">Contato</a>
            <a href="#">Email</a>
        </div>
        <div class="logout">
            <a href="./index.php">Logout</a>
        </div>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="menu-title">Menu</div>
        <a href="#">Home</a>
        <a href="#">Sobre</a>
    </div>

    <div class="content" id="content">
        <h1>Bem-vindo</h1>
        <p>Modelo Navbar simples</p>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('content').classList.toggle('active');
        }
    </script>
</body>
</html>
