<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Correo</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            text-align: center;
        }
        h1 {
            color: #1e87f0;
            margin-bottom: 20px;
            font-size: 24px;
        }
        p {
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.5;
        }
        a {
            display: inline-block;
            background-color: #1e87f0;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #1664b8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Verificación de Correo</h1>
        <p>Gracias por registrarte en el sitio de la UJED. Por favor, haz clic en el siguiente botón para verificar tu correo electrónico.</p>
        <a href="{{ route('login', ['email' => $user->email, 'password' => $user->password]) }}">Verificar Correo</a>
    </div>
</body>
</html>
