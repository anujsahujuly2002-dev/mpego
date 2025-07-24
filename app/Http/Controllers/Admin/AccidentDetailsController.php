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


    public function downloadAllAccidentImages($id) {
        $accident = $this->accidentRepository->findById(base64_decode($id));
        if(!$accident) {
            return redirect()->back()->with('error', 'Accident not found');
        }

        $images = $accident->accidentSeceneImages; // Assuming images is a collection of image paths
        if($images->isEmpty()) {
            return redirect()->back()->with('error', 'No images found for this accident');
        }
        $zipFileName = 'accident_images_' . time() . '.zip';
        $zip = new \ZipArchive();
        if ($zip->open(public_path($zipFileName), \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            foreach ($images as $image) {
                $url = $image->images;
                $storagePath = str_replace(
                    asset('storage'),
                    storage_path('app/public'),
                    $url
                );
                if (file_exists($storagePath)) {
                    $zip->addFile($storagePath, basename($storagePath));
                }
            }
            $zip->close();
        } else {
            return redirect()->back()->with('error', 'Failed to create zip file');
        }

        return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
    }

    public function downloadVehicleDamageImages($id) {
        $accident = $this->accidentRepository->findById(base64_decode($id));
        if(!$accident) {
            return redirect()->back()->with('error', 'Accident not found');
        }

        $images = $accident->vehicalDahicalImages; // Assuming images is a collection of image paths
        if($images->isEmpty()) {
            return redirect()->back()->with('error', 'No images found for this accident');
        }
        $zipFileName = 'vehicle_damage_images_' . time() . '.zip';
        $zip = new \ZipArchive();
        if ($zip->open(public_path($zipFileName), \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            foreach ($images as $image) {
                $url = $image->images;
                $storagePath = str_replace(
                    asset('storage'),
                    storage_path('app/public'),
                    $url
                );
                if (file_exists($storagePath)) {
                    $zip->addFile($storagePath, basename($storagePath));
                }
            }
            $zip->close();
        } else {
            return redirect()->back()->with('error', 'Failed to create zip file');
        }

        return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
    }

}
