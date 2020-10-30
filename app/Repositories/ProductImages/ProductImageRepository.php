<?php
/**
 * Namespace App\Repositories\ProductImages
 *
 * @category ProductImageRepository
 * @package  App\Repositories\ProductImages
 * @author   ranghivanguy <ranghivanhuy@email.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/third_laravel.git
 */
namespace App\Repositories\ProductImages;

use App\Repositories\EloquentRepository;
use File;
/**
 * CandidateRepository Class
 *
 * @category ProductImageRepository
 * @package  App\Repositories\ProductImages
 * @author   ranghivanguy <ranghivanhuy@email.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/third_laravel.git
 */
class ProductImageRepository extends EloquentRepository 
                            implements ProductImageRepositoryInterface
{
    /**
     * Get model
     * 
     * @return void
     */
    public function getModel()
    {
        return \App\Models\ProductImage::class;
    }
    /**
     * Get product image
     * 
     * @return void
     */
    public function getProductImage()
    {
        return $this->model->with('product_image')->get();
    }
    /**
     * Get model
     * 
     * @param int $product_id 
     * 
     * @return void
     */
    public function getProductImageById($product_id)
    {
        return $this->model->where('product_id', $product_id)->get();
    }
    /**
     * Delete image
     * 
     * @param int $id 
     * 
     * @return Response
     */
    public function deleteProductImage($id)
    {
        $productImage = $this->model->find($id);
        File::delete(storage_path('app/public/product_images/thumbnail/'. $productImage->image));
        File::delete(storage_path('app/public/product_images/medium/'. $productImage->image));
        File::delete(storage_path('app/public/product_images/large/'. $productImage->image));
        File::delete(storage_path('app/public/uploads/other-image/'. $productImage->image));
        $productImage->delete();
        return $productImage;
    }
    /**
     * Delete photo in product
     * 
     * @param int $product_id 
     * 
     * @return Response
     */
    public function deleteProductImagebyProductId($product_id)
    {
        $productImage = $this->model->where('product_id', $product_id)->get();
        foreach ( $productImage as $removeImage ) {
            File::delete(storage_path('app/public/product_images/thumbnail/'. $removeImage->image));
            File::delete(storage_path('app/public/product_images/medium/'. $removeImage->image));
            File::delete(storage_path('app/public/product_images/large/'. $removeImage->image));
            File::delete(storage_path('app/public/uploads/other-image/'. $removeImage->image));
        }
        $productImage = $this->model->where('product_id', $product_id)->delete();
        return $productImage;
    }
}