<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Data Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }
        .container {
            width: 90%;
            max-width: 500px;
            margin: 40px auto;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            width: auto;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Crear Data Category</h2>
        <form method="POST" action="{{ route('privacy.data_category.store') }}">
            @csrf
            <input name="code" placeholder="Código">
            <input name="name" placeholder="Nombre">

            <select name="is_sensitive">
                <option value="0">No</option>
                <option value="1">Sí</option>
            </select>

            <textarea name="description" placeholder="Descripción"></textarea>
            <button>Guardar</button>
        </form>
    </div>
</body>
</html>
