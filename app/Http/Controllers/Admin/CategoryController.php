<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Entities\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-4-27
 * Time: 上午11:24
 */
class CategoryController extends Controller
{
    private $category;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->category = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->category->paginate(10);
        return view('admin.category.list')->with('categories', $categories);
    }
    public function add()
    {

        return view('admin.category.add');
    }
    //分类增加
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' =>  'required|unique:categories'
        ]);

        $category =$request->all();
        $categories=new Category();
        $categories->name=$category['name'];
        if ($categories->save()){
            return redirect('admin/category/list')->with('status', $categories->id != 0);
        }

    }

    //分类的编辑与更新
    public function edit($id){
        $category = $this->category->find($id);
        if ($category == null){
            throw new NotFoundHttpException();
        }

        return view('admin.category.edit')->with('category', $category);
    }

    public function update(Request $request){
        $this->validate($request, [
            'name'            =>  'required|unique:categories',
        ]);

        $category = $this->category->find($request->input('id'));
        if ($category == null){
            throw new NotFoundHttpException();
        }
        $data=$request->input();
        $category->name=$data['name'];
        if ($category->save()){
            return redirect('admin/category/list')->with('category', $category);
        }else{
            return redirect()->back();
        }

    }
//    //分类删除
//    public function delete($id){
//
//        $this->delProduct($id);
//
//        return response()->json([
//            'status' => $this->category->delete($id)
//        ]);
//
//    }
//
//    //删除对应分类下的商品
//    public function delProduct($id){
//
//    $product= new  Product();
//
//    $product->where('category_id',$id)->delete();
//
//    return $id;
//
//  }
}