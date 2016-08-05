<?php
namespace App\Repositories\Contracts;



interface ApiRepoInterface {

    public function all();

    public function paginate($perPage = 10);

    public function add(array $data);

    public function update(array $data, $attribute, $id);

    public function delete($id);

    public function get($id);
    

}