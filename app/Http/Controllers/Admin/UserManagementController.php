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

    public function client(Request $request) {

        if (!auth()->user()->can('client-list')) {
            throw UnauthorizedException::forPermissions(['client-list']);
        }
        if($request->ajax()):
            $users = $this->userManagementRepository->getAllClients();
            return datatables()->of($users)
                ->addIndexColumn()
                ->editColumn('name', function ($user) {
                    return ucwords(str_replace('-', ' ', $user->name));
                })
                ->editColumn('email', function ($user) {
                    return $user->email;
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (auth()->user()->can('client-view')) {
                        $btn .= ' <a href="'.route('admin.users.clients.view.details',base64_encode($row->id)).'" class="btn btn-soft-primary btn-icon btn-sm rounded-circle"> <i class="ti ti-eye"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'role'])
                ->make(true);
        endif;
        return view('admin.user-management.clients.index');
    }

    public function viewDetails ($id) {
        if (!auth()->user()->can('client-view')) {
            throw UnauthorizedException::forPermissions(['client-view']);
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
        if (!auth()->user()->can('client-create'))
        throw UnauthorizedException::forPermissions(['client-create']);
        $roles = Role::whereNot('name','super-admin')->orderBy('name','ASC')->get();
        return view('admin.user-management.clients.create',compact('roles'));
    }

    public function store(UserCreateRequest $request) {
        if (!auth()->user()->can('client-create')) {
            throw UnauthorizedException::forPermissions(['client-create']);
        }
        try {
            $data = $request->all();
            $user = $this->userManagementRepository->store($data);
            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => "Client information stored successfully",
                    'url' => route('admin.users.clients.index')
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Client information not stored, Please try again",
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


    public function employee(Request $request) {
        if (!auth()->user()->can('employee-list')) {
            throw UnauthorizedException::forPermissions(['employee-list']);
        }
        if($request->ajax()):
            $users = $this->userManagementRepository->getAllEmployees();
            return datatables()->of($users)
                ->addIndexColumn()
                ->editColumn('name', function ($user) {
                    return ucwords(str_replace('-', ' ', $user->name));
                })
                ->editColumn('email', function ($user) {
                    return $user->email;
                })
                ->addColumn('role', function ($user) {
                    return ucwords(str_replace('-',' ',$user->getRoleNames()->implode(', ')));
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (auth()->user()->can('employee-edit')) {
                        $btn .= ' <a href="'.route('admin.users.employee.edit',base64_encode($row->id)).'" class="btn btn-soft-primary btn-icon btn-sm rounded-circle"> <i class="ti ti-edit"></i></a>';
                    }
                    if (auth()->user()->can('employee-delete')) {
                        $btn .= ' <button type="button" class="btn btn-soft-danger btn-icon btn-sm rounded-circle delete-user"  onclick="deleteRecord(\''.route('admin.users.employee.delete').'\','.$row->id.')"> <i class="ti ti-trash"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        endif;
        return view('admin.user-management.employee.index');
    }

    public function employeeCreate() {
        if (!auth()->user()->can('employee-create')) {
            throw UnauthorizedException::forPermissions(['employee-create']);
        }
        $roles = Role::whereNotIn('name',['super-admin','existing-client','prior-client','potential-client'])->orderBy('name','ASC')->get();
        return view('admin.user-management.employee.create',compact('roles'));
    }

    public  function employeeStore(UserCreateRequest $request) {
        if (!auth()->user()->can('employee-create')) {
            throw UnauthorizedException::forPermissions(['employee-create']);
        }
        try {
            $data = $request->all();
            $data['password'] = 'Mepego@123#';
            $user = $this->userManagementRepository->store($data);
            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => "Employee information stored successfully",
                    'url' => route('admin.users.employee.index')
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Employee information not stored, Please try again",
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function employeeEdit($id) {
        if (!auth()->user()->can('employee-edit')) {
            throw UnauthorizedException::forPermissions(['employee-edit']);
        }
        $user = $this->userManagementRepository->find(base64_decode($id));
        $roles = Role::whereNotIn('name',['super-admin','existing-client','prior-client','potential-client'])->orderBy('name','ASC')->get();
        return view('admin.user-management.employee.edit', compact('user', 'roles'));
    }

    public function employeeUpdate(UserCreateRequest $request) {
        if (!auth()->user()->can('employee-edit')) {
            throw UnauthorizedException::forPermissions(['employee-edit']);
        }
        try {
            $data = $request->all();
            $user = $this->userManagementRepository->update($data);
            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => "Employee information updated successfully",
                    'url' => route('admin.users.employee.index')
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Employee information not updated, Please try again",
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
