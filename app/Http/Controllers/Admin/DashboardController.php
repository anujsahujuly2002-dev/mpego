<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LogoutRepository;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Exceptions\UnauthorizedException;

class DashboardController extends Controller
{
    private $logoutRepository;

    public function __construct()
    {
        $this->logoutRepository = New LogoutRepository;
    }
    public function dashboard () {
        return view('admin.dashboard');   
    }

    public function logout(Request $request){
        $logout = $this->logoutRepository->logout($request);
        return redirect()->route('admin.login')->with('success',"Your account has been logged out successfully.");
    }

    public function accountDeleteRequest() {
        if(!auth()->user()->can('account-delete-request-list')) {
            throw UnauthorizedException::forPermissions(['account-delete-request-list']);
        }
        $accountDeleteRequests = $this->logoutRepository->getAccountDeleteRequest();
        if (request()->ajax()) {
            return  DataTables::of($accountDeleteRequests)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
        return view('admin.account-deletion-request.index');
    }

    public function deleteAccountList(Request $request) {
        if(!auth()->user()->can('delete-account-list')) {
            throw UnauthorizedException::forPermissions(['delete-account-list']);
        }
        $deleteAccountList = $this->logoutRepository->getDeleteAccountList();
        if ($request->ajax()) {
            return Datatables::of($deleteAccountList)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                   
                    if (auth()->user()->can('delete-account-recover')) {
                        $btn .= ' <a href="javascript: void(0);" class="btn btn-soft-danger btn-icon btn-sm rounded-circle"  onclick="restoreRecord(\'' . route('admin.delete.account.recover') . '\',' . $row->id . ')"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-refresh"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg></a>';
                    }
                    return $btn;
                })
                ->rawColumns([])
                ->make(true);
        }
        return view('admin.delete-account-list.index');
    }

    public function deleteAccountRecover(Request $request) {
        try {
            if (!auth()->user()->can('delete-account-recover')) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'You do not have permission to recover accounts.',
                    ], 403);
                }
            }
            if($this->logoutRepository->deleteAccountRecover($request->input('id'))){
                return response()->json([
                    'status' => true,
                    'message' => 'Account recovered successfully.'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Account recovery failed. Please try again.',
                ], 500);

            }
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
        
    }


}   
