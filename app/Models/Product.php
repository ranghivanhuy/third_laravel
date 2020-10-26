<?php
/**
 * Namespace App\Models
 * php version 7.4.10
 * 
 * @category Product
 * @package  App\Models
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Product
 * 
 * @category Product
 * @package  App\Models
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'price', 'description', 'photo'];
    /**
     * Foregin key to categories tables
     * 
     * @return void
     */
    public function productCate() 
    {
        return $this->belongsTo('App\Models\Product_Category', 'product_id', 'id');
    }
    /**
     * Get foregin key to categories table
     * 
     * @return void
     */
    public function product_category()
    {
        return $this->hasMany(ProductCategory::class)->join('categories', 'categories.id', 'category_product.category_id');
    }
    /**
     * Get Image of product from product_images
     * 
     * @return void
     */
    public function product_image()
    {
        return $this->hasMany(ProductImage::class);
    }
}
