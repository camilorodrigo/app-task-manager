<?php
namespace App\Services;

// Importando Serviços
use App\Services\CheckDataService;
// Importando Repositórios
use App\Repositories\TaskRepository;
use Illuminate\Support\Collection;
// Importando minhas bibliotecas
use App\Libraries\GlobalFunctions;
use Hash;

/**
 * Description of CreateTaskService
 * Serviço para criar uma Tarefa
 * Regras de negócio para criar uma Tarefa nesse sistema.
 * SERVICE PATTERN
 * Referência Bibliográfica: EVANS, E. Domain-Driven Design – Atacando as complexidades no coração do software.
 * "Um serviço tem de a ser nomeado de acordo com uma atividade ele é um verbo ao invés de um substantivo".
 *
 * @author Rodrigo C
 */
class CreateTaskService
{
    protected $checkDataService;
    protected $taskRepository;
    
    /**
     * Constructor
     * @return void
     * */
    public function __construct() 
    {
        // Instancio serviços
        $this->checkDataService = new CheckDataService(); 
        // Instancio repositorios
        $this->taskRepository = new TaskRepository();       
    }
    
    /**
     * Criar nova tarefa
     *    Exemplo de parametros:
     *    $dados = [
     *      'title' => Ler,
     *      'description' => Teste description,
     *      'start_date' => 25/02/2023,
     *      'end_date' => 27/02/2023,
     *      'status'=> 1= Ativa
     *    ]
     * @access public
     * @param array $attributes
     * @return object
      * */
    public function createTask(array $attributes): object {

        $dateStartFormated = date('Y-m-d', strtotime(str_replace('/', '-', $attributes['data_inicio'])));
        $dateEndFormated = date('Y-m-d', strtotime(str_replace('/', '-', $attributes['data_fim'])));
        
        if (GlobalFunctions::checksIfDateIsValid($attributes['data_inicio']) == false) {
            throw new \Exception(
                    'Erro: DATA INICIAL inválida!'
            );
        }
        if (GlobalFunctions::checksIfDateIsValid($attributes['data_fim']) == false) {
            throw new \Exception(
                    'Erro: DATA FINAL inválida!'
            );
        }
        if (GlobalFunctions::checkIfDateIsGreaterThan($dateEndFormated,$dateStartFormated) == false) {
            throw new \Exception(
                    'Erro: A DATA FINAL não pode ser menor que a INICIAL!'
            );
        }
        if ($this->checkDataService->checkIfTitleTaksAlreadyExists($attributes['titulo']) > 0) {
            throw new \Exception(
                    'Erro: Essa TAREFA já existe na base de dados!'
            );
        }
        $dataInsert = array(
            'title' => GlobalFunctions::changeTextToUppercase($attributes['titulo']),
            'description' => $attributes['descricao'],
            'start_date' => $dateStartFormated,
            'end_date' => $dateEndFormated,
            'status' => 1 // 1= Ativa;
        );
        $task = $this->taskRepository->create($dataInsert);
        if (collect($task)->isEmpty()) {        
            return (object) array(
                    'resposta' => false,
                    'mensagem' => 'Falha na inserção da Tarefa'
            );
        } else {
            return (object) array(
                    'mensagem' => 'Sucesso',
                    'resposta' => true,
                    'id' => $task->cod_task
            );
        }
    }

}