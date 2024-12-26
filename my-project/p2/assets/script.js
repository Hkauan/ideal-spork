const taskForm = document.getElementById("task-form");
const taskTitle = document.getElementById("task-title");
const taskReminder = document.getElementById("task-reminder");
const pendingTasks = document.getElementById("pending-tasks");
const completedTasks = document.getElementById("completed-tasks");

// Load tasks on page load
document.addEventListener("DOMContentLoaded", loadTasks);

// Add task
taskForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const title = taskTitle.value.trim();
    const reminder = taskReminder.value;

    if (title === "") return alert("Título é obrigatório.");

    fetch("api/tasks.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ title, reminder })
        })
        .then(() => {
            taskTitle.value = "";
            taskReminder.value = "";
            loadTasks();
        });
});

// Load tasks from API
function loadTasks() {
    fetch("api/tasks.php")
        .then((response) => response.json())
        .then((tasks) => {
            pendingTasks.innerHTML = "";
            completedTasks.innerHTML = "";

            tasks.forEach((task) => {
                const li = document.createElement("li");
                li.className = task.completed ? "completed" : "";
                li.innerHTML = `
                    ${task.title}
                    <button class="delete-btn" onclick="deleteTask('${task.id}')">🗑️</button>
                `;

                li.addEventListener("click", () => toggleTask(task.id, !task.completed));

                if (task.completed) {
                    completedTasks.appendChild(li);
                } else {
                    pendingTasks.appendChild(li);
                }

                if (task.reminder) {
                    scheduleReminder(task.title, task.reminder);
                }
            });
        });
}

// Toggle task completion
function toggleTask(id, completed) {
    fetch("api/tasks.php", {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id, completed })
    }).then(() => loadTasks());
}

// Delete task
function deleteTask(id) {
    fetch("api/tasks.php", {
        method: "DELETE",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id })
    }).then(() => loadTasks());
}

// Schedule a reminder
function scheduleReminder(title, time) {
    const reminderTime = new Date(time) - new Date();
    if (reminderTime > 0) {
        setTimeout(() => {
            alert(`Lembrete: ${title}`);
        }, reminderTime);
    }
}