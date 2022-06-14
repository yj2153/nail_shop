<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // 예약전
    const STATE_BEFORE = '0';
    // 예약완료
    const STATE_AFTER = '1';
    // 완료
    const STATE_SUCCESS = '2';
    // 취소
    const STATE_CANCEL = '9';

    protected $fillable = ['user_name', 'user_phone', 'order_number', 'pay_method', 'user_id', 'total_price'];
    //
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getStatusNameAttribute()
    {
        if ($this->status === self::STATE_BEFORE)
            return 'fullOrder status before';
        else if ($this->status === self::STATE_AFTER)
            return 'fullOrder status after';
        else if ($this->status === self::STATE_SUCCESS)
            return 'fullOrder status success';
        else
            return 'fullOrder status cancel';
    }

    public function getStatusArrayAttribute()
    {
        $statusArray = [
            self::STATE_BEFORE => 'fullOrder status before',
            self::STATE_AFTER => 'fullOrder status after',
            self::STATE_SUCCESS => 'fullOrder status success',
            self::STATE_CANCEL => 'fullOrder status cancel'
        ];
        return $statusArray;
    }
}
