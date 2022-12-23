

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
        Bonjour {{ $firstname }} ! Si vous recevez cet email, c'est que votre frero vous a inviter a bien vouloir l'aider afin
        d'arreter de fumer ! Cliquez sur le lien pour donner ou non votre accord !
    </p>
    <a target="_blank" rel="noopener noreferrer" href="http://127.0.0.1:5173/agreed/{{$remember_token}}" class="button button-primary" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -webkit-text-size-adjust: none; border-radius: 4px; color: #fff; display: inline-block; overflow: hidden; text-decoration: none; background-color: #2d3748; border-bottom: 8px solid #2d3748; border-left: 18px solid #2d3748; border-right: 18px solid #2d3748; border-top: 8px solid #2d3748;">Cliquez ici</a>
</body>
</html>