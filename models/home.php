
<?php 


class HomeModel extends Model{
	public function index(){

	
        $this->query('SELECT * FROM `itemOrden` 
                    JOIN ordenes ON itemOrden.idOrden = ordenes.id
                    WHERE ordenes.estado="activo" AND (esservicio = "General" OR esservicio="Licencia") and itemOrden.fin >= (select curdate()) ORDER BY itemOrden.fin ASC limit 10');
        $row = $this->resultSet();

        return $row;
		
		
	}

        public function cotizaciones(){
                $anio = date('Y');
                $_SESSION['anioCotizacion'] = $anio;

                $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
             

                if(isset($post) && isset($post['submit'])){
                        if(isset($post['anio'])){
                                $anio = $post['anio'];
                                $_SESSION['anioCotizacion'] = $anio;
                                $_SESSION['anioCotizacion'] = $anio;

                        }

                        if($post['submit'] == "Confirmar"){
                                $this->query('SELECT * FROM cotizaciones WHERE anio = "'.$post['anioNuevo'].'"');
                                $hay = $this->single();

                                if($hay == null){
                                        $this->query('INSERT INTO cotizaciones(anio,moneda,valor) VALUES("'.$post['anioNuevo'].'", "Dolar", "'.$post['dolar'].'")');
                                        $this->execute();

                                        $this->query('INSERT INTO cotizaciones(anio,moneda,valor) VALUES("'.$post['anioNuevo'].'", "€ (Euro)", "'.$post['euro'].'")');
                                        $this->execute();

                                        $this->query('INSERT INTO cotizaciones(anio,moneda,valor) VALUES("'.$post['anioNuevo'].'", "U.I.(Unidades Indexadas)", "'.$post['ui'].'")');
                                        $this->execute();

                                        $this->query('INSERT INTO cotizaciones(anio,moneda,valor) VALUES("'.$post['anioNuevo'].'", "U.R. (Unidades Reajustables)", "'.$post['ur'].'")');
                                        $this->execute();
                                }else{
                                        Messages::setMsg('Ya existe una instancia de cotizaciones para el año ingresado', 'error');

                                }

                                
                                

                        }

                        if($post['submit'] == "Guardar Cambios"){

                               
                                $this->query('UPDATE cotizaciones SET valor="'.$post['1'].'" WHERE moneda = "Dolar" AND anio = "'.$post['anioc'].'" ');
                                $this->execute();

                                $this->query('UPDATE cotizaciones SET valor="'.$post['4'].'" WHERE moneda = "U.R. (Unidades Reajustables)" AND anio = "'.$post['anioc'].'" ');
                                $this->execute();

                                $this->query('UPDATE cotizaciones SET valor="'.$post['2'].'" WHERE moneda = "€ (Euro)" AND anio = "'.$post['anioc'].'" ');
                                $this->execute();

                                $this->query('UPDATE cotizaciones SET valor="'.$post['3'].'" WHERE moneda = "U.I.(Unidades Indexadas)" AND anio = "'.$post['anioc'].'" ');
                                $this->execute();

                                


                                header('Location: '.ROOT_URL.'home/cotizaciones');
                                //echo $post['Dolar'];

                        }


                        

                    }

                $this->query('SELECT * FROM cotizaciones GROUP BY anio');
                $row = $this->resultSet();

                $this->query('SELECT * FROM cotizaciones WHERE anio = "'.$anio.'" ORDER BY id');
                $_SESSION['cotizaciones'] = $this->resultSet();
                
                return $row;
                         
                        
                }



	
}