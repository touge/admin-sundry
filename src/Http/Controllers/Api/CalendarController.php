<?php

namespace Touge\AdminSundry\Http\Controllers\Api;

use Illuminate\Http\Request;
use Touge\AdminSundry\Http\Controllers\BaseApiController;
use Touge\AdminSundry\Models\Calendar;

class CalendarController extends BaseApiController
{
    /**
     * @return mixed
     */
    public function sign_list(){
        $data= Calendar::where(['user_id'=> $this->user()->id, 'type'=> 0])->get();

        $result= [];
        foreach($data as $key=>$val){
            $row= [
                'startDate'=> $val->calendar_date,
                'endDate'=> $val->calendar_date,
                'title'=> $val->title,
                'classes'=> 'event-warning'
            ];
            array_push($result, $row);
        }

        return $this->success($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \App\Modules\ResponseFailedException
     * @throws \Touge\AdminSundry\Exceptions\ResponseFailedException
     */
    public function sign_in(Request $request){
        /**
         * 检测当前日期
         */
        $this->checkTodaySignIn();

        $options= [
            'user_id'=> $this->user()->id,
            'customer_school_id'=> $this->user()->customer_school_id,
            'type'=> $request->get('type', 0),
            'title'=> $request->get('title' ,''),
            'content'=> $request->get('content' , ''),
        ];
        $calendar= Calendar::create($options);

        if($calendar){
            $data= [
                'startDate'=> $calendar->calendar_date,
                'endDate'=> $calendar->calendar_date,
                'title'=> $calendar->title,
                'classes'=> 'event-warning'
            ];
            return $this->success($data);
        }

        return $this->failed('签到失败');
    }


    /**
     * 检测是否已经签过到了
     *
     * @throws \Touge\AdminSundry\Exceptions\ResponseFailedException
     */
    protected function checkTodaySignIn(){
        $count= Calendar::where(['user_id'=> $this->user()->id, 'type'=>0 ])
            ->whereDate('created_at', date('Y-m-d'))
            ->count();
        if($count>0){
            $this->failed('今天你已经签过了');
        }
    }
}
