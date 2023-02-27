<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use DB;

/**
 * Description of Users
 * Clientes
 * @author Rodrigo C
 */

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'users'; // nome da tabela
    protected $primaryKey = 'cod_user'; // chave primária  
    public $incrementing = true; // indica se os IDs são auto-incremento
    public $timestamps = true; // ativa os campos created_at e updated_at

    /* Fillable possibilitará criar novos registros simplesmente usando
    * o método create e outros da classe Model passando
    * um array associativo as colunas da classe
    */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];   
 

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'cod_user' => $this->cod_user,
            'email' => $this->email
        ];
    }
    
// DEFININDO RELAÇÕES ------------------------------------------------------------------------

    // Um USUÁRIO tem muitas Atribuições
    public function assignment() {  
     // HASMANY: MODEL RELACIONADO, CHAVE ESTRANGEIRA LÁ, CHAVE PRIMÁRIA AQUI 
     return $this->hasMany(Assignment::class, 'cod_user', 'cod_user');
    }  
}
