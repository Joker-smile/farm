<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Entities\Admin;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-4-27
 * Time: 上午11:24
 */
class AdminController extends Controller
{
    private $admin;

    public function __construct()
    {
        $this->admin =new Admin();
    }

    public function index()
    {
        $admins = $this->admin->paginate(10);

        return view('admin.show.list')->with('admins', $admins);
    }
    public function add()
    {

        return view('admin.show.add');
    }
    //分类增加
    public function store(Request $request)
    {
        $this->validate($request, [
            'nickname' =>  'required|unique:admins',
            'username' =>  'required|unique:admins',
            'password' =>  'required'
        ]);

        $admin =$request->input();
        $this->admin->nickname=$admin['nickname'];
        $this->admin->username=$admin['username'];
        $this->admin->password=bcrypt($admin['password']) ;
        if ($this->admin->save()){
            return redirect('admin/show/list')->with('status', $this->admin->id != 0);

    }
    }

    //管理员的编辑与更新
    public function edit($id)
    {
        $user = $this->admin->find($id);
        return view('admin.show.edit')->with('user',$user);
    }

    public function update(Request $request){
        $this->validate($request, [
//            'username' =>  'required',
            'password' =>  'required'
        ]);

        $admin =$request->input();
        $user = $this->admin->find($request->input('id'));
//        $user->username=$admin['username'];
        $user->password=bcrypt($admin['password']);

        if ($user->save()){
            return redirect('admin/show/list')->with('status', $user->id != 0);

    }

    }
   //管理员删除
    public function delete($id){


         $admin=$this->admin->find($id);
        return response()->json([
            'status' => $admin->delete()
        ]);

    }

}