<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                    return $row->getRoleNames()->implode(', ');
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (auth()->user()->can('user-edit')) {
                        $btn .= '<a href="' . route('admin.users.edit', $row->id) . '" class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i class="ti ti-pencil"></i></a>';
                    }
                    if (auth()->user()->can('user-delete')) {
                        $btn .= ' <a href="javascript: void(0);" class="btn btn-soft-danger btn-icon btn-sm rounded-circle"  onclick="deleteRecord(\'' . route('admin.users.delete') . '\',' . $row->id . ')"> <i class="ti ti-trash"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'role'])
                ->make(true);
        endif;
        return view('admin.user-management.index');
    }
}
