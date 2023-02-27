<?php

namespace App\Http\Controllers;

// Importando Requests
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
// Importando Serviços
use App\Services\CreateUserService;
// Importando Repositórios
use App\Contracts\UserRepositoryInterface;
use Illuminate\Support\Collection;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
