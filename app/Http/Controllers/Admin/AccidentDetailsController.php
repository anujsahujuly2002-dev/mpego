<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AccidentRepository;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Exceptions\UnauthorizedException;

class AccidentDetailsController extends Controller
{
    private $accidentRepository;

    public function  __construct()
    {
        $this->accidentRepository = New AccidentRepository ();
    }

    public function index() {
         if(!auth()->user()->can('accident-list')) {
           throw UnauthorizedException::forPermissions(['accident-list']);
        }
        $accidents = $this->accidentRepository->all();
        if(request()->ajax()) {
            return datatables()->of($accidents)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= '<a href="'.route('admin.accident.image',base64_encode($row->id)).'" class="btn btn-soft-primary btn-icon btn-sm rounded-circle" title="View Image"> <i class="ti ti-eye"></i></a>';
                
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.accident-details.index');
    }

    public function accidentImage($id) {
        $accident = $this->accidentRepository->findById(base64_decode($id));
        return view('admin.accident-details.image', compact('accident'));
    }   

}
