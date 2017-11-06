<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Option;
use App\Repositories\AdRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-4-27
 * Time: 上午11:24
 */
class ConfigController extends Controller
{
    public function banner(){
        $banners = Redis::get('BANNER');

        $rets = [];
        if ($banners != null){
            foreach (json_decode($banners) as $banner){
                $rets[] = Storage::url($banner);
            }
        }

        return view('admin.config.banner')->with('banners', $rets);
    }

    public function storeBanner(Request $request){
        $this->validate($request, [
            'thumb' =>  'required|array'
        ]);

        $thumb = $request->input('thumb');

        $ret = Redis::set('BANNER', json_encode($thumb));

        return redirect()->route('admin.configs.banner')->with('status', $ret);
    }

    public function product(){
        $fruit = Redis::get('FRUIT');
        $tree = Redis::get('TREE');

        return view('admin.config.product')->with(compact('fruit', 'tree'));
    }

    public function storeProduct(Request $request){
        $data = $request->validate([
           'fruit'  =>  'required|numeric|exists:products,id',
           'tree'  =>  'required|numeric|exists:products,id'
        ]);

        Redis::set('FRUIT', $data['fruit']);
        Redis::set('TREE', $data['tree']);

        return redirect()->route('admin.configs.product')->with('status', true);
    }

}