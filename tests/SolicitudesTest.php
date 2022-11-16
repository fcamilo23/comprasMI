<?php
use PHPUnit\Framework\TestCase;

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "minterior");

// Define URL
define("ROOT_PATH", "/comprasMI/");
define("ROOT_URL", "http://localhost:80/comprasMI/");

class SolicitudesTest extends TestCase
{
    private $op;
    
    public function setUp():void
    {
        $this->op = new SolicitudesModel();
    }
    public function testlistaSolicitudes(){
        $this->assertIsArray($this->op->listaSolicitudes());
    }

}
?>