<?php
namespace App\Services;

// Importando Serviços
use App\Services\CheckDataService;
// Importando Repositórios
use App\Repositories\TaskRepository;
use Illuminate\Support\Collection;

// Importando minhas bibliotecas
use App\Libraries\GlobalFunctions;

/**
 * Description of UpdateTaskService
 * Serviço para atualizar os dados de uma tarefa 
 * Regras de negócio para atualizar uma tarefa nesse sistema
 * SERVICE PATTERN
 * Referência Bibliográfica: EVANS, E. Domain-Driven Design – Atacando as complexidades no coração do software.
 * Um serviço tem de a ser nomeado de acordo com uma atividade ele é um verbo ao invés de um substantivo.
 * 
 * @author Rodrigo C
 */
class UpdateTaskService
{
    protected $checkDataService;
    protected $taskRepository;
    
    /**
     * Constructor
     * @return void
     * */
    public function __construct() 
    {
        // Instancio repositorios
        $this->checkDataService = new CheckDataService(); 
        $this->taskRepository = new TaskRepository();       
    }
    
    /**
     * Edição de um cliente já existente
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
    public function updateTask(array $attributes, int $id): object
    {
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
        // Serviço para verificar os dados  
        $objTask = $this->checkDataService->checkTaskExists($id); 
                
        if(collect($objTask)->isEmpty()){            
            throw new \Exception(
                'Erro: TAREFA inexistente!'
            );
        }        
        $titleUppercase = GlobalFunctions::changeTextToUppercase($attributes['titulo']);
        if($titleUppercase != $objTask->title){            
            if ($this->checkDataService->checkIfTitleTaksAlreadyExists($attributes['titulo']) > 0) {
                throw new \Exception(
                        'Erro: Essa TAREFA já existe na base de dados!'
                );
            }
        }        
        // Monto array de atualização
        $dataUpdate = array(
                            'title' => $titleUppercase,
                            'description' => $attributes['descricao'],
                            'start_date' => $dateStartFormated,
                            'end_date' => $dateEndFormated,
                            'status' => 1 // 1= Ativa;
                        );
        // Atualizo
        $task = collect($this->taskRepository->update($dataUpdate, $id))->toArray();        
        if (count($task) <= 0) {
            return (object) array(
                'resposta' => false,                
                'mensagem' => 'Falha na atualização da Tarefa'
            );
        } else {
            return (object) array(
                'mensagem' => 'Sucesso',
                'resposta' => true,
                'id' => $id
            );
        }
    }

}