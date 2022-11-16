<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\DbUnit\DataSet\YamlDataSet;
/*
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "minterior");

// Define URL
define("ROOT_PATH", "/comprasMI/");
define("ROOT_URL", "http://localhost:80/comprasMI/");

*/
    /**
     * @runInSeparateProcess
     */
class OrdenTest extends TestCase
{
    private $op;

    
    public function setUp():void
    {
        $this->op = new OrdenModel();
    }

    public function testVerOrden(){
        $this->assertContains(
            'http://localhost:80/comprasMI', $this->op->seleccionarOrden()
          );

    }

}
?>