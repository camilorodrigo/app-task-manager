<?php

namespace Tests\App\Http\Services;

use Tests\TestCase;
use App\Services\RemoveTaskService;

# php artisan test --filter=RemoveTaskServiceTest
class RemoveTaskServiceTest extends TestCase
{
    # php artisan test --filter=RemoveTaskServiceTest::testRemoveTaskWithAssignments
    public function testRemoveTaskWithAssignments()
    {
        $idTask = 1; 
        $service = new  RemoveTaskService();
        $retorno = $service->removeTaskWithAssignments($idTask);
        
        if($retorno->resposta === true){        
            
            $this->assertNotNull($retorno, "Retorno não pode ser nulo");
            $this->assertIsObject($retorno, "Retorno precisa ser um objeto");
            $this->assertEquals(2,collect($retorno)->count());            
        }else{
            $this->assertIsObject($retorno, "Retorno precisa ser um objeto");
            $this->assertEquals(2,collect($retorno)->count());
            
        }
    }
}
