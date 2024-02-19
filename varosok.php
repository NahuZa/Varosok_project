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

        <table class="tablazatL">
            <tr class="tablazatL">
                <th >Települések</th>
                <th>Irányító számok</th>
            </tr>
        <?php

        require_once('osztaly.php');
    

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

        <div>
            <h2 class="statisztikacim">Statisztikák:</h2>

            <table class="tablazatR">
            <?php
                if (isset($_POST['megye-button'])) {
                $id =$_POST['megye-button'];
                $statisztikak = $tabla->getStats($id);
                foreach ($statisztikak as $statisztika)
                {
                echo '<form method="POST" action="">'
                .'<tr>'
                    .'<td>Megyeszékhelye: </td><td>'.$statisztika['megyeszekhely'].'<br></td>'
                . '</tr>'
                . '<tr>'
                    .'<td>Lakossága:</td><td> '.$statisztika['lakossag'].' Fő</td>'
                    . '<td><div style="display: flex">'
                    . '</div></td>'
                . '</tr></form>'
                .'<tr>'
                    .'<td>A megye zászlója: </td><td><iframe src="'.$statisztika['zaszlo'].'"style="border:none;" scrolling="no" allowfullscreen title="description"></iframe></td>'
                .'</tr>'
                .'<tr>'
                    .'<td>A megye címere: </td><td><iframe src="'.$statisztika['cimer'].'"style="border:none;" scrolling="no" allowfullscreen title="description"></iframe></td>'
                .'</tr>';
                }
            }
            ?>

            </table>
            
        </div>
    </div>


</body>
</html>