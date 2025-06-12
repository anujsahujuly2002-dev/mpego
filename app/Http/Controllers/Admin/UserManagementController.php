<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Repositories\UserManagementRepository;
use Spatie\Permission\Exceptions\UnauthorizedException;

class UserManagementController extends Controller
{

    private $userManagementRepository;
    public function __construct()
    {
        $this->userManagementRepository = New UserManagementRepository();
    }

    public function index(Request $request) {

        if (!auth()->user()->can('user-list')) {
            throw UnauthorizedException::forPermissions(['user-list']);
        }
        if($request->ajax()):
            $users = $this->userManagementRepository->all();
            return datatables()->of($users)
                ->addIndexColumn()
                ->editColumn('name', function ($user) {
                    return ucwords(str_replace('-', ' ', $user->name));
                })
                ->editColumn('email', function ($user) {
                    return $user->email;
                })
                ->addColumn('role', function ($row) {
                    return $row->getRoleNames()->first() ? ucwords(str_replace('-',' ',$row->getRoleNames()->first())) : 'No Role Assigned';
                    ;
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (auth()->user()->can('user-view') && empty($row->getRoleNames()->first())) {
                        $btn .= ' <a href="'.route('admin.users.view.details',base64_encode($row->id)).'" class="btn btn-soft-primary btn-icon btn-sm rounded-circle"> <i class="ti ti-eye"></i></a>';
                    }
                    if (auth()->user()->can('user-edit') && !empty($row->getRoleNames()->first())) {
                        $btn .= '<a href="' . route('admin.users.edit', $row->id) . '" class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i class="ti ti-pencil"></i></a>';
                    }
                    if (auth()->user()->can('user-delete')  && !empty($row->getRoleNames()->first())) {
                        $btn .= ' <a href="javascript: void(0);" class="btn btn-soft-danger btn-icon btn-sm rounded-circle"  onclick="deleteRecord(\'' . route('admin.users.delete') . '\',' . $row->id . ')"> <i class="ti ti-trash"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'role'])
                ->make(true);
        endif;
        return view('admin.user-management.index');
    }

    public function viewDetails ($id) {
        if (!auth()->user()->can('user-view')) {
            throw UnauthorizedException::forPermissions(['user-view']);
        }
        $user = $this->userManagementRepository->find(base64_decode($id));
        return view('admin.user-management.view-details', compact('user'));
    }

    public function carDetails(Request $request,$userId) {
        if($request->ajax()):
            $carDetails = $this->userManagementRepository->getCarDetailByUserId(base64_decode($userId));
            return datatables()->of($carDetails)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        endif;
    }

    public function carInsuranceInfo(Request $request, $userId) {
        if($request->ajax()):
            $carInsuranceInfo = $this->userManagementRepository->getCarInsuranceInfoByUserId(base64_decode($userId));
            return datatables()->of($carInsuranceInfo)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        endif;
    }

    public function healthInsuranceInfo(Request $request, $userId) {
        if($request->ajax()):
            $healthInsuranceInfo = $this->userManagementRepository->getHealthInsuranceInfoByUserId(base64_decode($userId));
            return datatables()->of($healthInsuranceInfo)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        endif;
    }
    public function twoServiceInfo(Request $request, $userId) {
        if($request->ajax()):
            $twoServiceInfo = $this->userManagementRepository->getTwoServiceInfoByUserId(base64_decode($userId));
            return datatables()->of($twoServiceInfo)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        endif;
    }

    public function emergencyContactInfo(Request $request, $userId) {
        if($request->ajax()):
            $emergencyContactInfo = $this->userManagementRepository->getEmergencyContactInfoByUserId(base64_decode($userId));
            return datatables()->of($emergencyContactInfo)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        endif;
    }

    public function create() {
        if (!auth()->user()->can('user-create')) 
        throw UnauthorizedException::forPermissions(['user-create']);
        $roles = Role::whereNot('name','super-admin')->orderBy('name','ASC')->get();
        return view('admin.user-management.create',compact('roles'));
    }

    public function store(UserCreateRequest $request) {
        if (!auth()->user()->can('user-create')) {
            throw UnauthorizedException::forPermissions(['user-create']);
        }
        try {
            $data = $request->all();
            $data['password'] = 'Mepego@123#';
            $user = $this->userManagementRepository->store($data);
            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => "User information stored successfully",
                    'url' => route('admin.users.index')
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "User information not stored, Please try again",
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request) {
        if (!auth()->user()->can('user-delete')) {
             if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'You do not have permission to delete users.',
                ], 403);
            }
        }
        try {
            $user = $this->userManagementRepository->find($request->input('id'));
            if ($user) {
                $user->delete();
                return response()->json([
                    'status' => true,
                    'message' => "User deleted successfully",
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "User not found",
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
