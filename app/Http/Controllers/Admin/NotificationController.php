<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ScheduleCustomNotification;
use App\Repositories\UserManagementRepository;
use App\Http\Requests\Admin\NotificationRequest;
use App\Models\SendNotificationCustomUser;
use Spatie\Permission\Exceptions\UnauthorizedException;

class NotificationController extends Controller
{
    private $userManagementRepository;
    public function __construct()
    {
        $this->userManagementRepository = New UserManagementRepository();
    }
    public function index(Request $request) {
        if(!auth()->user()->can('notification-list'))
        throw UnauthorizedException::forPermissions(['notification-list']);
        if($request->ajax()):
            $scheduleCustomNotification =ScheduleCustomNotification::latest();
            return datatables()->of($scheduleCustomNotification)
                ->addIndexColumn()
                ->editColumn('message',function($row){
                    return strip_tags($row->message);
                })
                ->rawColumns(['action', 'role'])
                ->make(true);
        endif;
        return view('admin.notification.index');
    }

    public function create() {
        if(!auth()->user()->can('notification-create'))
        throw UnauthorizedException::forPermissions(['notification-create']);
        $users =$this->userManagementRepository->getAllClients()->get();
        return view('admin.notification.create',compact('users'));
    }

    public function store(NotificationRequest $request) {
        if($request->input('notification_type')=='schedule'):
            $scheduleTimeRaw = $request->input('schedule_time'); // e.g., "Jul,19,2025 01:50"
            $scheduleTime = Carbon::createFromFormat('M,d,Y H:i', $scheduleTimeRaw);
            $scheduleCustomNotification  = ScheduleCustomNotification::create([
                'message'=>$request->input('notification_message'),
                'schedule_time'=>$scheduleTime->format('Y-m-d H:i:s'),
                'status'=>"pending"
            ]);
            if(!empty($request->input('users'))):
                foreach($request->input('users') as $user):
                    SendNotificationCustomUser::create([
                        'schedule_custom_notify_id'=>$scheduleCustomNotification->id,
                        'user_id'=>$user
                    ]);
                endforeach;
            endif;
            return response()->json([
                'status' => 'true',
                "message" => "Your notification has been scheduled successfully.",
                'url' => route('admin.notification.index')
            ]);
        else:
        endif;
    }
}
