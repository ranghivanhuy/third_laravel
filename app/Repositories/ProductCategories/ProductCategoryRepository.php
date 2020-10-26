<?php
/**
 * Namespace App\Repositories\ProductCategories
 *
 * @category CandidateRepository
 * @package  App\Repositories\ProductCategories
 * @author   ranghivanguy <ranghivanhuy@email.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/appleluong1905/nta_intern102020_backend
 */
namespace App\Repositories\ProductCategory;

use App\Repositories\EloquentRepository;
/**
 * CandidateRepository Class
 *
 * @category ProductCategoryRepository
 * @package  App\Repositories\ProductCategories
 * @author   ranghivanguy <ranghivanhuy@email.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/appleluong1905/nta_intern102020_backend
 */
class ProductCategoryRepository extends EloquentRepository 
                            implements ProductCategoryRepositoryInterface
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
     * Get model
     * 
     * @return void
     */
    public function getProductCategory()
    {
        return $this->model->with('product_image')->get();
    }
}