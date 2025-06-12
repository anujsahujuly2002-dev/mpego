<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use Spatie\Permission\Models\Permission;
use App\Repositories\PermissionRepository;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleController extends Controller
{
    private $roleRepository,$permissionRepository;

    public function __construct()
    {
        $this->roleRepository = New RoleRepository ();
        $this->permissionRepository = New PermissionRepository ();
    }

    public function index(Request $request) {
        if(!auth()->user()->can('role-list')):
            throw UnauthorizedException::forPermissions(['role-list']);
        endif;
        if ($request->ajax()) {
            $roles = $this->roleRepository->all();
            return datatables()->of($roles)
                ->addIndexColumn()
                ->editColumn('name', function ($role) {
                    return ucwords(str_replace('-', ' ', $role->name));
                })
                ->addColumn('permission',function($row){
                $permission ='';
                foreach($row->permissions as $key => $permissions):
                    if($key%4 =='0' && $key != 0):
                        $permission .='<span class="badge rounded-pill bg-secondary">'.ucwords(str_replace('-',' ',$permissions->name)).'</span><br>';
                    else:
                        $permission .='<span class="badge rounded-pill bg-secondary">'.ucwords(str_replace('-',' ',$permissions->name)).'</span>';
                    endif;

                endforeach;
                return $permission;
            })
             ->addColumn('action', function ($row) {
                $btn = '';
                if(auth()->user()->can('role-edit')) :
                    $btn = ' <a href="'.route('admin.roles.edit',$row->id).'" class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i class="ti ti-pencil"></i></a>';
                endif;
                if(auth()->user()->can('role-delete')) :
                    $btn .= ' <a href="javascript: void(0);" class="btn btn-soft-danger btn-icon btn-sm rounded-circle"  onclick="deleteRecord(\''.route('admin.roles.delete').'\','.$row->id.')"> <i class="ti ti-trash"></i></a>';
                endif;
                return $btn;
            })
            ->rawColumns(['action','permission'])
            ->make(true);
        }
        return view('admin.role.index');
    }

    public function create()
    {
        if(!auth()->user()->can('role-create')):
            throw UnauthorizedException::forPermissions(['role-create']);
        endif;
        $permissions = $this->permissionRepository->getAllPermissionGroupWise(); // Assuming you have a method to get all permissions
        return view('admin.role.create',compact('permissions'));
    }

    public function store(RoleRequest $request)
    {

        try {
            $data['name'] = str_replace(' ', '-', strtolower($request->input('name')));
            $data['permissions'] = $request->input('permissions'); // Ensure permissions is an array
            $role = $this->roleRepository->create($data);
            return response()->json([
                'status' => true,
                'message' => 'Role created successfully',
                'url' => route('admin.roles.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Some error occurred while creating the role. Please try again later.",
            ], 500);
        }
    }


    public function edit($id)
    {
        if(!auth()->user()->can('role-edit')):
            throw UnauthorizedException::forPermissions(['role-edit']);
        endif;
        $role = $this->roleRepository->find($id);
        $permissions = $this->permissionRepository->getAllPermissionGroupWise();
        return view('admin.role.edit', compact('role', 'permissions'));
    }
    public function update(RoleRequest $request)
    {
        try {
            $data['name'] = str_replace(' ', '-', strtolower($request->input('name')));
            $data['permissions'] = $request->input('permissions'); // Ensure permissions is an array
            $role = $this->roleRepository->update($request->input('id'), $data);
            return response()->json([
                'status' => true,
                'message' => 'Role updated successfully',
                'url' => route('admin.roles.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => "Some error occurred while updating the role. Please try again later.",
            ], 500);
        }
    }


    public function delete(Request $request)
    {
        if (!auth()->user()->can('role-delete')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'You do not have permission to delete.',
                ], 403);
            }
        }
        try {
            $role = $this->roleRepository->find($request->input('id'));

            if (!$role) {
                return response()->json([
                    'status' => false,
                    'message' => 'Role not found',
                ], 404);
            }

            if ($role->users()->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot delete role. Users are assigned to this role.',
                ], 400);
            }

            $role->delete();

            return response()->json([
                'status' => true,
                'message' => 'Role deleted successfully',
                'url' => route('admin.roles.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => "Some error occurred while deleting the role. Please try again later.",
            ], 500);
        }
    }
}
