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

    echo'<p>Új város adatainak megadása:</p>
    <form action="" method="POST">
        CountyId: <input type="number" name="newCountyId" id="newCountyId"><br>
        Név: <input type="text" id="nev" name="nev"><br>
        Irányítószám: <input type="number" id="zipCode" name="zipCode"><br>
        <input type="submit" name="adatokkuldese" value="Adatok elküldése">
        <input type="submit" name="delete" value="Törlés">
    </form>';

    echo'<p>Város keresése: </p>
    <form action="" method="POST">
        Irányítószám: <input type="number" id="zipCode" name="zipCode"><br>
        <input type="submit" name="kereses" value="Keresés">
    </form>';

require_once("osztaly.php");

$tabla=new osztaly();

if (isset($_POST['adatokuldese'])) {
    $countyId = $_POST['newCountyId'];
    $nev = $_POST['nev'];
    $iranyitoszam = $_POST['zipCode'];

    $tabla->ujvarosok($countyId,$nev,$iranyitoszam);

}
 
if (isset($_POST['delete'])) {
    $countyId = $_POST['newCountyId'];
    $nev = $_POST['nev'];
    $iranyitoszam = $_POST['zipCode'];

    $tabla->delete($countyId,$nev,$iranyitoszam);

}

if (isset($_POST['kereses'])) {
    $iranyitoszam = $_POST['zipCode'];

    $eredmenyek = $tabla->kereses($iranyitoszam);

    foreach ($eredmenyek as $eredmeny)
    {
        $megyek = $tabla->keresMegye($eredmeny['countyId']);
    
        foreach ($megyek as $megye)
        {
            echo '<form method="POST" action="varosok.php">'
            .'<tr>'
                .'<td>Megye:'.$megye['county'].'  </td>'
                . '<td>Város: '.$eredmeny['city'].' </td>'
                .'</td>Irányítószám: '.$eredmeny['zip_code'].' </td>'
            . '</tr></form>';
        }  
    }  

}




    ?>
</body>
</html>