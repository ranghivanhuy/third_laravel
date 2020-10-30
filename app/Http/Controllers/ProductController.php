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
use App\Repositories\ProductImages\ProductImageRepository;
use App\Http\Requests\Products\AddProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Category;
use Image;
use DB;
use File;
use Storage;
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
    protected $prodImageRepo;
    /**
     * ProductRepositoryInterface
     * 
     * @param $productRepo 
     * @param $categoryRepo 
     * @param $prodCateRepo 
     * @param $prodImageRepo 
     */
    public function __construct(ProductRepositoryInterface $productRepo, CategoryRepository $categoryRepo, ProductCategoryRepository $prodCateRepo, ProductImageRepository $prodImageRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
        $this->prodCateRepo = $prodCateRepo;
        $this->prodImageRepo = $prodImageRepo;
    }
    /**
     * Display all data from Product
     * 
     * @return void
     */
    public function index()
    {
        $products = $this->productRepo->getProduct();
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
        
        $prodById = $this->productRepo->getProductById($id);
        $productCategory = $this->prodCateRepo->getProductCategory($id);
        $categories = $this->categoryRepo->getCategory();
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
    public function store(Request $request)
    {
        // dd($request->all());
        $productData = $request->only('name', 'price', 'description', 'category_id');
        $primary = $request->get('primary');
        if ($primary) {
            $productData['photo'] = $this->saveImgBase64($primary, 'uploads');
        }
        $product['product_id'] = $this->productRepo->create($productData)->id;
        $productCategories['product_id'] = $product['product_id'];
        $prodCate = $request->category_id;
        for ($i = 0; $i < count($prodCate); $i++) {
            $productCategories['category_id'] = $prodCate[$i];
            $productCategory = $this->prodCateRepo->create($productCategories);
        }
        $input['product_id'] = $product['product_id'];
        if ($request->get('other-image')) {
            $images = $request->get('other-image');
            foreach ($images as $image) {
                $input['image'] =  $this->saveImgBase64($image, 'uploads/other-image');;
                $this->prodImageRepo->create($input);
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
        
        $product = $this->productRepo->find($id);
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->description = $request->get('description');
        if ($request->get('primary')) {
            File::delete(storage_path('app/public/product_images/thumbnail/'. $product->photo));
            File::delete(storage_path('app/public/product_images/medium/'. $product->photo));
            File::delete(storage_path('app/public/product_images/large/'. $product->photo));
            File::delete(storage_path('app/public/uploads/'. $product->photo));
            $primary = $request->get('primary');
            if ($primary) {
                $product->photo = $this->saveImgBase64($primary, 'uploads');
            }
        }
        $product->save();
        $product_id = $id;
        $productCategory = $this->prodCateRepo->deleteProductCategory($product_id);
    
        $productCategories['product_id'] = $id;
        $prodCate = $request->category_id;
        for ($i = 0; $i < count($prodCate); $i++) {
            $productCategories['category_id'] = $prodCate[$i];
            $productCategory = $this->prodCateRepo->create($productCategories);
        }
        $productImage = $this->prodImageRepo->getProductImageById($product_id);
        $input['product_id'] = $id;
        if ($request->get('other-image')) {
            $images = $request->get('other-image');
            foreach ($images as $image) {
                $input['image'] =  $this->saveImgBase64($image, 'uploads/other-image');;
                $this->prodImageRepo->create($input);
            }
        }
        return redirect()->route('products.index');
    }
    /**
     * Create destroy function to delete single product, delete relationship table
     * 
     * @param int $id 
     * 
     * @return Response
     */
    public function destroy($id)
    {
        $product_id = $id;
        $productCategory = $this->prodCateRepo->deleteProductCategory($product_id);

        $productImage = $this->prodImageRepo->deleteProductImagebyProductId($product_id);

        $product = $this->productRepo->deleteProduct($id);

        return 'ok';
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
        $productImage = $this->prodImageRepo->deleteProductImage($id);
        return $productImage;
    }
    /**
     * Create delete function to delete single photo from product table
     * 
     * @param int $id 
     * 
     * @return response
     */
    public function deleteOnlyImage($id)
    {
        $product = $this->productRepo->deleteProductPhoto($id);
        return $product;
    }
    /**
     * SaveImageBase64
     * 
     * @param string $param 
     * @param string $folder 
     * 
     * @return response
     */
    public function saveImgBase64($param, $folder)
    {
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $storage = Storage::disk('public');

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }
        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');

        $resize = Image::make(Storage::path('/public/'.$folder.'/'. $fileName));
        $resize->fit(150, 150)->save(storage_path('app/public/product_images/thumbnail/'. $fileName));
        $resize->fit(400, 400)->save(storage_path('app/public/product_images/medium/'. $fileName));
        $resize->fit(600, 600)->save(storage_path('app/public/product_images/large/'. $fileName));
        return $fileName;
    }
}
