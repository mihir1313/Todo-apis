<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo API Interface</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1, h2 {
            color: #333;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: #e2e2e2;
            margin: 5px 0;
            padding: 10px;
            border-radius: 3px;
        }
        .api-section {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Todo API Interface</h1>

        <section class="api-section" id="getTodos">
            <h2>GET /api/todos</h2>
            <p>Get all todos for a specific user</p>
            <ul>
                <li>Example Response: 
                    [
                        {"id": 1, "userId": 1, "title": "Buy groceries", "description": "Milk, Bread, Eggs", "completed": yes},
                        {"id": 2, "userId": 1, "title": "Walk the dog", "description": "Evening walk in the park", "completed": no}
                    ]
                </li>
            </ul>
        </section>

        <section class="api-section" id="createTodo">
            <h2>POST /api/todos</h2>
            <p>Create a new todo</p>
            <p>Request Body: 
                {
                    "title": "New todo item", 
                    "description": "Description of the new todo", 
                    "completed": yes
                }
            </p>
            <p>Example Response: 
                {
                    "id": 3, 
                    "title": "New todo item", 
                    "description": "Description of the new todo", 
                    "completed": no
                }
            </p>
        </section>

        <section class="api-section" id="getTodo">
            <h2>GET /api/todos/{id}</h2>
            <p>View a specific todo</p>
            <p>Example Request: /api/todos/1</p>
            <p>Example Response: 
                {
                    "id": 1, 
                    "title": "Buy groceries", 
                    "description": "Milk, Bread, Eggs", 
                    "completed": yes
                }
            </p>
        </section>

        <section class="api-section" id="updateTodo">
            <h2>PUT /api/todos/{id}</h2>
            <p>Update a specific todo</p>
            <p>Request Body: 
                {
                    "title": "Updated todo item", 
                    "description": "Updated description", 
                    "completed": no
                }
            </p>
            <p>Example Response: 
                {
                    "id": 1, 
                    "title": "Updated todo item", 
                    "description": "Updated description", 
                    "completed": yes
                }
            </p>
        </section>

        <section class="api-section" id="deleteTodo">
            <h2>DELETE /api/todos/{id}</h2>
            <p>Delete a specific todo</p>
            <p>Example Request: /api/todos/1</p>
            <p>Example Response: 
                {
                    "message": "Todo deleted"
                }
            </p>
        </section>
    </div>
</body>
</html>
