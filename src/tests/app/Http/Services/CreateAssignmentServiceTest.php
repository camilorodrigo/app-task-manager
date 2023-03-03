<?php

namespace Tests\App\Http\Services;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Services\CreateAssignmentService;

# php artisan test --filter=CreateAssignmentServiceTest
class CreateAssignmentServiceTest extends TestCase
{
    # php artisan test --filter=CreateAssignmentServiceTest::testCreateAssignment
    public function testCreateAssignment()
    {
        $attributes = array(
            'codigo_usuario' => 1,
            'codigo_tarefa' => 1
        );
        $service = new  CreateAssignmentService();
        $retorno = $service->createAssignment($attributes);
        $this->assertNotNull($retorno, "Retorno não pode ser nulo");
        //$this->assertIsObject($retorno, "Retorno tem que ser um objeto");
    }
}
