<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function __construct() {

        // $this->layout = "layouts.test";

        //FIRST TEMPLATE
        // $this->layout = "layouts.master";

        // // SECOND TEMPLATE
        // $this->layout = "layouts.master2";

        // // THIRD TEMPLATE
        $this->layout = "layouts.master3";
   
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        return view('home.index3')
            ->with('layout',$this->layout);
    }
}
