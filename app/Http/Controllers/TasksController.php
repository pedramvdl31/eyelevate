<?php

namespace App\Http\Controllers;
use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Route;
use Response;
use Auth;
use URL;
use Session;
use Laracasts\Flash\Flash;
use View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Admin;
use App\Role;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;
use App\Task;
use App\TaskComment;
use App\Helpers\UploadHelper;



class TasksController extends Controller
{



    public function __construct() {
        // Define layout
        $this->layout = 'layouts.admins';
        $this_username = null;
        //PROFILE IMAGE
        $this_user_profile_image = null;
        if (Auth::check()) {
            $this_user = User::find(Auth::user()->id);
            $this_username = $this_user->username;
            //PROFILE IMAGE
            $this_user_profile_image = Job::imageValidator($this_user->profile_image);
        } 
        View::share('this_username',$this_username);
        View::share('this_user_profile_image',$this_user_profile_image);

    }    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $setup_tasks = Task::getTasksByType(Auth::user()->id);
        return view('tasks.index')
        ->with('layout',$this->layout)
        ->with('tasks',$setup_tasks)
        ->with('user_id',Auth::user()->id);
    }

    /**
     * Adds a task 
     *
     * @return Response
     */
    public function getAdd()
    {
        $types = Task::getTaskTypes();
        $approved_administrators = Admin::getApprovedAdmins();
        return view('tasks.add')
         ->with('layout',$this->layout)
         ->with('types',$types)
         ->with('admins',$approved_administrators); 
    }  
    /**
     * Process Task Request
     *
     * @return Response
     */
    public function postAdd()
    {

        $task = new Task;
        $task->title = Input::get('title');
        $task->description = Input::get('description');
        $task->created_by = Auth::user()->id;
        $task->type = Input::get('type');
        $task->status = 1; // New status
        $task->assigned_id = Input::get('assigned_id');
        $task->image_src = (count(Input::get('files')) > 0) ? json_encode(Input::get('files')) : null;

        if ($task->save()) {
            Flash::success('Successfully Added Task');
            return Redirect::route('tasks_index');
        } else {
            Flash::Error('Error');
            return Redirect::back();
        }
        
    }  
    /**
     * /admins/tasks/edit.
     * @param $id - task_id
     * @return Response
     */
    public function getEdit($id = null)
    {
        $tasks = Task::prepareForView($id);
        $types = Task::getTaskTypes();
        $approved_administrators = Admin::getApprovedAdmins();
        return view('tasks.edit')
         ->with('layout',$this->layout)
         ->with('tasks',$tasks)
         ->with('types',$types)
         ->with('admins',$approved_administrators); 
    } 
    /**
     * Process Task Edit Request
     *
     * @return Response
     */
    public function postEdit()
    {

        $task = Task::find(Input::get('id'));
        $task->title = Input::get('title');
        $task->description = Input::get('description');
        $task->created_by = Auth::user()->id;
        $task->type = Input::get('type');
        $task->assigned_id = Input::get('assigned_id');
        $new_images = Input::get('files');
        if(count($new_images) > 0){
            ksort($new_images);
        }
        
        $task->image_src = (count($new_images) > 0) ? json_encode($new_images) : null;     
 
        if ($task->save()) {
            Flash::success('Successfully Updated Tasks');
            return Redirect::route('tasks_index');
        } else {
            Flash::Error('Error');
            return Redirect::back();
        }
        
    }  
    /**
     * /admins/tasks/view.
     * @param $id - task_id
     * @return Response
     */
    public function getView($id = null)
    {
        $task = Task::prepareForView($id);
        $task_comments = TaskComment::prepareForView($id);

        return view('tasks.view')
            ->with('layout',$this->layout)
            ->with('task',$task)
            ->with('task_comments',$task_comments); 
    } 


    public function postTaskCompleted()
    {
        $task_id = Input::get('task_id2');
        $tasks = Task::find($task_id);
        $tasks->status = 3;
        $tasks->save();

        return Redirect::route('tasks_index');
    } 

    
    /**
     * Update Task Request
     *
     * @return Response
     */
    public function postView()
    {
        
        $task_id = Input::get('task_id');
        $comment = Input::get('comment');
        $commenter_id = Auth::user()->id;

        $task_comment = new TaskComment;
        $task_comment->task_id = $task_id;
        $task_comment->comment = json_encode($comment);
        $task_comment->user_id = $commenter_id;

        if ($task_comment->save()) {
            Flash::success('Successfully Updated');
            return Redirect::back();
        } else {
            Flash::Error('Error');
            return Redirect::back();
        }
        
    } 
    /**
     * Update Task Request
     *
     * @return Response
     */
    public function postUpload()
    {

        error_reporting(E_ALL | E_STRICT);
        $destinationPath = public_path("assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."tasks/");
        $savePath = DIRECTORY_SEPARATOR."assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."tasks".DIRECTORY_SEPARATOR;
        // Check if directory is made for this company if not then create a new directory
        if (!file_exists($destinationPath)) {
            @mkdir($destinationPath);
        }    
        $files = Input::file('files');
        $fileName = str_random(12).'.jpg';

        // Check image for errors

        // Save image and rename it to new name
        if(Input::file('files')->move($destinationPath, $fileName)){
            return Response::json([
                'success'=>true,
                'path'=> $savePath.$fileName
            ]);
        } else {
            return Response::json([
                'success'=>false,
                'reason'=> 'Error saving image.' 
            ]);
        } 

        
    }  

    /**
    * remove images from system and update database
    * @param task_id
    * @param src
    * @return array
    **/
    public function postRemove() {
        if(Request::ajax()) {
            $status = false; // Start status check
            $image_src = Input::get('src');
            $task_id = Input::get('id');
            $tasks = Task::find($task_id);
            $imagePath = DIRECTORY_SEPARATOR."assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."tasks".DIRECTORY_SEPARATOR."*.*";
            if(isset($tasks->image_src)) {
                $new_image_src = json_decode($tasks->image_src,true);
                foreach($new_image_src as $key => $value) {

                    if($value['path'] == $image_src) { // Matches in db so remove from the set
                        unset($new_image_src[$key]); // removes image from array
                        // remove image from folder
                        foreach(glob($imagePath) as $file) {
                            if(is_file($file)) {
                                @unlink($file);
                                $status = true; // successfully removed image
                            }   
                        }
                        // update the db with a new 
                        $tasks->image_src = json_encode($new_image_src);
                        if($tasks->save()){
                            return Response::json(['success'=>true]);
                        }
                    }
                }
            }

            return Response::json(['success'=>false]);
        }
    }

}
