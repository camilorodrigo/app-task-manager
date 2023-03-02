<?php
namespace Tests\App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

# php artisan test --filter=AuthControllerTest
class AuthControllerTest extends TestCase
{
    # php artisan test --filter=AuthControllerTest::test_login
    public function test_login()
    {       
        $credentials = array(
            'email' => 'rcamilo@e-get.com.br',
            'password' => '123'
        );

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Não autorizado'], 401);
        }
        
        $this->assertIsString($token, "Token deveria ser uma String!");
       
    }

    # php artisan test --filter=AuthControllerTest::test_usuario_not_int
    public function test_usuario_not_int()
    {   
        dump(response()->json(auth()->user()));
        $this->assertFalse(is_int(response()->json(auth()->user())), "Retorno deveria ser um array de objetos");
    }
}
