<?php

namespace Tests\App\Http\Services;

use Tests\TestCase;
use App\Services\CreateUserService;

# php artisan test --filter=CreateUserServiceTest
class CreateUserServiceTest extends TestCase
{
     # php artisan test --filter=CreateUserServiceTest::testCreateUser
     public function testCreateUser()
     {
        $attributes = array(
             'nome' => "RODRIGO",
             'email' => "r@gmail.com",
             'senha' => '123'
         );
         
         $service = new  CreateUserService();
         $retorno = $service->createUser($attributes);
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
