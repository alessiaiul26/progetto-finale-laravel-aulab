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
            background-color: #343a40;
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
            background-color: #343a40;
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
            <p>Siamo lieti di informarti che la tua richiesta per diventare amministratore è stata approvata!</p>
            
            <p>Da questo momento hai accesso a tutte le funzionalità di amministrazione del sito, inclusa la gestione delle richieste dei revisori.</p>
            
            <p>Con i grandi poteri derivano grandi responsabilità. Ti chiediamo di utilizzare questi privilegi con saggezza e nel rispetto delle nostre linee guida.</p>
            
            <p>Per iniziare, clicca sul pulsante qui sotto per accedere alla dashboard di amministrazione:</p>
            
            <center>
                <a href="{{ route('admin.dashboard') }}" class="button">Vai alla Dashboard Admin</a>
            </center>
            
            <p>Grazie per il tuo impegno nel migliorare la nostra community!</p>
        </div>
    </div>
</body>
</html>
