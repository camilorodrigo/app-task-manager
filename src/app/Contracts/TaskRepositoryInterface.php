<?php

namespace App\Contracts;
/**
 * Description of TaskRepositoryInterface
 * Interface do Repo da Tarefas
 * @author Rodrigo C
 */
interface TaskRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function create(array $attributes);
    public function update(array $attributes, int $id);
    public function delete(int $id);
    public function countByTitle(String $title);
    public function findOneTaskById(int $id);
    
}