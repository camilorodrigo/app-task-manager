<?php

namespace Tests\App\Http\Services;

use App\Services\CheckDataService;
use Tests\TestCase;
# php artisan test --filter=CheckDataServiceTest
class CheckDataServiceTest extends TestCase
{
    private $id = 1;
    # php artisan test --filter=CheckDataServiceTest::testCheckTaskExists
    public function testCheckTaskExists()
    {
        $service = new CheckDataService();
        $objectArray = $service->checkTaskExists($this->id);
        $this->assertIsObject($objectArray, "Não está retornando um array de objetos com o id informado!");
    }
    
    # php artisan test --filter=CheckDataServiceTest::testCheckUserExists
    public function testCheckUserExists()
    {
        $service = new CheckDataService();
        $objectArray = $service->checkUserExists($this->id);
        $this->assertIsObject($objectArray, "Não está retornando um array de objetos com o id informado!");
    }

    # php artisan test --filter=CheckDataServiceTest::testCheckThereIsAssignmentInTask
    public function testCheckThereIsAssignmentInTask()
    {
        $service = new CheckDataService();
        $objectArray = $service->checkThereIsAssignmentInTask($this->id);
        $this->assertIsObject($objectArray, "Não está retornando um array de objetos com o id informado!");
    }
    # php artisan test --filter=CheckDataServiceTest::testCheckIfEmailAlreadyExists
    public function testCheckIfEmailAlreadyExists()
    {
        $email = "rcamilo@e-get.com.br";
        $service = new CheckDataService();
        $total = $service->checkIfEmailAlreadyExists($email);
        dump($total);
        $this->assertIsInt($total, "Não está retornando um número inteiro");
    }

    # php artisan test --filter=CheckDataServiceTest::testCheckIfTitleTaksAlreadyExists
    public function testCheckIfTitleTaksAlreadyExists()
    {
        $title = "REGISTRAR USUÁRIO SISTEMA E-GET";
        $service = new CheckDataService();
        $total = $service->checkIfTitleTaksAlreadyExists($title);
        dump($total);
        $this->assertIsInt($total, "Não está retornando um número inteiro");
    }
}
