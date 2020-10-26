<?php
/**
 * Namespace App\Repositories\User
 *
 * @category CandidateRepository
 * @package  App\Repositories\User
 * @author   ranghivanguy <ranghivanhuy@email.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/appleluong1905/nta_intern102020_backend
 */
namespace App\Repositories\Products;

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
class ProductRepository extends EloquentRepository 
                            implements ProductRepositoryInterface
{
    /**
     * Get model
     * 
     * @return void
     */
    public function getModel()
    {
        return \App\Models\Product::class;
    }
    /**
     * Get model
     * 
     * @return void
     */
    public function getProduct()
    {
        return $this->model->with('product_category')->get();
    }
    /**
     * Get model
     * 
     * @param int $id 
     * 
     * @return void
     */
    public function getProductById($id)
    {
        return $this->model->with(['product_category', 'product_image'])->where('id', $id)->first();
    }
    /**
     * Get paginate from products table
     * 
     * @param int $filters 
     * 
     * @return void
     */
    public function index($filters)
    {
        $pagination = $filters['pagination'];

        return $this->model->with('product_category')->orderBy('created_at', 'ASC')->paginate($pagination);
    }
}