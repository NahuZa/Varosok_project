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
    <div class="lista">
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
    </div>
    <div class="adatbekeres">
    <?php
    echo'<h3>Új város adatainak megadása:</h3>
    <form action="" method="POST">
        CountyId: <input type="number" name="newCountyId" id="newCountyId"><br>
        Név: <input type="text" id="nev" name="nev"><br>
        Irányítószám: <input type="number" id="zipCode" name="zipCode"><br>
        <input class="button" type="submit" name="adatokkuldese" value="Adatok elküldése">
        <input  class="button" type="submit" name="delete" value="Törlés">
    </form>';

   

require_once("osztaly.php");

$tabla=new osztaly();

if (isset($_POST['adatokkuldese'])) {
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

echo'<h3>Város keresése: </h3>
<form action="" method="POST">
    Irányítószám: <input type="number" id="keresesCode" name="keresesCode"><br>
    <input class="button" type="submit" name="kereses" value="Keresés">
</form>';

if (isset($_POST['kereses'])) {
    $iranyitoszam = $_POST['keresesCode'];

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


echo '
    </form>
    <h3>Adatok szerkesztése</h3>
    <form method="POST" action="">
        <label for="iranyitoszambe">Szerkesztendő adat Irányítószáma:</label><br>
            <input type="number" id="iranyitoszambe" name="iranyitoszambe" required><br>
        <label for="uj_id">Új ID:</label><br>
            <input type="number" id="uj_id" name="uj_id" required><br>
        <label for="uj_city">Új város:</label><br>
            <input type="text" id="uj_city" name="uj_city" required><br>
        <label for="uj_iranyitoszam">Új irányítószám:</label><br>
            <input type="number" id="uj_iranyitoszam" name="uj_iranyitoszam" required><br><br>
            <input class="button" type="submit" name="edit" value="Frissítés">
    </form>
    ';

if(isset($_POST['edit'])){
    $iranyitoszambe=$_POST['iranyitoszambe'];
    $ujId=$_POST['uj_id'];
    $ujVaros=$_POST['uj_city'];
    $ujIranyitoszam=$_POST['uj_iranyitoszam'];

    $tabla->update($iranyitoszambe,$ujId,$ujVaros,$ujIranyitoszam);
}

    ?>
</div>
</body>
</html>