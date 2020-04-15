<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
use App\Core\Services\Guest\StakeHoldersService;
use Illuminate\Http\Request;

class StakeHoldersController extends Controller{
    

	protected $stakeholders;


    public function __construct(StakeHoldersService $stakeholders){
        $this->stakeholders = $stakeholders;
    }


    public function index(Request $request){
        return $this->stakeholders->list($request);
    }


    public function viewTradersDirectoryDoc($slug){
        return $this->stakeholders->viewTradersDirectoryDoc($slug);
    }


    public function viewPlantersDirectoryDoc($slug){
        return $this->stakeholders->viewPlantersDirectoryDoc($slug);
    }


}
