<?php
/**
 * Created by PhpStorm.
 * User: joker
 * Date: 15/09/17
 * Time: 下午 02:33
 */
namespace App\Repositories;


interface BaseRepositoryInterface
{
    public function all();

    public function paginate($length);

    public function findById($id);

    public function store($model);

    public function update($model);

    public function updateById($id,$data);

    public function deleteById($id);

    public function getModel();
}