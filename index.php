<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Número por Extenso</title>
</head>
<body>
<?php
    include_once 'NumeroExtenso.php';

    if(isset($_GET['num'])){
        $tmp = NumeroExtenso::show($_GET['num']);
    }else{
        $tmp = "Informe o numero pela variavel ?num=";
    }

    echo json_encode(array("extenso"=>$tmp));exit;
?>
</body>
</html>
