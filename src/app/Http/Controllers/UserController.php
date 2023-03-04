<?php

namespace App\Http\Controllers;

// Importando Requests
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
// Importando Serviços
use App\Services\CreateUserService;
// Importando Repositórios
use App\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    // Variaveis
    protected $createUserService;
    protected $updateUserService;
    protected $removeUserService;
    protected $userRepository; 
    
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->userRepository = $repository;         
    }  
    
    /**
     *
     * Method: Processamento do Cadastro de USUÁRIO
     * Campos obrigatórios:
     * - nome 
     * - email
     * - senha
     * ROUTE: {{url_base }}/usuarios/cadastrar
     * Request: POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
       // Captando os dados do formulário, e deixando-os no formato array
        $data = $request->only([
            'nome',
            'email',
            'senha'
        ]);        
        
        try {
            $this->createUserService = new CreateUserService();
            $objUser = $this->createUserService->createUser($data);
            
        } catch (\Exception $e) {
            // Retorno
            return response()->json([
                    'mensagem' => $e->getMessage(),
                    'resposta' => false,
                    ], 500);
        }

        // Retorno sucesso
        return response()->json([
                'mensagem' => $objUser->mensagem,
                'resposta' => $objUser->resposta,
                'id' => $objUser->id,
                ],  200);
    }  
    
}
