<?php
namespace App\Services;

// Importando Serviços
use App\Services\CheckDataService;
// Importando Repositórios
use App\Repositories\UserRepository;
use Illuminate\Support\Collection;
// Importando minhas bibliotecas
use App\Libraries\GlobalFunctions;
use Hash;

/**
 * Description of CreateUserService
 * Serviço para criar um usuario
 * Regras de negócio para criar um usuario nesse sistema.
 * SERVICE PATTERN
 * Referência Bibliográfica: EVANS, E. Domain-Driven Design – Atacando as complexidades no coração do software.
 * "Um serviço tem de a ser nomeado de acordo com uma atividade ele é um verbo ao invés de um substantivo".
 *
 * @author Rodrigo C
 */
class CreateUserService
{
    protected $checkDataService;
    protected $userRepository;
    
    /**
     * Constructor
     * @return void
     * */
    public function __construct() 
    {
        // Instancio serviços
        $this->checkDataService = new CheckDataService(); 
        // Instancio repositorios
        $this->userRepository = new UserRepository();       
    }
    
    /**
     * Criar novo usuario
      *    Exemplo de parametros:
     *    $dados = [
     *      'nome' => RODRIGO,
     *      'email' => teste@gmail.com,
     *      'senha'=> 123
     *    ]
     * @access public
     * @param array $attributes
     * @return object
      * */
    public function createUser(array $attributes): object {

        if (GlobalFunctions::checksIfEmailIsValid($attributes['email']) == false) {
            throw new \Exception(
                    'Erro: EMAIL ilegítimo!'
            );
        }
        if ($this->checkDataService->checkIfEmailAlreadyExists($attributes['email']) > 0) {
            throw new \Exception(
                    'Erro: Esse USUARIO já existe na base de dados!'
            );
        }
        $dataInsert = array(
            'name' => GlobalFunctions::changeTextToUppercase($attributes['nome']),
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['senha'])
        );
        $user = $this->userRepository->create($dataInsert);
        if (collect($user)->isEmpty()) {        
            return (object) array(
                    'resposta' => false,
                    'mensagem' => 'Falha na inserção do Usuário'
            );
        } else {
            return (object) array(
                    'mensagem' => 'Sucesso',
                    'resposta' => true,
                    'id' => $user->cod_user
            );
        }
    }

}