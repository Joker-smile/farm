<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\SubscribeRepositoryInterface;
use Illuminate\Http\Request;
use App\Entities\Subscribe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-4-27
 * Time: 上午11:24
 */
class SubscribeController extends Controller
{
    private $subscribe;

    public function __construct()
    {
        $this->subscribe = new Subscribe();
    }

    public function index(){
        $subscribes = $this->subscribe->paginate(10);
        return view('admin.subscribe.list')->with('subscribes', $subscribes);
    }
    
    public function edit($id){
        $subscribe = $this->subscribe->find($id);
        if ($subscribe == null){
            throw new NotFoundHttpException();
        }

        return view('admin.subscribe.edit')->with('subscribe', $subscribe);
    }

    public function update(Request $request){
//
//        $this->validate($request, [
//            'name'      =>  'required',
//            'total'     =>  'required|numeric',
//        ]);

        $subscribe = $this->subscribe->find($request->input('id'));
        $data =$request->input();
//        dd($data);
//        $subscribe->name=$data['name'];
//        $subscribe->count=$data['count'];
//        $subscribe->unit=$data['unit'];
//        $subscribe->total=$data['total'];
//        $subscribe->origin=$data['origin'];
        $subscribe->augment=$data['augment'];
        $subscribe->gross=$data['gross'];
//        $subscribe->expired_at=$data['expired_at'];
//        $subscribe->status=$data['status'];
        if ($subscribe == null){
            throw new NotFoundHttpException();
        }
        if ($subscribe->save()){

            return redirect('admin/subscribe/list');
        }
    }

    public function delete($id){
        $subscribe=$this->subscribe->find($id);
        return response()->json([
            'status' => $subscribe->delete()
        ]);
    }
}