<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class LoginRequest extends FormRequest
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
           'email' => 'required|email:rfc,dns',
           'password' => 'required'
        ];
    }   
    
    public function messages()
    {
        return [
            'email.required' => 'Por favor, preencha o campo e-mail',
            'email.email' => 'Por favor, insira um e-mail válido',
            'password.required' => 'Por favor, digite uma senha.',            
        ];
    }
}
