<?php 

namespace App\Services;#

class Service 
{
    protected string $locale;

    public const STATUS_SUCCES = 1;
    public const STATUS_FAIL = 0;

    protected function finalResultSuccess($data = []): array
    {
        return ['status'=>self::STATUS_SUCCES,'data'=>$data,'message'=>'success'];
    }
    protected function finalResultFail($dataFail = [], string $message= ""):array
    {
        return ['status'=>self ::STATUS_FAIL,'data'=>$dataFail,'message'=>$message];

    }
}

