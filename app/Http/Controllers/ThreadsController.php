<?php

namespace App\Http\Controllers;


use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Response;
use Auth;
use Session;
use Flash;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\Search;
use App\User;
use App\Thread;
use App\Category;


class ThreadsController extends Controller
{
    public function __construct() {

        // $this->layout = "layouts.test";

        //FIRST TEMPLATE
        // $this->layout = "layouts.master";

        // // SECOND TEMPLATE
        // $this->layout = "layouts.master2";

        // // THIRD TEMPLATE
        $this->layout = 'layouts.master-layout';
   
    }


    public function getAdd()
    {

    }
    public function postAdd()
    {
        $sanitized_data = Job::sanitize(Input::all());
        $question = $sanitized_data['question'];
        $notify_me = isset($sanitized_data['notify-me'])?$sanitized_data['notify-me']:0;
        $categories = isset($sanitized_data['categories'])?json_encode($sanitized_data['categories']):null;

        $title = $question['title'];
        $description = $question['description'];

        $thread = new Thread;
        $thread->user_id = Auth::user()->id;
        $thread->title = $title;
        $thread->description = $description;
        $thread->categories = $categories;
        $thread->notify_me = $notify_me;
        $thread->status = 1;

        if($thread->save()) { // Save the user and redirect to freelancers home
            return Redirect::back();
        }
    }
    public function getView($id)
    {
        $threads = Thread::find($id);

        //ADD TO THE VIEWS
        $views_before = $threads->views;
        $views_after = $views_before + 1;
        $threads->views = $views_after;
        $threads->save();

        $categories_for_select = Category::prepareForSelect(Category::where('status',1)->get());
        $categories_for_side = Category::prepareForSide(Category::where('status',1)->get());
        return view('threads.view')
            ->with('layout',$this->layout)
            ->with('threads',$threads)
            ->with('categories_for_select',$categories_for_select)
            ->with('categories_for_side',$categories_for_side);
    }
    public function postSearchQuery()
    {
        if(Request::ajax()){
            $search_query = Input::get('search_text');
            $search_results = Search::search_function($search_query);
            $status = isset($search_results)?200:400;

            return Response::json(array(
                'status' => $status,
                'search_results' => $search_results
            ));
        }
    }
}
