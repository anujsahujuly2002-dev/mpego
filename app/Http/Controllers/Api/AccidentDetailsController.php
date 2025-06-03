<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AccidentRepository;

class AccidentDetailsController extends Controller
{
    private $accidentRepository;

    public function __construct()
    {
        $this->accidentRepository = New AccidentRepository();
    }

    public function accidentDetails () {
        
    }

}
