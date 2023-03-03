<?php

namespace Tests\App\Http\Services;

use Tests\TestCase;
use App\Services\UpdateTaskService;

class UpdateTaskServiceTest extends TestCase
{
    # php artisan test --filter=UpdateTaskServiceTest::testUpdateTask
    public function testUpdateTask()
    {
        $idTask = 1; 
        $attributes = array(
            'titulo' => "ONE TASK",
            'descricao' => "ONE TASK TEST",
            'data_inicio' => '04/03/2023',
            'data_fim' => '05/03/2023'
        );
        
        $service = new  UpdateTaskService();
        $retorno = $service->updateTask($attributes, $idTask);
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
