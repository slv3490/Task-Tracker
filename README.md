# 📝 Rastreador de Tareas (Task Tracker CLI)

El **Rastreador de Tareas** es una aplicación de línea de comandos (CLI) sencilla que te permite gestionar tus tareas de forma eficiente desde la terminal. Este proyecto es ideal para practicar habilidades como la manipulación del sistema de archivos, gestión de entradas del usuario y creación de aplicaciones CLI.

---

## 🚀 Características

- ✅ Agregar nuevas tareas
- ✏️ Actualizar tareas existentes
- 🗑️ Eliminar tareas
- ⏳ Marcar tareas como **en progreso**
- ✔️ Marcar tareas como **terminadas**
- 📋 Listar todas las tareas
- 📌 Filtrar tareas por estado:
  - Tareas completadas
  - Tareas pendientes

---

## 🛠️ Requisitos

- Entorno de línea de comandos (Terminal, CMD, PowerShell, etc.)
- [Php](https://www.php.net/) 8.1 o superior

---

## 🧰 Instalación

Clonar el repositorio:
   ```bash
   git clone https://github.com/slv3490/Task-Tracker.git
   
   cd .\Task-Tracker\

   ```
   ---

## ⚙️ Uso

Ejecuta los siguientes comandos desde la terminal:

```bash
# Agregar una nueva tarea
task-cli add "Buy groceries"

Output: Task added successfully (ID:1)


# Actualizar y eliminar tareas
task.php update 1 "Buy groceries and cook dinner"
Output: The task was updated successfully

task.php delete 1
Output: Task with ID 1 has been deleted


# Marcar una tarea como en progreso o completada
task.php mark-in-progress 1
Output: The task was changed to: Pending

task.php mark-done 1
Output: The task was changed to: Completed


# Listar todas las tareas
task.php list
Output: Getting all the tasks

# Listar tareas por estado
task.php list done
Output: Getting tasks: done

task.php list in-progress
Output: Getting tasks: in progress

```

---

## 📂 Estructura del Proyecto

```
rastreador-tareas/
│
├── datos.json     # Archivo donde se almacenan las tareas
├── task.php       # Script principal de la aplicación
└── README.md      # README archivo
```
---

## 🧑‍💻 Autor

- [Roadmap.sh](https://roadmap.sh/projects/task-tracker)