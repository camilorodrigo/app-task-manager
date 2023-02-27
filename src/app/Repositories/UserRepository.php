<?php
namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
/**
 * Description of User
 * Usuários
 * @author Rodrigo C
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model = User::class;
    
    public function countByEmail($email)
    {   
        $busca = $this->model::where('email', '=', $email)->count();        
        return $busca;
    }    
}