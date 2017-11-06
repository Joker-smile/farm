<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Entities\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-4-27
 * Time: 上午11:24
 */
class OrderController extends Controller
{
   private $order;

    public function  __construct()
    {
        $this->order=new Order();
    }

    public function index()
    {

        $orders = $this->order->orderBy('id', 'desc')->paginate(10);

        return view('admin.order.list')->with('orders', $orders);
    }

    public function edit($id){

        $orders = $this->order->find($id);
        if ($this->order == null){
            throw new NotFoundHttpException();
        }
        return view('admin.order.edit')->with('orders', $orders);
    }

    public function update(Request $request){
        $this->validate($request, [
            'shipping_carrier'           =>  'required',
            'shipping_number'         =>  'required|numeric',

        ]);
        $orders =$this->order->find($request->input('id'));
        if ($orders == null){
            throw new NotFoundHttpException();
        }
        $data=$request->all();
        $orders->shipping_carrier=$data['shipping_carrier'];
        $orders->shipping_number=$data['shipping_number'];
        $orders->status=$data['status'];

        if ($orders->save()){
            return redirect('admin/order/list')->with('orders', $orders);
        }else{
            return redirect()->back();
        }
    }

    /**
     * 订单物流信息
     * @param $id
     * @return View
     */
    public function logistic($id){
        $orders=new Order();
        $order = $orders->find($id);

        if ($order == null){
            throw new NotFoundHttpException();
        }

        return view('admin.order.logistic')->with('order', $order);
    }

    /**
     * 订单物理信息跟新
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logisticUpdate(Request $request){

        $this->validate($request, [
            'shipping_carrier' =>  'required',
            'shipping_number'  =>  'required|string'
        ]);

        $order = $this->order->find($request->input('id'));
        $result=$this->order -> where('id',$order['id'])->update([
             'shipping_carrier'=>$request->input('shipping_carrier'),
             'status'=>$request->input('status'),
             'shipping_number'=>$request->input('shipping_number')
        ]);

        if ($order == null){
            throw new NotFoundHttpException();
        }
        if ($result){
            return redirect('admin/order/list');
        }else{
            return redirect()->back();
        }

    }
   //订单搜索
    public function search(Request $request){

         $search=$request->input('search');
         $status=$request->input('status');
         $begintime=$request->input('begintime');
         $endtime=$request->input('endtime');

//         var_dump($endtime);die();

        if ($begintime!=null&&$endtime!=null&&$status=='all'){

                $res=$this->order->whereBetween('created_at',[$begintime,$endtime])->get();
        }else{
             $res=$this->order->where('status',$status)->get();
         }
          if ($search!=null){
              $res=$this->order->where('order_number','like','%'.$search.'%')->orWhere('status','like','%'.$search.'%')->get();
         }
         if ($begintime==null&&$endtime==null&&$status=='all'){
            $res=$this->order->get();
        }
        if ($begintime!=null&&$endtime!=null&&$status!='all'){
            $res=$this->order->where('status',$status)->whereBetween('created_at',[$begintime,$endtime])->get();
        }
        return view('admin.order.search')->with('res', $res);
    }



    /**
     * 修改订单状态
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request){

        $this->validate($request, [
            'order_id' => 'required|numeric',
            'status'   => 'required|numeric'
        ]);

        $orders = $this->order->find($request->input('order_id'));
        $this->order->status=$orders['status'];
        $this->order->update();

        return response()->json([
            'status' => true
        ]);
    }

    public function detail($id){
        $order = $this->order->find($id);
        if ($order == null){
            throw new NotFoundHttpException();
        }
        return view('admin.order.detail')->with('order', $order);
    }

}