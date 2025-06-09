<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccidentInfoRequest;
use App\Repositories\AccidentRepository;

class AccidentDetailsController extends Controller
{
    private $accidentRepository;

    public function __construct()
    {
        $this->accidentRepository = New AccidentRepository();
    }

    public function accidentDetails (AccidentInfoRequest $request) {
        try {
            $data =$request->all();
            $data['user_id'] = auth()->id(); // Assuming the user is authenticated
            $accident = $this->accidentRepository->create($data);
            return response()->json([
                'status' => true,
                'message' => 'Accident details saved successfully',
                'data' => $accident
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to save accident details',
            ], 500);
        }
    }

}
