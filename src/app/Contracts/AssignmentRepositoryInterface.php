<?php

namespace App\Contracts;
/**
 * Description of AssignmentRepositoryInterface
 * Interface do Repo das Atribuições
 * @author Rodrigo C
 */
interface AssignmentRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function create(array $attributes);
    public function update(array $attributes, int $id);
    public function delete(int $id);
    public function getAllAssignmentsWithUserWithTask($cod_user = null, $status_task = null);
}