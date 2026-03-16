<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presto.it</title>
    <style>
        :root {
            --primary-color: #027F62; 
            --secondary-color: #36C4A3; 
            --text-color: #fff; 
            --dark-color: #00695c; 
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: var(--white, #ffffff); 
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            color: var(--primary-color); 
        }
        h2 {
            color: var(--dark-color); 
        }
        p {
            color: var(--dark-color); 
            line-height: 1.5;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: var(--secondary-color); 
            color: var(--text-color);
            text-decoration: none; 
            border-radius: 5px; 
        }
        a:hover {
            background-color: darken(var(--secondary-color), 10%); /* Scurire il colore secondario al passaggio del mouse */
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Un utente ha chiesto di lavorare con noi</h1>
        <h2>Ecco i suoi dati:</h2>
        <p>Nome: <strong>{{ $user->name }}</strong></p>
        <p>Email: <strong>{{ $user->email }}</strong></p>
        <p>Se vuoi renderlo revisore, clicca qui:</p>
        <a href="{{ route('revisor.make', ['email' => $user->email]) }}">Rendi revisore</a>

        <div class="footer">
            <p>Grazie per la tua attenzione!</p>
            <p>Questo è un messaggio automatico, non rispondere a questa email.</p>
        </div>
    </div>
</body>
</html>
