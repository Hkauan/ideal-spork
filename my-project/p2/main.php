<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Task Manager</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>🔗 Advanced Task Manager 🔗</h1>
        </header>
        <main>
            <form id="task-form">
                <input type="text" id="task-title" placeholder="Nova Tarefa..." required />
                <input type="datetime-local" id="task-reminder" />
                <button type="submit">Adicionar</button>
            </form>
            <div id="task-groups">
                <div>
                    <h2>Pendentes</h2>
                    <ul id="pending-tasks"></ul>
                </div>
                <div>
                    <h2>Concluídas</h2>
                    <ul id="completed-tasks"></ul>
                </div>
            </div>
        </main>
        <footer>
            <p>Feito com ❤️ e inovação</p>
        </footer>
    </div>
    <script src="assets/script.js"></script>
</body>
</html>
