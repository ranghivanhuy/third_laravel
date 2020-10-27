<?php
/**
 * Namespace App\Http\Controllers
 * php version 7.4.10
 * 
 * @category CategoryController
 * @package  App\Http\Controller
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Categories\CategoryRepository;
use App\Http\Requests\Categories\AddCategoryRequest;
/**
 * Namespace App\Http\Controllers
 * 
 * @category CategoryController
 * @package  App\Http\Controller
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
class CategoryController extends Controller
{
    /**
     * CategoryRepository
     * 
     * @var CategoryRepository|\App\Repositories\Repository
     */
    protected $categoryRepo;
    /**
     * CategoryRepository Init
     * 
     * @param $categoryRepo 
     */
    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }
    /**
     * Display all categories
     * 
     * @return void
     */
    public function index()
    {
        $categories = $this->categoryRepo->getCategory();

        return view('categories.list-category', ['categories' => $categories]);
    }
    /**
     * Display single data from category by id
     * 
     * @param int $id 
     * 
     * @return void
     */
    public function show($id)
    {

        $categories = $this->categoryRepo->getCateById($id);
        return view('categories.view-category', ['categories' => $categories]);
    }
    /**
     * Display form to create category
     * 
     * @return void
     */
    public function create()
    {
        $categories = $this->categoryRepo->getCategory();
        return view('categories.add-category', compact('categories'));
    }
    /**
     * Create store function to save category
     * 
     * @param Request $request 
     * 
     * @return Response
     */
    public function store(AddCategoryRequest $request)
    {
        
        $data = $request->all();

        $category = $this->categoryRepo->create($data);

        return redirect()->route('categories.index');
    }
    /**
     * Display edit form to update category
     * 
     * @param int $id  
     * 
     * @return void
     */
    public function edit($id)
    {
        $cateById = $this->categoryRepo->find($id);
        $categories = $this->categoryRepo->getCategory();
        return view('categories.edit-category', compact('categories', 'cateById'));
    }
    /**
     * Create update function to edit single product by id
     * 
     * @param Request $request 
     * @param int     $id  
     * 
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $category = $this->categoryRepo->update($id, $data);

        return redirect()->route('categories.index');
    }
    /**
     * Create destroy function to delete product
     * 
     * @param int $id 
     * 
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepo->find($id);
        $cateChild = $category->cate->pluck('id');
        if (count($cateChild) == 0) {
            $this->categoryRepo->delete($id);
        } else {
            $data['parent_id'] = null;
            $category = $this->categoryRepo->updateDelete($id, $data);
            $this->categoryRepo->delete($id);
        }
    }
}