<?php
/**
 * Description of NumeroExtenso.php
 *
 * @author Diogo
 * @copyright (c) 09/12/2019, Diogo Cardoso
 * @version 1.0
 **/
class NumeroExtenso
{
    private static $erro;
    private static $unidades=array(
        1=>array("","um","dois","três","quatro","cinco","seis","sete","oito","nove"),
        2=>array("","dez","vinte","trinta","quarenta","cinquenta","sessenta","setenta","oitenta","noventa"),
        3=>array("","cento","duzentos","trezentos","quatrocentos","quinhentos","seiscentos","setecentos","oitocentos","novecentos"),
        4=>array("","mil","milhão","bilhão","trilhão","quatrilhão"),
        5=>array("","mil","milhões","bilhões","trilhões","quatrilhões")
    );
    /**
     * Gera o texto do número por extenso
     *
     * @param Int $numero
     *
     * @return String
     **/
    public static function show($numero){
        $texto = "";

        if($numero<0){
            $texto.="menos ";
            $numero = str_replace("-","",$numero);
        }
        //Verifica se o número informado é válido
        if (self::valida($numero)) {
            $num = number_format($numero,2,".",".");
            $array = explode(".",$num);
            unset($array[count($array)-1]);

            $i=0;
            $uni = count($array);

            foreach($array as $numero){
                $numero = (int) $numero;
                $n = mb_strlen($numero);

                if($i>0 && $numero>0){
                    $texto.= " e ";
                }

                switch ($n){
                    case 3:
                        $texto.= self::dec_3($numero);
                        break;
                    case 2:
                        $texto.= self::dec_2($numero);
                        break;
                    case 1:
                        $texto.= self::dec_1($numero);
                        break;
                }

                $texto.= self::label($uni,$numero);

                $i++;
                $uni--;
            }
        }else{
            $texto=self::$erro;
        }

        return $texto;
    }

    /*Methods privates*/

    /**
     * Verifica o numero informado e gera o texto da unidade conforme necessário
     *
     * @param Int $unidade
     * @param Int $numero
     *
     * @return String
     **/
    private static function label($unidade,$numero){
        $tmp = "";
        if($unidade>1){
            $p = ($numero==1) ? 4 : 5;
            $tmp.= " " . self::$unidades[$p][$unidade-1];
        }

        return $tmp;
    }
    /**
     * Gera o texto da unidade quando o numero informado possui três casas decimais
     *
     * @param Int $num
     *
     * @return String
     **/
    private static function dec_3($num){
        $p = substr($num,0,1);
        $f = substr($num,1,2);

        if($num==100){
            $tmp = " cem ";
        }else{
            $tmp = self::$unidades[3][$p];
            $tmp.= " e ";
            $tmp.= self::dec_2($f);
        }

        return $tmp;
    }
    /**
     * Gera o texto da unidade quando o numero informado possui duas casas decimais
     *
     * @param Int $num
     *
     * @return String
     **/
    private static function dec_2($num){
        if($num>10 && $num<20){
            $uni = array(11=>"onze",12=>"doze",13=>"treze",14=>"quatorze",15=>"quinze",16=>"dezesseis",17=>"dezessete",18=>"dezoito",19=>"dezenove");
            $tmp = $uni[$num];
        }else{
            if($num<10){
                $tmp = self::dec_1((int) $num);
            }else{
                $i=substr($num,0,1);
                $f=substr($num,1,1);

                $tmp = self::$unidades[2][$i];
                if($f>0){
                    $tmp.= " e ";
                    $tmp.= self::dec_1($f);
                }
            }
        }

        return $tmp;
    }
    /**
     * Gera o texto da unidade quando o numero informado possui uma casa decimal
     *
     * @param Int $num
     *
     * @return String
     **/
    private static function dec_1($num){
        return self::$unidades[1][$num];
    }

    private static function valida($numero){
        $tmp = FALSE;

        if(preg_match('/^[1-9][0-9]*$/', $numero)){
            if($numero>999999999){
                self::$erro = "Número inválido, o número informado precisa ser menor que 99999";
            }else{
                $tmp = TRUE;
            }
        }else{
            self::$erro = "Número inválido, o número informado precisa ser inteiro";
        }

        return $tmp;
    }
}