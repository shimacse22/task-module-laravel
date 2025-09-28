# Laravel Task Module

A Task Management module built with **Laravel 12**, featuring multiple task insertion using a repeater form with AJAX and REST API support.

---

## Setup

1. **Clone the repository**

```bash
git clone <repository-url>
cd laravel-task-module
```

2. **Install dependencies**

```bash
composer install
npm install
npm run dev
```

3. **Environment setup**

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_task_module
DB_USERNAME=root
DB_PASSWORD=
```

4. **Run migrations and seeders**

```bash
php artisan migrate --seed
```

5. **Serve the application**

```bash
php artisan serve
```

Open in browser: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Architecture

* **Controller:** `App\Http\Controllers\API\TaskController`

  * Handles validation, bulk insert, single task retrieval, deletion, and API responses.

* **Model:** `App\Models\Task`

  * Represents tasks stored in the database.

* **Database:**

  * `tasks` table stores multiple tasks.
  * Seeders populate sample tasks.

* **Routes:**

  * `/tasks` → Blade view with repeater form
  * `/api/tasks` → REST API for storing, retrieving, and deleting tasks

* **Frontend:**

  * `resources/views/tasks.blade.php`
  * jQuery handles repeater form, AJAX submission, dynamic appending, and validation error display.

* **Validation:**

  * Server-side validation ensures each task has a title.
  * Errors are returned per task and displayed under corresponding input fields.

---

## API Usage

### **GET /api/tasks**

Retrieve all tasks.

**Response Example:**

```json
{
  "data": [
    {
      "id": 1,
      "title": "Task 1",
      "description": "Description 1",
      "created_at": "2025-09-28T10:00:00.000000Z",
      "updated_at": "2025-09-28T10:00:00.000000Z"
    }
  ]
}
```

---

### **POST /api/tasks**

Insert multiple tasks.

**Request Body (JSON):**

```json
{
  "tasks": [
    {"title": "Task 1", "description": "Description 1"},
    {"title": "Task 2", "description": "Description 2"}
  ]
}
```

**Response Example:**

```json
{
  "success": true,
  "message": "Task Created Successfully"
}
```

**Validation Errors:**

```json
{
  "errors": {
    "tasks.0.title": ["The tasks.0.title field is required."]
  }
}
```

### **GET /api/tasks/{id}**

Retrieve a single task by its ID.

**Response Example:**

```json
{
  "data": {
    "id": 1,
    "title": "Task 1",
    "description": "Description 1",
    "created_at": "2025-09-28T10:00:00.000000Z",
    "updated_at": "2025-09-28T10:00:00.000000Z"
  }
}
```

**404 Response if not found:**

```json
{
  "error": "Task not found"
}
```

### **DELETE /api/tasks/{id}**

Delete a task by its ID.

**Response Example:**

```json
{
  "success": true,
  "message": "Task deleted successfully"
}
```

**404 Response if not found:**

```json
{
  "error": "Task not found"
}
```

**Testing in Postman:**

1. Set method: `POST`, `GET`, or `DELETE`
2. URL: `http://127.0.0.1:8000/api/tasks` or `http://127.0.0.1:8000/api/tasks/{id}`
3. For POST → Body → raw → JSON → paste example JSON
4. Send and check response

---

## Scalability

* **Bulk Insert:** Multiple tasks inserted in a single database transaction, reducing queries.
* **Dynamic Form:** Repeater allows adding unlimited tasks without page reload.
* **API Ready:** RESTful API supports future integration with frontend frameworks or mobile apps.
* **Validation per Task:** Ensures data integrity even with large inputs.
* **AJAX Submission:** Optimizes user experience and reduces server load.
* **Single Task API & Delete API:** Supports full CRUD operations for tasks.

---

## Demo Video

[Drive Link Here](https://drive.google.com/file/d/1uFaHmYOrWbZOWLvxnI7pKb5SHJYae2k1/view?usp=sharing)

---

## Author

**Shima Akter** – Laravel Developer
Email: shimacse22@gmail.com
GitHub:https://github.com/shimacse22/task-module-laravel
