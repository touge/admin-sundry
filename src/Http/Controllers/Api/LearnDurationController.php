<?php

namespace Touge\AdminSundry\Http\Controllers\Api;

use Illuminate\Http\Request;
use Touge\AdminSundry\Http\Controllers\BaseApiController;
use Touge\AdminSundry\Models\LearnDuration;


class LearnDurationController extends BaseApiController
{
    public function heartbeat(Request $request){
        $heartbeat= $request->get('heartbeat', 60000);
        $todayUnixTime= $this->todayUnixTime();


        $online= LearnDuration::where([
            'user_id'=> $this->user()->id,
            'customer_school_id'=> $this->user()->customer_school_id,
            'day'=> $todayUnixTime
        ])->first();

        if($online){
            $online->online_time+= $heartbeat;
            $online->update();

            return $this->success(['online_time'=> $online->online_time]);
        }

        $options= [
            'user_id'=> $this->user()->id,
            'customer_school_id'=> $this->user()->customer_school_id,
            'online_time'=> $heartbeat,
            'day'=> $todayUnixTime
        ];
        $online= LearnDuration::create($options);

        return $this->success(['online_time'=> $online->online_time]);
    }


    /**
     * 今天的零时时间
     * @return false|int
     */
    protected function todayUnixTime(){
        return strtotime(date('Y-m-d 00:00:00'));
    }
}
