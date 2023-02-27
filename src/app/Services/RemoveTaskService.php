<?php
namespace App\Services;

// Importando Serviços
use App\Services\CheckDataService;
// Importando Repositórios
use App\Repositories\TaskRepository;
use App\Repositories\AssignmentRepository;
use Illuminate\Support\Collection;


/**
 * Description of RemoveTaskService
 * Serviço para remover uma tarefa, assim como também, podendo remover uma tarefa junto com suas atribuições
 * Regras de negócio para remover uma tarefa nesse sistema
 * SERVICE PATTERN
 * Referência Bibliográfica: EVANS, E. Domain-Driven Design – Atacando as complexidades no coração do software.
 * Um serviço tem de a ser nomeado de acordo com uma atividade ele é um verbo ao invés de um substantivo.
 *
 * @author Rodrigo C
 */
class RemoveTaskService
{
    protected $taskRepository;
    protected $assignmentRepository;
    protected $createTaskService;
    protected $checkDataService;
    
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
     * Remoção de uma tarefa junto com suas atribuições
     * @access public
     * @param $id
     * @return object
      * */
    public function removeTaskWithAssignments($id): object
    {
         // Serviço para verificar os dados  
        $objTask = $this->checkDataService->checkTaskExists($id); 
        
        if(collect($objTask)->isEmpty()){            
            throw new \Exception(
                'Erro: TAREFA inexistente!'
            );
        }   
        // Monto array de atualização
        $dataUpdate = array(
                            'status' => 2 // 2 = Tarefa Excluída;
                        );
        // Atualizo
        $task = collect($this->taskRepository->update($dataUpdate, $objTask->cod_task))->toArray();        
        if (count($task) <= 0) {
            return (object) array(
                'resposta' => false,                
                'mensagem' => 'Falha na exclusão da Tarefa'
            );
        } 
        
        $objAssignment = $this->checkDataService->checkThereIsAssignmentInTask($objTask->cod_task); 
                
        if (collect($objAssignment)->isNotEmpty()) {
            
            $this->assignmentRepository = new AssignmentRepository(); 
            
            // Monto array de atualização
            $dataAssignmentUpdate = array(
                'status' => 3 // 1 = Concluída; 2 = Em andamento; 3 = Cancelada; 
            );
            // Atualizo
            $executionAssignment = collect($this->assignmentRepository->update($dataAssignmentUpdate, $objAssignment->cod_assignment))->toArray();
            if (count($executionAssignment) <= 0) {
                return (object) array(
                        'resposta' => false,
                        'mensagem' => 'Falha na exclusão da Atruição da Tarefa'
                );
            } else {
                return (object) array(
                        'mensagem' => 'Sucesso',
                        'resposta' => true
                );
            }
        }else{
            
            return (object) array(
                        'mensagem' => 'Sucesso',
                        'resposta' => true
                );
        }

    }

}