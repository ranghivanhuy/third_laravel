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
    public function getProductCategory($product_id = null)
    {
        return $this->model->where('product_id', $product_id)->pluck('category_id')->toArray();
    }
}