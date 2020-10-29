<?php
/**
 * Namespace App\Http\Controllers
 * php version 7.4.10
 * 
 * @category ProductController
 * @package  App\Http\Controller
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Products\ProductRepositoryInterface;
use App\Repositories\Categories\CategoryRepository;
use App\Repositories\Products\ProductCategoryRepository;
use App\Http\Requests\Products\AddProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Category;
use Image;
use DB;
use File;
/**
 * Name ProductConrtoller
 * 
 * @category ProductControllerClass
 * @package  App\Http\Controller
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
class ProductController extends Controller
{
    /**
     * ProductRepositoryInterface Init
     * 
     * @var ProductRepositoryInterface|\App\Repositories\Repository
     */
    protected $productRepo;
    protected $categoryRepo;
    protected $prodCateRepo;
    /**
     * ProductRepositoryInterface
     * 
     * @param $productRepo 
     * @param $categoryRepo 
     */
    public function __construct(ProductRepositoryInterface $productRepo, CategoryRepository $categoryRepo, ProductCategoryRepository $prodCateRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
        $this->prodCateRepo = $prodCateRepo;
    }
    /**
     * Display all data from Product
     * 
     * @return void
     */
    public function index()
    {
        $filters = ['pagination' => 5];
        $products = $this->productRepo->index($filters);
        return view('products.list-product', ['products' => $products]);
    }
    /**
     * Display single data from Product
     * 
     * @param int $id 
     * 
     * @return void
     */
    public function show($id)
    {
        $product = $this->productRepo->find($id);

        return view('home.product', ['product' => $product]);
    }
    /**
     * Display form to create product
     * 
     * @return void
     */
    public function create()
    {
        $categories = $this->categoryRepo->getCategory();

        return view('products.add-product', compact('categories'));
    }
    /**
     * Create store function to save product
     * 
     * @param Request $request 
     * 
     * @return Response
     */
    public function store(AddProductRequest $request)
    {
        $productData = $request->only('name', 'price', 'description', 'category_id');
        if ($request->hasFile('photo')) {
            $file =  $request->photo;
            $filename = $file->getClientOriginalName();
            $photo = microtime(). '-'. $filename;
            $resize = Image::make($file->getRealPath());
            $resize->fit(150, 150)->save(storage_path('app/public/products/thumbnail/'. $photo));
            $resize->fit(400, 400)->save(storage_path('app/public/products/medium/'. $photo));
            $resize->fit(600, 600)->save(storage_path('app/public/products/large/'. $photo));
            $productData['photo'] = $photo;
        }
        $product['product_id'] = $this->productRepo->create($productData)->id;
        
        $productCategories['product_id'] = $product['product_id'];
        $prodCate = $request->category_id;
        for ($i = 0; $i < count($prodCate); $i++) {
            $productCategories['category_id'] = $prodCate[$i];
            $productCategory = ProductCategory::create($productCategories);
        }
        $input['product_id'] = $product['product_id'];
        if ($request->hasFile('image')) {
            $images[] = $request->file('image');
            foreach ($images[0] as $image) {
                $filename = $image->getInode() . $image->getClientOriginalName();
                $resize = Image::make($image->getRealPath());
                $resize->fit(150, 150)->save(storage_path('app/public/products/images/thumbnail/'. $filename));
                $resize->fit(400, 400)->save(storage_path('app/public/products/images/medium/'. $filename));
                $resize->fit(600, 600)->save(storage_path('app/public/products/images/large/'. $filename));
                $input['image'] = $filename;
                ProductImage::create($input);
            }
        }

        return redirect()->route('products.index');
    }
    /**
     * Display form to update product
     * 
     * @param int $id 
     * 
     * @return void
     */
    public function edit($id)
    {
        $prodById = $this->productRepo->getProductById($id);
        $productCategory = $this->prodCateRepo->getProductCategory($id);
        $categories = $this->categoryRepo->getCategory();
        return view('products.edit-product', compact('categories', 'prodById', 'productCategory'));
    }
    /**
     * Create update function to edit product
     * 
     * @param Request $request 
     * @param int     $id 
     * 
     * @return Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        
        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->description = $request->get('description');
        if ($request->hasFile('photo')) {
                File::delete(storage_path('app/public/products/thumbnail/'. $product->photo));
                File::delete(storage_path('app/public/products/medium/'. $product->photo));
                File::delete(storage_path('app/public/products/large/'. $product->photo));
            $file =  $request->photo;
            $filename = $file->getClientOriginalName();
            $photo = microtime(). '-'. $filename;
            $resize = Image::make($file->getRealPath());
            $resize->fit(150, 150)->save(storage_path('app/public/products/thumbnail/'. $photo));
            $resize->fit(400, 400)->save(storage_path('app/public/products/medium/'. $photo));
            $resize->fit(600, 600)->save(storage_path('app/public/products/large/'. $photo));
            $product->photo = $photo;
        }
        $product->save();
        $product_id = $id;
        $productCategory = ProductCategory::where('product_id', $product_id)->delete();
    
        $productCategories['product_id'] = $id;
        $prodCate = $request->category_id;
        for ($i = 0; $i < count($prodCate); $i++) {
            $productCategories['category_id'] = $prodCate[$i];
            $productCategory = ProductCategory::create($productCategories);
        }
        $productImage = ProductImage::where('product_id', $product_id)->get();
        $input['product_id'] = $id;
        if ($request->hasFile('image')) {
            foreach ($productImage as $reMoveImage) {
                File::delete(storage_path('app/public/products/images/thumbnail/'. $reMoveImage->image));
                File::delete(storage_path('app/public/products/images/medium/'. $reMoveImage->image));
                File::delete(storage_path('app/public/products/images/large/'. $reMoveImage->image));
            }
            $images[] = $request->file('image');
            foreach ($images[0] as $image) {
                $filename = $image->getInode() . $image->getClientOriginalName();
                $resize = Image::make($image->getRealPath());
                $resize->fit(150, 150)->save(storage_path('app/public/products/images/thumbnail/'. $filename));
                $resize->fit(400, 400)->save(storage_path('app/public/products/images/medium/'. $filename));
                $resize->fit(600, 600)->save(storage_path('app/public/products/images/large/'. $filename));
                $input['image'] = $filename;
                ProductImage::create($input);
            }
        }
        
        return response()->json([
            'product' => $product,
            'productCategory' => $productCategory
        ]);

            
        // return redirect()->route('products.index');
    }
    /**
     * Create destroy function to delete single product
     * 
     * @param int $id 
     * 
     * @return Response
     */
    public function destroy($id)
    {
        // $this->productRepo->delete($id);
        $productCategory = ProductCategory::where('product_id', $id)->delete();
        $productImage = ProductImage::where('product_id', $id)->delete();
        $product = Product::find($id)->delete();
        return redirect()->route('products.index');
    }
    /**
     * Create delete function to delete single image from product image table
     * 
     * @param int $id 
     * 
     * @return response
     */
    public function deleteProductImage($id)
    {
        $productImage = ProductImage::find($id);
        File::delete(storage_path('app/public/products/images/thumbnail/'. $productImage->image));
        File::delete(storage_path('app/public/products/images/medium/'. $productImage->image));
        File::delete(storage_path('app/public/products/images/large/'. $productImage->image));
        $productImage->delete();
        return 'ok';
    }
    /**
     * Create delete function to delete single image from product image table
     * 
     * @param int $id 
     * 
     * @return response
     */
    public function deleteOnlyImage($id)
    {
        // $product = Product::where('id', $id)->where('photo', 'like', '%dd%')->first();
        $product = Product::where('id', $id)->where('photo', 'like', '%%')->first();
        File::delete(storage_path('app/public/products/thumbnail/'. $product->photo));
        File::delete(storage_path('app/public/products/thumbnail/'. $product->photo));
        File::delete(storage_path('app/public/products/thumbnail/'. $product->photo));
        $product->update(['photo' => null]);
        return 'ok';
    }
}
