<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Entities\Withdraw;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-4-27
 * Time: 上午11:24
 */
class WithdrawController extends Controller
{

    public function index()
    {
        $withdraw=new Withdraw();
        $withdraws = $withdraw->paginate(10);
        return view('admin.withdraw.list')->with('withdraws', $withdraws);
    }

    public function status(Request $request){

        $withdraw=new Withdraw();

        $this->validate($request, [
            'id'              =>  'required|numeric',
            'is_handle'          =>  'required|numeric',
        ]);

        $withdraws = $withdraw->find($request->input('id'));

        return response()->json([
            'status'    =>  $withdraws->update(['is_handle'=>$request->input('is_handle')])

        ]);

    }

}