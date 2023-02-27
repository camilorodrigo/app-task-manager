<?php

namespace App\Contracts;
/**
 * Description of UserRepositoryInterface
 * Interface do Cliente
 * @author Rodrigo C
 */
interface UserRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function create(array $attributes);
    public function update(array $attributes, int $id);
    public function delete(int $id);
    public function countByEmail($email);
    

}