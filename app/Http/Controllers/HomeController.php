<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Input;
use Session;
use Auth;
use URL;
use Flash; // Session Flash helper

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\Thread;
use App\Category;

class HomeController extends Controller
{

    public function __construct() {

        // $this->layout = "layouts.test";

        //FIRST TEMPLATE
        // $this->layout = "layouts.master";

        // // SECOND TEMPLATE
        // $this->layout = "layouts.master2";

        // // THIRD TEMPLATE
        $this->layout = "layouts.home-layout";
   
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $reset_success = (Session::get('reset_success')) ? true : false;
        $username = (Auth::check()) ? Auth::user()->username : null;
        return view('home.home-index')
            ->with('layout',$this->layout)
            ->with('username',$username)
            ->with('reset_success',$reset_success);
    }

    public function postIndex()
    {
        $prepared_thread = Thread::prepareThreadForView(Thread::Where('status',1)
            ->orderBy('created_at', 'DESC')
            ->paginate(10));

        $prepared_thread_clone = Thread::Where('status',1)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);


        $this->layout = 'layouts.master-layout';
        $categories_for_select = Category::prepareForSelect(Category::where('status',1)->get());
        $categories_for_side = Category::prepareForSide(Category::where('status',1)->get());
        return view('home.results')
            ->with('layout',$this->layout)
            ->with('threads',$prepared_thread)
            ->with('prepared_thread_clone',$prepared_thread_clone)
            ->with('categories_for_select',$categories_for_select)
            ->with('categories_for_side',$categories_for_side);
    } 
}
