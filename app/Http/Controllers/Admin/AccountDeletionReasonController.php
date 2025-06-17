<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\HelpRepository;
use Exception;
use Spatie\Permission\Exceptions\UnauthorizedException;

class AccountDeletionReasonController extends Controller
{
    private $helpRepository;

    public function __construct() {
        $this->helpRepository = New HelpRepository ();
    }

    public function index() {
        if(!auth()->user()->can('account-delete-reason-list')) {
           throw UnauthorizedException::forPermissions(['account-delete-reason-list']);
        }
        $reasons = $this->helpRepository->getAcountDeleteReasons();
        if(request()->ajax()) {
            return datatables()->of($reasons)
                ->addIndexColumn()
                ->editColumn('reason', function ($reason) {
                    return $reason->reason;
                })
        
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (auth()->user()->can('account-delete-reason-edit')) {
                        $btn .= '<a href="' . route('admin.account.deletion.edit',base64_encode( $row->id)) . '" class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i class="ti ti-pencil"></i></a>';
                    }
                    if (auth()->user()->can('account-delete-reason-delete')) {
                        $btn .= ' <a href="javascript: void(0);" class="btn btn-soft-danger btn-icon btn-sm rounded-circle"  onclick="deleteRecord(\'' . route('admin.account.deletion.delete') . '\',' . $row->id . ')"> <i class="ti ti-trash"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.account-deletion-reason.index');
    }

    public function delete(Request $request) {
        
        if (!auth()->user()->can('account-delete-reason-delete')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'You do not have permission to delete.',
                ], 403);
            }
        }
        try {
            $accountDeleteReason = $this->helpRepository->getAccountDeleteReasonById($request->input('id'));
            if ($accountDeleteReason->accountDeleteRequest()->count() >0) {
                return response()->json([
                    'status' => false,
                    'message' => 'This reason cannot be deleted as it is associated with existing account deletion requests.',
                ], 400);
            }
            $accountDeleteReason->delete();
            return response()->json([
                'status' => true,
                'message' => "Account deletion reason deleted successfully.",
                'url' => route('admin.account.deletion.index'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => "Some error occurred while deleting the account deletion reason. Please try again later.",
            ], 500);
        }
    }

    public function create() {
        if(!auth()->user()->can('account-delete-reason-create')) {
            throw UnauthorizedException::forPermissions(['account-delete-reason-create']);
        }
        return view('admin.account-deletion-reason.create');
    }

    public function store(Request $request) {
        try{
            if($this->helpRepository->accountDeleteReasonStore($request->all())) {
                return response()->json([
                    "status"=>true,
                    "message"=> "Account deletion reason create successfully.",
                    'url' => route('admin.account.deletion.index'),
                ]);
            } else {
                return response()->json([
                    'status'=> false,
                    'message'=>"Account deletion reason create failed, please try again"
                ]);
            }
        }catch (Exception $e) {
            return response()->json([
                'status'=> false,
                'message'=>"Some error occurred while creating the account deletion reason. Please try again later."
            ]);
        }
    }

    public function edit($id) {
        if(!auth()->user()->can('account-delete-reason-edit')) {
            throw UnauthorizedException::forPermissions(['account-delete-reason-edit']);
        }
        $reason = $this->helpRepository->getAccountDeleteReasonById(base64_decode($id));
        return view('admin.account-deletion-reason.edit', compact('reason'));
    }

    public function update(Request $request) {
        try {
            if($this->helpRepository->accountDeleteReasonUpdate($request->all(),$request->input('id'))):
                    return response()->json([
                    "status"=>true,
                    "message"=> "Account deletion reason update successfully.",
                    'url' => route('admin.account.deletion.index'),
                ]);
            else:
                return response()->json([
                    'status'=> false,
                    'message'=>"Account deletion reason update failed, please try again"
                ]);
            endif;
        }catch(Exception $e) {
            return response()->json([
                'status'=> false,
                'message'=> 'Some error occurred while update the account deletion reason. Please try again later.'
            ]);
        }
    }

}
