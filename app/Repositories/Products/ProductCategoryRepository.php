<?php
/**
 * Namespace App\Repositories\Products
 *
 * @category ProductCategoryRepository
 * @package  App\Repositories\Products
 * @author   ranghivanguy <ranghivanhuy@email.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/third_laravel.git
 */
namespace App\Repositories\Products;

use App\Repositories\EloquentRepository;
/**
 * ProductCategoryRepository Class
 *
 * @category EloquentRepository
 * @package  App\Repositories\User
 * @author   ranghivanguy <ranghivanhuy@email.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/third_laravel.git
 */

class ProductCategoryRepository extends EloquentRepository implements ProductCategoryRepositoryInterface
{
    /**
     * Get model
     * 
     * @return void
     */
    public function getModel()
    {
        return \App\Models\ProductCategory::class;
    }
    /**
     * Get product category
     * 
     * @param int $product_id 
     * 
     * @return Response
     */
    public function getProductCategory($product_id = null)
    {
        return $this->model->where('product_id', $product_id)->pluck('category_id')->toArray();
    }
    /**
     * Delete productCategory by $product_id
     * 
     * @param int $product_id 
     * 
     * @return Response
     */
    public function deleteProductCategory($product_id)
    {
        return $this->model->where('product_id', $product_id)->delete();
    }
}