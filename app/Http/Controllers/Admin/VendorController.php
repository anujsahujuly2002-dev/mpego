<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VendorRequest;
use Spatie\Permission\Exceptions\UnauthorizedException;

class VendorController extends Controller
{
    public function index(Request $request) {
        if (!auth()->user()->can('vendor-list')) {
            throw UnauthorizedException::forPermissions(['vendor-list']);
        }
        if($request->ajax()):
        $vendors = Vendor::latest()->get();
        return datatables()->of($vendors)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';
                if (auth()->user()->can('vendor-edit')) {
                    $btn .= ' <a href="'.route('admin.vendor.edit',base64_encode($row->id)).'" class="btn btn-soft-primary btn-icon btn-sm rounded-circle"> <i class="ti ti-edit"></i></a>';
                }
                if (auth()->user()->can('vendor-delete')) {
                    $btn .= ' <button type="button" class="btn btn-soft-danger btn-icon btn-sm rounded-circle delete-user"  onclick="deleteRecord(\''.route('admin.vendor.delete').'\','.$row->id.')"> <i class="ti ti-trash"></i></button>';
                }
                return $btn;
            })
            ->rawColumns(['action', 'role'])
            ->make(true);
    endif;
        return view('admin.vendor.index');
    }

    public function create() {
        if (!auth()->user()->can('vendor-create')) {
            throw UnauthorizedException::forPermissions(['vendor-create']);
        }
        return view('admin.vendor.create');
    }

    public function store(VendorRequest $request) {
        if (!auth()->user()->can('vendor-create')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'You do not have permission to vendor create.',
                ], 403);
            }
        }
        try{
            $vendor = Vendor::create([
                'name_of_business' => $request->input("name_of_business"),
                'name_of_contact' => $request->input("name_of_contact"),
                'email' => $request->input("email"),
                'phone_number' => $request->input("phone_number"),
                'address' => $request->input("address"),
            ]);
            if($vendor) {
                return response()->json([
                    'status' => true,
                    'message' => 'Vendor created successfully',
                    'url' => route('admin.users.employee.index')
                ], 200);
            } else {
                return response()->json([
                    'status' =>false,
                    'message' => 'Failed to create vendor'
                ], 500);
            }
        }catch (Exception $e) {
           return response()->json([
                'status' => false,
                'message' => 'An error occurred while creating the vendor: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request) {
        if (!auth()->user()->can('vendor-delete')) {
           if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'You do not have permission to vendor delete.',
                ], 403);
            }
        }
        try {
            $vendor = Vendor::findOrFail($request->input("id"));
            $vendor->delete();
            return response()->json([
                'status' => true,
                'message' => 'Vendor deleted successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while deleting the vendor: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id) {
        if (!auth()->user()->can('vendor-edit')) {
            throw UnauthorizedException::forPermissions(['vendor-edit']);
        }
        $vendor = Vendor::findOrFail(base64_decode($id));
        return view('admin.vendor.edit', compact('vendor'));
    }

    public function update(VendorRequest $request) {
        if (!auth()->user()->can('vendor-edit')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'You do not have permission to vendor edit.',
                ], 403);
            }
        }
        try {
            $vendor = Vendor::findOrFail($request->input("id"));
            $vendor->update([
                'name_of_business' => $request->input("name_of_business"),
                'name_of_contact' => $request->input("name_of_contact"),
                'email' => $request->input("email"),
                'phone_number' => $request->input("phone_number"),
                'address' => $request->input("address"),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Vendor updated successfully',
                'url' => route('admin.vendor.index')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while updating the vendor: ' . $e->getMessage()
            ], 500);
        }
    }
}
