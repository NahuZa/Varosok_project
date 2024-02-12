<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Listázás</title>
</head>
<body class="hatter">
    <?php

    require_once("osztaly.php");

    $tabla=new osztaly();
    
        /*if (isset($_POST['megye-button'])) {
                $id =$_POST['megye-button'];
                $varosok = $tabla->varosok($id);
                foreach ($varosok as $varos)
                {
                echo '<form method="POST" action="">'
                .'<tr>'
                    .'<td>'.$varos['city'].'</td>'
                    . '<td><div style="display: flex">'
                    . '</div></td>'
                . '</tr></form>';
                }
        }*/

    if (isset($_POST['megye-button'])) {
        $id =$_POST['megye-button'];
        $karakterek = $tabla->getAbc($id);
        foreach ($karakterek as $karakter)
        {
            echo '<form method="POST" action="">'
            .'<tr>'
                .'<td> <button class="button" value="'.$karakter.'" name="abc-button">'.$karakter.'</button></td>'
                . '<td><div style="display: flex">'
                . '</div></td>'
            . '</tr></form>';
        }
    }

    if (isset($_POST['abc-button'])) {
        $ch = $_POST['abc-button'];
        $cities = $tabla->getCityByCh($ch);
        foreach ($cities as $city)
        {
        echo '<form method="POST" action="">'
        .'<tr>'
            .'<td>'.$city['city'].'</td>'
            .'<td>'.$city['zip_code'].'</td>'
            . '<td><div style="display: flex">'
            . '</div></td>'
        . '</tr></form>';
        }
    }
    ?>
    
</body>
</html>