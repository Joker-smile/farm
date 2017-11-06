<?php
/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-5-3
 * Time: 上午9:05
 */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\AddressRepository;
use App\Repositories\AddressRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AddressController extends Controller
{

    private $address;

    public function __construct(AddressRepository $address)
    {
        $this->address = $address;
    }

    public function index(){
        $user = Auth::guard('web')->user();

        $address = $user->address;

        return response()->json($address);
    }

    public function store(Request $request){

        $data = $this->validate($request, [
            'address'      =>  'required|string',
            'phone'         =>  'required|string',
            'receiver'   =>  'required|string',
            'is_default'    =>  'sometimes|numeric'
        ]);

        $user = Auth::guard('web')->user();

        $address = $this->address->create(array_merge(['user_id' => $user->id], $data));

        return response()->json($address);
    }
}