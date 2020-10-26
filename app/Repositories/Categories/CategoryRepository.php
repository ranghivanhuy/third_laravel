<?php
/**
 * Namespace App\Repositories\Categories
 * php version 7.4.10
 * 
 * @category CategoryRepository
 * @package  App\Repositories\Categories
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
namespace App\Repositories\Categories;

use App\Repositories\EloquentRepository;
/**
 * CandidateRepository Class
 * Namespace App\Repositories\User
 *
 * @category CandidateRepository
 * @package  App\Repositories\User
 * @author   ranghivanguy <ranghivanhuy@email.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/appleluong1905/nta_intern102020_backend
 */
namespace App\Repositories\Categories;

use App\Repositories\EloquentRepository;
/**
 * CandidateRepository Class
 *
 * @category EloquentRepository
 * @package  App\Repositories\User
 * @author   ranghivanguy <ranghivanhuy@email.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/appleluong1905/nta_intern102020_backend
 */
class CategoryRepository extends EloquentRepository 
                            implements CategoryRepositoryInterface
{
    /**
     * Get model
     * 
     * @return void
     */
    public function getModel()
    {
        return \App\Models\Category::class;
    }
    /**
     * Get all category
     * 
     * @return void
     */
    public function getCategory()
    {
        return $this->model->with('cate')->whereNull('parent_id')->get();
    }
    /**
     * Get all category of parent_id
     * 
     * @param int $id 
     * 
     * @return void
     */
    public function getCateById($id)
    {
        return $this->model->with('cate')->where('parent_id', $id)->get();
    }
    /**
     * Get all category of parent_id
     * 
     * @param int $id 
     * 
     * @return void
     */
    public function updateDelete($id, $data)
    {
        return $this->model->where('parent_id', $id)->update($data);
    }

}