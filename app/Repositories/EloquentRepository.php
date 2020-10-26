<?php
/**
 * Namespace App\Repositories
 * php version 7.4.10
 * 
 * @category EloquentRepository
 * @package  App\Repositories
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
namespace App\Repositories;

use App\Repositories\RepositoryInterface;
/**
 * Namespace App\Repositories
 * php version 7.4.10
 * 
 * @category EloquentRepository
 * @package  App\Repositories
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
abstract class EloquentRepository implements RepositoryInterface
{
    /**
     * Declare model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * EloquentRepository constructor init. 
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Get the corresponding model
     * 
     * @return string
     */
    abstract public function getModel();

    /**
     * Set the corresponding model
     * 
     * @return void
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {

        return $this->model->all();
    }

    /**
     * Get one
     *
     * @param $id idmodel
     *
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    /**
     * Create
     *
     * @param array $attributes array
     *
     * @return mixed
     */
    public function create(array $attributes)
    {

        return $this->model->create($attributes);
    }

    /**
     * Update
     *
     * @param int   $id         idmodel
     * @param array $attributes array
     *
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id idmodel
     *
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
