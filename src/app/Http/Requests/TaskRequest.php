<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class TaskRequest extends FormRequest
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
           'titulo' => 'required',
           'descricao' => 'required',
           'data_inicio' => 'required|date_format:d/m/Y',
           'data_fim' => 'required|date_format:d/m/Y'
        ];
    }   
    
    public function messages()
    {
        return [
            'titulo.required' => 'Por favor, insira um título.',  
            'descricao.required' => 'Por favor, insira uma descrição.',  
            'data_inicio.required' => 'Por favor, insira uma data inicial.',  
            'data_inicio.date_format' => 'Por favor, insira uma data inicial válida dd/mm/aaaa.',  
            'data_fim.required' => 'Por favor, insira uma data de conclusão prevista.',  
            'data_fim.date_format' => 'Por favor, insira uma data final válida dd/mm/aaaa.',  
                   
            
        ];
    }
}
