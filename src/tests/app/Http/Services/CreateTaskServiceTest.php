<?php

namespace Tests\App\Http\Services;
use App\Services\CreateTaskService;
use Tests\TestCase;

# php artisan test --filter=CreateTaskServiceTest
class CreateTaskServiceTest extends TestCase
{
    # php artisan test --filter=CreateTaskServiceTest::testCreateTask
    public function testCreateTask()
    {
        $attributes = array(
            'titulo' => "TASK TEST 6",
            'descricao' => "ONE TASK TEST",
            'data_inicio' => '03/03/2023',
            'data_fim' => '04/03/2023'
        );
        
        $service = new  CreateTaskService();
        $retorno = $service->createTask($attributes);
        $this->assertNotNull($retorno, "Retorno não pode ser nulo");
       if($retorno->resposta === true){        
            $this->assertIsObject($retorno, "Retorno precisa ser um objeto");
            $this->assertEquals(3,collect($retorno)->count());            
        }else{
            $this->assertIsObject($retorno, "Retorno precisa ser um objeto");
            $this->assertEquals(2,collect($retorno)->count());
            
        }
    }
}
