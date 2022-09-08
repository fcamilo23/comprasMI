<?php 
	function buscarPedidos($homeModel, $texto){
        $homeModel->query('SELECT * FROM pedido where titulo LIKE "%' . $texto . '%"');
        $rows2 = $homeModel->resultSet();

        return $rows2;
    }

    function buscarViajes($homeModel, $texto){
        $homeModel->query('SELECT * FROM viaje where destino LIKE "%' . $texto . '%" and fechaArribo >= DATE(NOW())');
        $rows2 = $homeModel->resultSet(); 
    
        return $rows2;
    }
?>