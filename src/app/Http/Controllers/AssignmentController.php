<?php

namespace App\Http\Controllers;

// Importando Requests
use App\Http\Requests\AssignmentRequest;
use Illuminate\Http\Request;
// Importando Serviços
use App\Services\CreateAssignmentService;
use App\Services\UpdateAssignmentService;
use App\Services\RemoveAssignmentService;
// Importando Repositórios
use App\Contracts\AssignmentRepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Description of Assignment
 * 
 * @author Rodrigo C
 */
class AssignmentController extends Controller
{
    // Variaveis
    protected $createAssignmentService;
    protected $updateAssignmentService;
    protected $removeAssignmentService;
    protected $assignmentRepository; 
    
    public function __construct(AssignmentRepositoryInterface $repository)
    {
        $this->assignmentRepository = $repository;         
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cod_user = null, $status_task = null)
    {
        $objAssignment = $this->assignmentRepository->getAllAssignmentsWithUserWithTask($cod_user, $status_task);        
        
        if(collect($objAssignment)->isEmpty()){            
            return null;
        }else{
            return $objAssignment;
        }
    }

   /**
     *
     * Method: Processamento Atribuir tarefas a um determinado USUÁRIO
     * Campos obrigatórios:
     * - codigo_usuario 
     * - codigo_tarefa
     * ROUTE: {{url_base }}/atribuicoes/cadastrar
     * Request: POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignmentRequest $request)
    {
        // Captando os dados do formulário, e deixando-os no formato array
        $data = $request->only([
            'codigo_usuario',
            'codigo_tarefa'
        ]);        
        
        try {
            $this->createAssignmentService = new CreateAssignmentService();
            $objAssignment = $this->createAssignmentService->createAssignment($data);
            
        } catch (\Exception $e) {
            // Retorno
            return response()->json([
                    'mensagem' => $e->getMessage(),
                    'resposta' => false,
                    ], 500);
        }

        // Retorno sucesso
        return response()->json([
                'mensagem' => $objAssignment->mensagem,
                'resposta' => $objAssignment->resposta,
                'id' => $objAssignment->id,
                ],  200);
    }

}
