<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Congratulazioni {{ $user->name }}!</h1>
        </div>
        
        <div class="content">
            <p>Siamo lieti di informarti che la tua richiesta per diventare revisore è stata accettata!</p>
            
            <p>Da questo momento puoi accedere alla dashboard del revisore e iniziare a revisionare gli annunci.</p>
            
            <p>Per iniziare, clicca sul pulsante qui sotto:</p>
            
            <center>
                <a href="{{ route('revisor.index') }}" class="button">Vai alla Dashboard</a>
            </center>
            
            <p>Grazie per il tuo contributo alla nostra community!</p>
        </div>
    </div>
</body>
</html>
