<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Categories</title>
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
            max-width: 900px;
            margin: 40px auto;
        }
        a, button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            margin-right: 5px;
        }
        a:hover, button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        form.inline {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('privacy.data_category.create') }}">Nuevo</a>

        <table>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Sensible</th>
                <th>Acciones</th>
            </tr>
            @foreach($dataCategories as $dc)
            <tr>
                <td>{{ $dc->code }}</td>
                <td>{{ $dc->name }}</td>
                <td>{{ $dc->is_sensitive ? 'Sí' : 'No' }}</td>
                <td>
                    <a href="{{ route('privacy.data_category.edit', $dc->data_cat_id) }}">Editar</a>
                    <form method="POST" action="{{ route('privacy.data_category.destroy', $dc->data_cat_id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button>Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
