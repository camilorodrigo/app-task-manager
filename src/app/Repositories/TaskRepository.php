<?php
namespace App\Repositories;

use DB;
use App\Contracts\TaskRepositoryInterface;
use App\Models\Task;
/**
 * Description of TaskRepository
 * Repositório para Tarefas
 *
 * @author Rodrigo C
 */
class TaskRepository extends AbstractRepository implements TaskRepositoryInterface
{
    protected $model = Task::class;
        
    public function countByTitle(String $title)
    {   
        $busca = $this->model::where('title', '=', $title)->count();        
        return $busca;
    }
    public function findOneTaskById(int $id)
    {   
        $busca = $this->model::where('cod_task', '=', $id)
                             ->first();        
        return $busca;
    }
   
}