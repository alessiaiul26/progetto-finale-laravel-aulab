<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9; /* Colore di sfondo */
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff; /* Colore del contenitore */
            border: 1px solid #ddd;
            padding: 20px;
        }
        .email-header {
            background-color: #027F62; /* Colore primario */
            color: #fff; /* Colore del testo */
            text-align: center;
            padding: 15px 0;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            text-align: center;
            color: #333; /* Colore del testo principale */
        }
        .email-body p {
            line-height: 1.5;
        }
        .email-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .email-table th, .email-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .email-table th {
            background-color: #f4f4f4; /* Colore di sfondo della tabella */
        }
        .email-footer {
            margin: 20px 0;
            text-align: center;
        }
        .email-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #36C4A3; /* Colore secondario */
            color: #fff; /* Colore del testo del pulsante */
            text-decoration: none;
            border-radius: 5px;
        }
        .email-button:hover {
            background-color: #00695c; /* Colore scuro al passaggio del mouse */
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Contatto - Email</h1>
        </div>
        <div class="email-body">
            <p>Ciao,</p>
            <p>Abbiamo ricevuto il tuo messaggio. Grazie per averci contattato! Ecco un riepilogo del tuo messaggio:</p>
            <p>Se non hai inviato questa richiesta, ignora questo messaggio!</p>
            
            <h3>Riepilogo del tuo messaggio</h3>
            
            <table class="email-table">
                <tr>
                    <th>Nome:</th>
                    <td>{{ $user_contact['user'] }}</td> <!-- Modificato per usare 'user' -->
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $user_contact['email'] }}</td> <!-- Modificato per usare 'email' -->
                </tr>
                <tr>
                    <th>Messaggio:</th>
                    <td>{{ $user_contact['message'] }}</td> <!-- Modificato per usare 'message' -->
                </tr>
            </table>

            <p>Se hai domande, non esitare a contattarci di nuovo.</p>

            <div class="email-footer">
                <a href="#" class="email-button">Visita il nostro sito</a>
            </div>
        </div>
    </div>
</body>
</html>
