<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function prepareForSelect($data) {
		$categories = array(''=>'Choose a Categories');
		if(isset($data)) {
			foreach ($data as $key => $value) {
				$categories_id = $value['id'];
				$categories[$categories_id] = $value['name']; 
			}
		}
		return $categories;
	}
	public static function prepareForSide($data) {
		$categories = [];
		if(isset($data)) {
			foreach ($data as $key => $value) {
				$categories_id = $value['id'];
				$categories[$categories_id] = $value['name']; 
			}
		}
		return $categories;
	}
	public static function prepareSearchedCat($data) {
		$categories = [];
		$html = '';
		if(isset($data)) {
			$threads = Thread::where('status',1)->get();
			foreach ($threads as $thkey => $thvalue) {
				$is_match = false;
				$this_cat = json_decode($thvalue->categories);
				foreach ($this_cat as $tckey => $tcvalue) {
					foreach ($data as $dakey => $davalue) {
						if ($tcvalue == $davalue) {
							$is_match = true;
						}
					}
				}
				if ($is_match == true) {
					$this_thread = Thread::find($thvalue->id);
					$users = User::find($this_thread->user_id);
					$username = $users->username;

					$profile_image = Job::imageValidator($users->profile_image);

					$categories_j = json_decode($this_thread->categories);
					$categories_prepared = Thread::prepareCategories($categories_j);

					$time_s = date(strtotime($this_thread['created_at']));
					$time_ago = Thread::humanTiming($time_s);
					if ($time_ago == null) {
						$time_ago = 'just now';
					} else {
						$time_ago = $time_ago.' ago';
					}

					$html .= '<div class="thread-single">
						        <div class="media">
						          <div class="media-left">
						            <a href="#">
						              <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/profile-images/perm/'.$profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">
						            </a>
						          </div>
						          <div class="media-body">
						            <div class="media-inner-left">
						              <h4 ><a href="/threads/view/'.$this_thread->id.'">'.$this_thread->title.'</a></h4>
						              <div class="thread-info">'.$username.' . 
						                <span class="thread-date">'.$time_ago.'</span>
						              </div> 
						            </br>
						            <div class="label-container">
										'.$categories_prepared.'
						            </div>
						          </div>
						          <div class="media-inner-right">
						            <div class="right-text"><span class="reply-no"><i class="fa fa-eye"></i></span></br><span class="reply-html">'.$this_thread->views.'</span></div>
						          </div>
						        </div>
						      </div>
						    </div>';
				}
			}

		}
		return $html;
	}
}
