<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class AssignmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'codigo_usuario' => 'required|integer|min:1',
           'codigo_tarefa' => 'required|integer|min:1'
        ];
    }   
    
    public function messages()
    {
        return [
            'codigo_usuario.required' => 'Por favor, informe o código do usuário.',  
            'codigo_usuario.integer' => 'O Código do usuário dever ser um número inteiro.',  
            'codigo_usuario.min' => 'O Código do usuário deve ser maior que zero.',  
            'codigo_tarefa.required' => 'Por favor, informe o código da tarefa.',  
            'codigo_tarefa.integer' => 'O Código da tarefa dever ser um número inteiro',  
            'codigo_tarefa.min' => 'O Código da tarefa deve ser maior que zero.',  
        ];
    }
}
