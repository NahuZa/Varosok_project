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
    <div style="width:100%;">
        <div class="lista">
            <h2 class="kisCimek">Városok:</h2>

        <table class="tablazat">
            <tr class="tablazat">
                <th >Települések</th>
                <th>Irányító számok</th>
            </tr>
        <?php

        require_once("osztaly.php");

        $tabla=new osztaly();
        
        if (isset($_POST['megye-button'])) {
            $id =$_POST['megye-button'];
            $varosok = $tabla->varosok($id);
            foreach ($varosok as $varos)
            {
            echo '<form method="POST" action="">'
            .'<tr>'
                .'<td>'.$varos['city'].'</td>'
                .'<td>'.$varos['zip_code'].'</td>'
                . '<td><div style="display: flex">'
                . '</div></td>'
            . '</tr></form>';
            }
    }
        ?>
        </table>
        </div>

        <div class="bal">
            <h2 class="kisCimek">Statisztikák:</h2>

            <table class="tablazat">
            <?php
                if (isset($_POST['megye-button'])) {
                $id =$_POST['megye-button'];
                $statisztikak = $tabla->getStats($id);
                foreach ($statisztikak as $statisztika)
                {
                echo '<form method="POST" action="">'
                .'<tr>'
                    .'<td>Megyeszékhelye: '.$statisztika['megyeSzekhely'].'<br></td>'
                . '</tr>'
                . '<tr>'
                    .'<td>Lakossága: '.$statisztika['lakossag'].' Fő</td>'
                    . '<td><div style="display: flex">'
                    . '</div></td>'
                . '</tr></form>';
                }
            }
            ?>
            </table>
        </div>
    </div>
</body>
</html>