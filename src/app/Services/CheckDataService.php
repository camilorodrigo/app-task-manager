<?php
namespace App\Services;

// Importando Repositórios
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use App\Repositories\AssignmentRepository;

/**
 * Description of checkDataService
 * Checar dados pertinentes
 * SERVICE PATTERN
 * Referência Bibliográfica: EVANS, E. Domain-Driven Design – Atacando as complexidades no coração do software.
 * Um serviço tem de a ser nomeado de acordo com uma atividade ele é um verbo ao invés de um substantivo.
 *
 * @author Rodrigo C
 */
class CheckDataService
{
    protected $userRepository;  
    protected $taskRepository;
    protected $assignmentRepository;
  

    /**
     *
     * Verificar se o id da tarefa informado existe na base de dados
     * @access public
     * @param $id
     * @return object
     *
     * */
    public function checkTaskExists(int $id):object
    {
        $this->taskRepository = new TaskRepository();
        $busca = $this->taskRepository->findOneTaskById($id);        
        return $busca;
    }
    
    /**
     *
     * Verificar se o id do usuário informado existe na base de dados
     * @access public
     * @param $id
     * @return object
     *
     * */
    public function checkUserExists(int $id):object
    {
        $this->userRepository = new UserRepository();
        $busca = $this->userRepository->find($id);        
        return $busca;
    }
    
    /**
     *
     * Verificar se há atribuições atreladas a uma tarefa
     * @access public
     * @param $id
     * @return object
     *
     * */
    public function checkThereIsAssignmentInTask(int $cod_task):object
    {
        $this->assignmentRepository = new AssignmentRepository();
        $busca = $this->assignmentRepository->findOneAssignmentByIdTask($cod_task);        
        return $busca;
    }
    
    /**
     *
     * Verificar se o E-MAIL já existe na base de dados
     * @access public
     * @param $email
     * @return int
     *
     * */
    public function checkIfEmailAlreadyExists(String $email):int
    {
        $this->userRepository = new UserRepository(); 
        $total = $this->userRepository->countByEmail($email);
        return $total;
    }
    
    /**
     *
     * Verificar se o TÍTULO da Tarefa já existe na base de dados
     * @access public
     * @param $title
     * @return int
     *
     * */
    public function checkIfTitleTaksAlreadyExists(String $title):int
    {
         $this->taskRepository = new TaskRepository();
         $total = $this->taskRepository->countByTitle($title);
         return $total;
    }   


}