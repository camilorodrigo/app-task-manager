<?php

namespace App\Http\Controllers;

// Importando Requests
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
// Importando Serviços
use App\Services\CreateTaskService;
use App\Services\UpdateTaskService;
use App\Services\RemoveTaskService;
// Importando Repositórios
use App\Contracts\TaskRepositoryInterface;
use Illuminate\Support\Collection;

class TaskController extends Controller
{
     // Variaveis
    protected $createTaskService;
    protected $updateTaskService;
    protected $removeTaskService;
    protected $taskRepository; 
    
    public function __construct(TaskRepositoryInterface $repository)
    {
        $this->taskRepository = $repository;         
    }  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $objTask = $this->taskRepository->getAll();
        
        if(collect($objTask)->isEmpty()){
            
            return null;

        }else{
             // Retorno sucesso
            return $objTask;
        }
    }

    /**
     *
     * Method: Processamento do Cadastro de TAREFAS
     * Campos obrigatórios:
     * - titulo 
     * - descricao
     * - data_inicio
     * - data_fim
     * ROUTE: {{url_base }}/tarefas/cadastrar
     * Request: POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        // Captando os dados do formulário, e deixando-os no formato array
        $data = $request->only([
            'titulo',
            'descricao',
            'data_inicio',
            'data_fim'
        ]);        
        
        try {
            $this->createTaskService = new CreateTaskService();
            $objTask = $this->createTaskService->createTask($data);
            
        } catch (\Exception $e) {
            // Retorno
            return response()->json([
                    'mensagem' => $e->getMessage(),
                    'resposta' => false,
                    ], 500);
        }

        // Retorno sucesso
        return response()->json([
                'mensagem' => $objTask->mensagem,
                'resposta' => $objTask->resposta,
                'id' => $objTask->id,
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
       $objTask = $this->taskRepository->findOneTaskById($id);
        
        if(collect($objTask)->isEmpty()){
            // Retorno sucesso
            return response()->json([
                    'mensagem' => 'Sucesso',
                    'data' => 'Não há dados cadastrados',                
                    ], 200);

        }else{
             // Retorno sucesso
            return response()->json([
                    'mensagem' => 'Sucesso',
                    'data' => $objTask,
                    'resposta' => true,                
                    ],  200);
        }
    }

    /**
     * Method: Edição de uma tarefa já existente
     * Campos obrigatórios:
     * - titulo 
     * - descricao
     * - data_inicio
     * - data_fim
     * ROUTE: {{url_base }}/tarefas/editar/{id}
     * Request: PUT
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        // Captando os dados do formulário, e deixando-os no formato array
        $data = $request->only([
            'titulo',
            'descricao',
            'data_inicio',
            'data_fim'
        ]);        
        
        try {

           $this->updateTaskService = new UpdateTaskService();
           $objTask = $this->updateTaskService->updateTask($data, $id);
            
        } catch (\Exception $e) {

            // Retorno
            return response()->json([
                    'mensagem' => $e->getMessage(),
                    'resposta' => false,
                    ], 500);
        }

        // Retorno sucesso
        return response()->json([
                'mensagem' => $objTask->mensagem,
                'resposta' => $objTask->resposta,                
                ],  200);
    }

   /**
     * Remoção de uma tarefa e seus adendos (Soft Delete)
     * @access public
     * @param $id
     * @return object
      * */
    public function destroy($id)
    {
        try {
            $this->removeTaskService = new RemoveTaskService();
            $objTask = $this->removeTaskService->removeTaskWithAssignments($id);
        } catch (\Exception $e) {

            // Retorno
            return response()->json([
                    'mensagem' => $e->getMessage(),
                    'resposta' => false,
                    ], 500);
        }

        // Retorno sucesso
        return response()->json([
                'mensagem' => $objTask->mensagem,
                'resposta' => $objTask->resposta,
                ], 200);
    }

}
