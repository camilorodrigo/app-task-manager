<?php
namespace App\Services;

// Importando Serviços
use App\Services\CheckDataService;
// Importando Repositórios
use App\Repositories\TaskRepository;
use App\Repositories\AssignmentRepository;
use Illuminate\Support\Collection;
// Importando minhas bibliotecas
use App\Libraries\GlobalFunctions;
use Hash;

/**
 * Description of CreateAssignmentService
 * Serviço para criar uma Tarefa
 * Regras de negócio para atribuir uma tarefa nesse sistema.
 * SERVICE PATTERN
 * Referência Bibliográfica: EVANS, E. Domain-Driven Design – Atacando as complexidades no coração do software.
 * "Um serviço tem de a ser nomeado de acordo com uma atividade ele é um verbo ao invés de um substantivo".
 *
 * @author Rodrigo C
 */
class CreateAssignmentService
{
    protected $checkDataService;
    protected $taskRepository;
    protected $assignmentRepository;
    
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
        $this->assignmentRepository = new AssignmentRepository();       
    }
    
    /**
     * Criar nova Atribuição
     *    Exemplo de parametros:
     *    $dados = [
     *      'codigo_usuario' => 1,
     *      'codigo_tarefa' => 2
     *    ]
     * @access public
     * @param array $attributes
     * @return object
      * */
    public function createAssignment(array $attributes): object {

         // Serviço para verificar os dados  
        $objTask = $this->checkDataService->checkTaskExists($attributes['codigo_tarefa']);        
        if(collect($objTask)->isEmpty()){            
            throw new \Exception(
                'Erro: TAREFA inexistente!'
            );
        }  
        // Serviço para verificar os dados  
        $objUser = $this->checkDataService->checkUserExists($attributes['codigo_usuario']);        
        if(collect($objUser)->isEmpty()){            
            throw new \Exception(
                'Erro: USUÁRIO inexistente!'
            );
        }  
        $dataInsert = array(
            'cod_user' => $attributes['codigo_usuario'],
            'cod_task' => $attributes['codigo_tarefa'],
            'designated_by' => auth()->user()->cod_user,
            'status' => 2 // 1 = Concluída; 2 = Em andamento; 3 = Cancelada; 
        );
        $assignment = $this->assignmentRepository->create($dataInsert);
        if (collect($assignment)->isEmpty()) {        
            return (object) array(
                    'resposta' => false,
                    'mensagem' => 'Falha na atribuição da Tarefa'
            );
        } else {
                return (object) array(
                        'mensagem' => 'Sucesso',
                        'resposta' => true,
                        'id' => $assignment->cod_assignment
                );
        }
    }

}