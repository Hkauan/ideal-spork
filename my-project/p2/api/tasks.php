<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$dataFile = 'tasks.json';

if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);
$tasks = json_decode(file_get_contents($dataFile), true);

switch ($method) {
    case 'GET':
        echo json_encode($tasks, JSON_PRETTY_PRINT);
        break;

    case 'POST':
        if (!empty($data['title'])) {
            $task = [
                "id" => uniqid(),
                "title" => htmlspecialchars($data['title']),
                "completed" => false,
                "reminder" => !empty($data['reminder']) ? $data['reminder'] : null
            ];
            $tasks[] = $task;
            file_put_contents($dataFile, json_encode($tasks, JSON_PRETTY_PRINT));
            echo json_encode(["status" => "success", "message" => "Tarefa adicionada com sucesso.", "task" => $task]);
        } else {
            echo json_encode(["status" => "error", "message" => "O campo 'title' é obrigatório."]);
        }
        break;

    case 'PUT':
        if (!empty($data['id'])) {
            foreach ($tasks as &$task) {
                if ($task['id'] === $data['id']) {
                    if (isset($data['title'])) {
                        $task['title'] = htmlspecialchars($data['title']);
                    }
                    if (isset($data['completed'])) {
                        $task['completed'] = (bool)$data['completed'];
                    }
                    if (isset($data['reminder'])) {
                        $task['reminder'] = $data['reminder'];
                    }
                    file_put_contents($dataFile, json_encode($tasks, JSON_PRETTY_PRINT));
                    echo json_encode(["status" => "success", "message" => "Tarefa atualizada com sucesso.", "task" => $task]);
                    exit;
                }
            }
            echo json_encode(["status" => "error", "message" => "Tarefa não encontrada."]);
        } else {
            echo json_encode(["status" => "error", "message" => "O campo 'id' é obrigatório."]);
        }
        break;

    case 'DELETE':
        if (!empty($data['id'])) {
            $tasks = array_filter($tasks, fn($task) => $task['id'] !== $data['id']);
            file_put_contents($dataFile, json_encode(array_values($tasks), JSON_PRETTY_PRINT));
            echo json_encode(["status" => "success", "message" => "Tarefa excluída com sucesso."]);
        } else {
            echo json_encode(["status" => "error", "message" => "O campo 'id' é obrigatório."]);
        }
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Método não suportado."]);
        break;
}
