<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Városok</title>
</head>
<body class="hatter">
    <header>
        <div class="cim">
            <h1>Megyék és Városaik</h1>
        </div>
    </header>

    <h2>Válassza ki a megyét:</h2> 

    <?php

    require_once('osztaly.php');
    

   $tabla=new osztaly();

   $megyek=$tabla->counties();
   


    foreach ($megyek as $megye)
    {
     echo '<form method="POST" action="varosok.php">'
     .'<tr>'
         .'<td> <button  class="button" value="'.$megye['countyId'].'" name="megye-button">'.$megye['county'].'</button> </td>'
         . '<td><div style="display: flex">'
         . '</div></td>'
     . '</tr></form>';
    }
 



    ?>
</body>
</html>