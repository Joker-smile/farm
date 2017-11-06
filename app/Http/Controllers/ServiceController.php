<?php
/**
 * Created by PhpStorm.
 * User: sunnyshift
 * Date: 17-4-28
 * Time: 下午3:51
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Overtrue\EasySms\EasySms;

class ServiceController extends Controller
{
    public function upload(Request $request){
        $file = $request->file('photo');
        if ($file->isValid()){
            $path = $file->store('images','public');
            return Storage::url($path);
        }
        return $this->buildUploadErrorMessage($file->getErrorMessage());
    }

    public function sms(Request $request, EasySms $sms){
        $this->validate($request, [
            'phone' => 'mobile'
        ]);

        $phone = $request->input('phone');
        $code = rand(100000,999999);

        $ret = $this->sendMessage($sms, $phone, $code);

        Cache::put('PHONE::CODE::'.$phone, $code, 2);

        return response()->json([
            'code' => $code,
            'status' => $ret
        ]);
    }

    private function sendMessage($sms, $mobile, $code){
        $ret = $sms->send($mobile, [
                'content'  => '您的验证码为: '.$code,
                'template' => env('ALIDAYU_SMS_TEMPLATE'),
                'data' => [
                    'number' => $code
                ],
            ]);

        $status = $ret['alidayu']['status'] == 'success';

        Log::info('发送短信:', [
            'phone'     =>     $mobile,
            'code'      =>     $code,
            'status'    =>     $status
        ]);

        return $status;
    }

    private function buildUploadErrorMessage($message){
        return 'error|'.$message;
    }
}