<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #0d0d0d;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            width: 100%;
            max-width: 600px;
        }

        form {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(255, 0, 0, 0.4);
            width: 100%;
        }

        form h2 {
            margin-bottom: 1rem;
            color: #ff3333;
        }

        form label {
            display: block;
            margin-bottom: 0.5rem;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: none;
            border-radius: 5px;
            background: #1a1a1a;
            color: #fff;
        }

        form button {
            padding: 0.8rem 2rem;
            background: #ff3333;
            border: none;
            color: #fff;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background: #ff0000;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }

        .social-links a {
            text-decoration: none;
            color: #fff;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #1a1a1a;
            padding: 0.8rem 1.2rem;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .social-links a:hover {
            background: #ff3333;
            transform: translateY(-3px);
        }

        .social-links a img {
            width: 24px;
            height: 24px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Formulário -->
        <form action="enviar_email.php" method="POST">
            <h2>Entre em Contato</h2>
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>

            <label for="mensagem">Mensagem</label>
            <textarea id="mensagem" name="mensagem" rows="5" placeholder="Escreva sua mensagem" required></textarea>

            <button type="submit">Enviar</button>
        </form>

        <!-- Redes Sociais -->
        <div class="social-links">
            <a href="https://wa.me/41988955734" target="_blank">
                <img src="https://img.icons8.com/color/48/whatsapp--v1.png" alt="WhatsApp">
                WhatsApp
            </a>
            <a href="https://www.instagram.com/rededge.hr/" target="_blank">
                <img src="https://img.icons8.com/color/48/instagram-new.png" alt="Instagram">
                Instagram
            </a>
            <a href="mailto:rededgeproz@gmail.com">
                <img src="https://img.icons8.com/color/48/email.png" alt="E-mail">
                E-mail
            </a>
        </div>
    </div>
</body>

</html>
