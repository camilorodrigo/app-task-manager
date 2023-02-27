<?php
namespace App\Repositories;
/**
 * Description of AbstractRepository
 *
 * @author Rodrigo C
 */
abstract class AbstractRepository
{   
    protected $model;
    
    public function __construct()
    {
       $this->model = $this->resolveModel();
    }
    public function getAll()
    {
        return $this->model->all();
    }
    public function find($id)
    {
        return $this->model->find($id);
    }
    public function create(array $attributes)
    {
       return $this->model->create($attributes);
    }
    public function update(array $attributes, int $id)
    {
       return $this->model->find($id)->update($attributes);
    }
    public function delete(int $id) {
        return $this->model->destroy($id);
    }
    protected function resolveModel()
    {
        return app($this->model);
    }

}