<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Contracts\ApiRepoInterface;


abstract class AbstractRepository implements ApiRepoInterface
{

    private $app;
    protected $model;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract function model();

    public function makeModel()
    {
         $model = $this->app->make($this->model());

         if (!$model instanceof Model)
             throw new ModelNotFoundException("Class".$this->model().
                       "must be an instance of Illuminate\\Database\\Eloquent\\Model");

         return $this->model = $model;
    }

    public function all()
    {
       return $this->model->get();
    }

    public function paginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function get($id)
    {
        return $this->model->findOrFail($id);
    }

    public function add(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $attribute="id", $id)
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

}