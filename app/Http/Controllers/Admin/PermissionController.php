<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    private $permissionRepository;

    public function __construct() {
        $this->permissionRepository = New PermissionRepository ();
    }
    public function index(Request $request) {
        if($request->ajax()) {
            $permissions = $this->permissionRepository->all();
            return DataTables::of($permissions)
             ->addIndexColumn()
                ->addColumn('action', function ($permission) {
                    return ' <a href="javascript: void(0);" class="link-reset fs-20 p-1"> <i class="ti ti-pencil"></i></a><a href="javascript: void(0);" class="link-reset fs-20 p-1"> <i class="ti ti-trash"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.permission.index');
    }
    public function create() {
        return view('admin.permission.create');
    }

    public function store(PermissionRequest $request) {
       try {
            $data['name'] = str_replace(' ','-',strtolower($request->input('name')));
            $data['group'] = $request->input('group');
            $permission = $this->permissionRepository->create($data);
            return response()->json([
                'status' => true,
                'message' => 'Permission created successfully',
                'url' => route('admin.permissions.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' =>"Some error occurred while creating the permission. Please try again later.",
            ], 500);
        }
    }
}
