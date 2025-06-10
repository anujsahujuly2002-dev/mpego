<?php

namespace App\Http\Controllers\Admin;

use PHPUnit\TextUI\Help;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\HelpRepository;
use Exception;

class HelpController extends Controller
{
    private $helpRepository;
    public function __construct()
    {
        $this->helpRepository = New HelpRepository();
    }
    public function index()
    {
        return view('admin.help.create');
    }

    public function store(Request $request)
    {
        try {            
           $this->helpRepository->store($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Settings updated successfully',
                'url' => route('admin.help.index')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' =>"Some error occurred while updating the setting. Please try again later.",
            ], 500);
        }
    }

    


}
