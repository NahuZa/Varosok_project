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
    
        if (isset($_POST['megye-button'])) {
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
            }
    ?>
    
</body>
</html>