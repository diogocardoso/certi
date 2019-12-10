<?php
header("Content-type: text/html; charset=utf-8");
require_once 'NumeroExtenso.php';

$result = array("result"=>FALSE);

if(isset($_GET['num'])){
	$Util = new NumeroExtenso($_GET['num']);

    $numero_extenso = $Util->show();

    if($numero_extenso){
        $result['result'] = TRUE;
        $result['extenso'] = $numero_extenso;
    }else{
        $result['erro'] = $Util->get_erro();
    }
}else{
    $result['erro'] = "Informe o numero pela variavel ?num=";
}

echo json_encode($result);
