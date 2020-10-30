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
use File;
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
        return $this->model->with('product_category')->orderBy('created_at', 'ASC')->paginate(5);
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
     * Get model
     * 
     * @param int $id 
     * 
     * @return void
     */
    public function deleteProductById($id)
    {
        return $this->model->find($id);
    }
    /**
     * Delete photo in product
     * 
     * @param int $id 
     * 
     * @return Response
     */
    public function deleteProductPhoto($id)
    {
        $product = $this->model->where('id', $id)->where('photo', 'like', '%%')->first();
        File::delete(storage_path('app/public/product_images/thumbnail/'. $product->photo));
        File::delete(storage_path('app/public/product_images/medium/'. $product->photo));
        File::delete(storage_path('app/public/product_images/large/'. $product->photo));
        File::delete(storage_path('app/public/uploads/'. $product->photo));
        $product->update(['photo' => null]);
        return $product;
    }
    /**
     * Delete single product
     * 
     * @param int $id 
     * 
     * @return Response
     */
    public function deleteProduct($id)
    {
        $product = $this->model->find($id);
        File::delete(storage_path('app/public/product_images/thumbnail/'. $product->photo));
        File::delete(storage_path('app/public/product_images/medium/'. $product->photo));
        File::delete(storage_path('app/public/product_images/large/'. $product->photo));
        File::delete(storage_path('app/public/uploads/'. $product->photo));
        $product->delete();
        return $product;
    }
}