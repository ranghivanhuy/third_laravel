<?php
/**
 * Namespace App\Models
 * php version 7.4.10
 * 
 * @category Product_Image
 * @package  App\Models
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Product_Image
 * 
 * @category Product_Image
 * @package  App\Models
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $fillable = ['product_id', 'image'];
    /**
     * Connect to products table
     * 
     * @return void
     */
    public function product()
    {
        return $this->belongsTo('App\ Models\Product', 'product_id', 'id');
    }
}
