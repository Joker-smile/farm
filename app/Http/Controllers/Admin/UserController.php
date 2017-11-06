<?php
namespace App\Http\Controllers\Admin;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-4-27
 * Time: 上午11:24
 */
class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $users = $this->user->paginate(10);
        return view('admin.user.list')->with('users', $users);
    }

    public function edit($id){

        $user = $this->user->find($id);
        if ($user == null){
            throw new NotFoundHttpException();
        }

        return view('admin.user.edit')->with('user', $user);
    }

    public function update(Request $request){
        $this->validate($request, [
            'score'      =>  'required|numeric',
//            'phone'      =>  'phone',
            'harvests'   =>  'numeric',
            'trees'   =>  'numeric'
        ]);

        $user = $this->user->find($request->input('id'));
        if ($user == null){
            throw new NotFoundHttpException();
        }
//        $user->phone = $request->input('phone');
        $user->score = $request->input('score');
        $user->harvests = $request->input('harvests');
        $user->trees = $request->input('trees');
        $user->save();
        return redirect('admin/user/list');
    }

    public function wallet(){

    }
}