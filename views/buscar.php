<?php

    required('../config.php');

    $con = new PDO(mysql:host="localhost";dbname="laboratorio", "root", "");

    $this->query('SELECT * FROM pedido');
    $rows2 = $this->resultSet();

   /* $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    stripos(string $haystack, string $needle, int $offset = 0)
    $rows = array();
    $texto = $post['mensaje'];
    if(isset($rows2)){
        $cant = 0;
        foreach($rows2 as $item){
            if(stripos($item['titulo'], $texto, int $offset = 0)){
                $rows[$cant] = $item2;
            }
            $cant = $cant + 1;
        }

        if(isset($rows)){
            for($i=0;$i<count($rows2);$i++)
            {
                $_SESSION['busqueda'][$i]	= $rows[$i];
            }
        }
    }*/

    $html="";
    foreach ($rows2 as $v)
        $html.="<p>".$v['titulo']."</p>";
    echo $html;
    else:
        echo "Error";
    endif;
?>