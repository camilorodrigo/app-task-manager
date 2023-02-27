<?php
namespace App\Repositories;

use DB;
use App\Contracts\AssignmentRepositoryInterface;
use App\Models\Assignment;
/**
 * Description of TaskRepository
 * Repositório para Tarefas
 *
 * @author Rodrigo C
 */
class AssignmentRepository extends AbstractRepository implements AssignmentRepositoryInterface
{
    protected $model = Assignment::class;
    
     public function getAllAssignmentsWithUserWithTask($cod_user = null, $status_task = null)
    {    
        //===================================================================================
        // Montando condição para clausula WHERE de acordo com os campos preenchidos no form
        //===================================================================================         
         // Inicializando variável
        $where[] = 'tasks.status <> 2'; // 1= Ativa; 2 = Excluida;        
         /* Montando condição para clausula WHERE de acordo com os campos */   
        if (!empty($cod_user)) {
            $where[] = 'users.cod_user = ' . $cod_user; // Filtro
        }        
        if (!empty($status_task)) {
            $where[] = 'assignments.status = "' . $status_task. '" '; // Filtro
        } 
        // Junta elementos de uma matriz / vetor em uma string com delimitador definido
        $condition = implode(' AND ', $where);
        
        $busca = $this->model::join('tasks', 'assignments.cod_task', '=', 'tasks.cod_task')
                             ->join('users', 'assignments.cod_user', '=', 'users.cod_user')
                             ->select('users.cod_user','users.name','tasks.title','tasks.start_date','tasks.end_date','assignments.status AS status_task','assignments.designated_by')
                             ->whereRaw($condition)
                             ->get(); 
                       
        return $busca;
    }

}