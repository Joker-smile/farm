<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-4-27
 * Time: 上午11:24
 */
class ProductController extends Controller
{
    private $product;

    private $category;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->product = $productRepository;
        $this->category = $categoryRepository;
    }

    public function index()
    {
        $products = $this->product->paginate(10);
        return view('admin.product.list')->with('products', $products);
    }

    public function create()
    {
        $categories = $this->category->all();
        return view('admin.product.add')->with('categories', $categories);
    }
     //商品增加
    public function store(Request $request){
        $this->validate($request, [
            'name'            =>  'required',
            'price'           =>  'required|numeric',
            'category_id'     =>  'required|numeric',
            'content'         =>  'required',
            'thumb'           =>  'required|array'
        ]);

        $data = $request->all();

        $product = $this->product->create($data);
        return redirect('admin/product/list')->with('status', $product);
    }

     //商品修改更新
    public function edit($id){
        $product = $this->product->find($id);

        $thumb=json_encode($product['thumb']);
        return view('admin.product.edit')->with([
            'product'=> $product,
            'categories' => $this->category->all(),
            'thumb'=>$thumb
        ]);
    }

    public function update(Request $request){
        $this->validate($request, [
            'name'            =>  'required',
            'price'           =>  'required|numeric',
            'category_id'     =>  'required|numeric',
            'content'         =>  'required',
        ]);

        $product = $this->product->find($request->input('id'));
        if ($product == null){
            throw new NotFoundHttpException();
        }
        $data=$request->all();
        $product->name=$data['name'];
        $product->price=$data['price'];
        $product->category_id=$data['category_id'];
        $product->content=$data['content'];
        $product->thumb=$data['thumb'];
        if ($product->save()){
            return redirect('admin/product/list')->with('category', $product);
        }else{
            return redirect()->back();
        }



    }
    /**
     * 修改商品状态
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function productStatus(Request $request){
        $this->validate($request, [
            'id' => 'required|numeric',
            'status' => 'required|numeric'
        ]);

        $product = $this->product->find($request->input('id'));

        if ($product == null){
            throw new NotFoundHttpException();
        }

        $product->status = $request->input('status');

        return response()->json([
            'status' => $product->update()
        ]);
    }

}