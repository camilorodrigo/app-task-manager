<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class UserRequest extends FormRequest
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
           'nome' => 'required',
           'email' => 'email:rfc,dns',
           'senha' => 'required|min:3'
        ];
    }   
    
    public function messages()
    {
        return [
            'nome.required' => 'Por favor, insira o nome do usuario.',  
            'email.email' => 'Por favor, insira um e-mail válido',
            'senha.required' => 'Por favor, digite uma senha.',            
            'senha.min' => 'A senha deverá conter no mínimo 3 dígitos.',            
            
        ];
    }
}
