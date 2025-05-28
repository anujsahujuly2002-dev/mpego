<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\PermissionRepository;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionController extends Controller
{
    private $permissionRepository;

    public function __construct() {
        $this->permissionRepository = New PermissionRepository ();
    }
    public function index(Request $request) {
        if(!auth()->user()->can('permisson-list')):
            throw UnauthorizedException::forPermissions(['permisson-list']);
        endif;
        if($request->ajax()) {
            $permissions = $this->permissionRepository->all();
            return DataTables::of($permissions)
             ->addIndexColumn()
                ->addColumn('action', function ($permission) {
                    $btn = '';
                    if(auth()->user()->can('permission-edit')) :
                        $btn .= '<a href="'.route('admin.permissions.edit',$permission->id).'" class="link-reset fs-20 p-1"> <i class="ti ti-pencil"></i></a>'; 
                    endif;
                    if(auth()->user()->can('permission-delete')) :
                        $btn .= '<a href="javascript: void(0);" class="link-reset fs-20 p-1" onclick="deleteRecord(\''.route('admin.permissions.delete').'\','.$permission->id.')"> <i class="ti ti-trash"></i></a>';
                    endif;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.permission.index');
    }
    public function create() {
        if(!auth()->user()->can('permission-create')):
            throw UnauthorizedException::forPermissions(['permission-create']);
        endif;
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

    public function edit($id) {
        if(!auth()->user()->can('permisson-edit')):
            throw UnauthorizedException::forPermissions(['permisson-edit']);
        endif;
        $permission = $this->permissionRepository->find($id);
        return view('admin.permission.edit', compact('permission'));
    }

    public function update(PermissionRequest $request) {
        try {
            $data['name'] = str_replace(' ','-',strtolower($request->input('name')));
            $data['group'] = $request->input('group');
            $permission = $this->permissionRepository->update($request->input('id'), $data);
            return response()->json([
                'status' => true,
                'message' => 'Permission updated successfully',
                'url' => route('admin.permissions.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' =>"Some error occurred while updating the permission. Please try again later.",
            ], 500);
        }
    }

    public function delete(Request $request) {
        if (!auth()->user()->can('permission-delete')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'You do not have permission to delete.',
                ], 403);
            }
        }
        try {
            $permissionId = $request->input('id');
            $permission = $this->permissionRepository->find($permissionId);

            // Check if permission is assigned to any role
            if ($permission->roles()->count() > 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'This permission is assigned to one or more roles and cannot be deleted.',
                ], 403);
            }

            $this->permissionRepository->delete($permissionId);

            return response()->json([
                'status' => true,
                'message' => 'Permission deleted successfully',
                'url' => route('admin.permissions.index')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' =>"Some error occurred while deleting the permission. Please try again later.",
            ], 500);
        }
    }
}
