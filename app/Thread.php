<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Job;
use App\Reply;
use App\Flag;
use Auth;

class Thread extends Model
{
	static public function prepareThreadForView($data) {
		$html = '' ;
		if (isset($data)) {
			foreach ($data as $dakey => $davalue) {

				$users = User::find($davalue->user_id);
				$username = $users->username;

				$profile_image = Job::imageValidator($users->profile_image);

				$categories_j = json_decode($davalue->categories);
				$categories_prepared = Thread::prepareCategories($categories_j);

				$time_s = date(strtotime($davalue['created_at']));
				$time_ago = Job::formatTimeAgo(Job::humanTiming($time_s));

				$html .= '<div class="thread-single">
							        <div class="media">
							          <div class="media-left">
							            <a href="#">
							              <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">
							            </a>
							          </div>
							          <div class="media-body">
							            <div class="media-inner-left">
							              <h4 ><a href="/threads/view/'.$davalue->id.'">'.$davalue->title.'</a></h4>
							              <div class="thread-info">'.$username.' - 
							                <span class="thread-date">'.$time_ago.'</span>
							              	
							              </div> 
							            </br>
							            <div class="label-container">
											'.$categories_prepared.'
							            </div>
							          </div>
							          <div class="media-inner-right">
							            <div class="right-text"><span class="reply-no"><i class="fa fa-eye"></i></span></br><span class="reply-html">'.$davalue->views.'</span></div>
							          </div>
							        </div>
							      </div>
							    </div>';
			}
		}
		return $html;
	}


	static public function prepareSearchedResults($search_results) {
		$html = '<h4>Your Search Results : </h4>';

		foreach ($search_results as $srkey => $srvalue) {

				$davalue = Thread::find($srkey);

				$users = User::find($davalue->user_id);
				$username = $users->username;

				$profile_image = Job::imageValidator($users->profile_image);

				$categories_j = json_decode($davalue->categories);
				$categories_prepared = Thread::prepareCategories($categories_j);

				$time_s = date(strtotime($davalue['created_at']));
				$time_ago = Job::formatTimeAgo(Job::humanTiming($time_s));

				$html .= '<div class="thread-single">
							        <div class="media">
							          <div class="media-left">
							            <a href="#">
							              <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">
							            </a>
							          </div>
							          <div class="media-body">
							            <div class="media-inner-left">
							              <h4 ><a href="/threads/view/'.$davalue->id.'">'.$davalue->title.'</a></h4>
							              <div class="thread-info">'.$username.' . 
							                <span class="thread-date">'.$time_ago.'</span>
							              	
							              </div> 
							            </br>
							            <div class="label-container">
											'.$categories_prepared.'
							            </div>
							          </div>
							          <div class="media-inner-right">
							            <div class="right-text"><span class="reply-no"><i class="fa fa-eye"></i></span></br><span class="reply-html">'.$davalue->views.'</span></div>
							          </div>
							        </div>
							      </div>
							    </div>';
		}

		$html .= '<h4 class="other-thread">Other threads:</h4><hr>';
		return $html;
	}
	static public function prepareCategories($cat) {
		$cat_html = '';
		if (isset($cat)) {
			$categories_name = null;
			foreach ($cat as $cakey => $cavalue) {
				$categories = Category::find($cavalue);
				$cat_html .= '<span class="label label-default label-style">'.$categories['name'].'</span>';
			}
		}
		return $cat_html;
	}

	static public function prepareThreadStatus($status) {
		if (isset($status)) {
			switch ($status) {
				case 7:
					$status = 2;
					break;
			}
		}
		return $status;
	}

	static public function prepareCategoriesForFeedback($cat) {
		$cat_html = '<h4>You searched for : </h4>';
		if (isset($cat)) {
			$count = 1;
			$categories_name = null;
			$cat_size = sizeof($cat);
			$new_size = ($cat_size - 1);
				if ($cat_size == 1) {
					foreach ($cat as $cakey => $cavalue) {
						$categories = Category::find($cavalue);
						$cat_html .= '<strong><span>'.$categories['name'].' - </span></strong>';
					}
				} else {
					foreach ($cat as $cakey => $cavalue) {
						$categories = Category::find($cavalue);
						if ($count < $cat_size) {
							$cat_html .= '<strong><span>'.$categories['name'].', </span></strong>';
						} else{
							$cat_html .= '<strong><span>'.$categories['name'].' - </span></strong>';				
						}
						$count++;
					}
				}
		}
		$cat_html .= 'did not match any threads.';
		$cat_html .= '<hr><h4>Suggestions:</h4>
						<ul>
						  <li>Make sure all categories are chosen correctly</li>
						  <li>Try Selecting fewer categories</li>
						</ul> 
		';
		return $cat_html;
	}

	static public function prepareCategoriesAfterSearch($cat,$item_selected) {
		$cat_html = '';
		if (isset($cat)) {
			$categories_name = null;
			foreach ($cat as $cakey => $cavalue) {
				$categories = Category::find($cavalue);
				$check_match = false;
				foreach ($item_selected as $sikey => $sivalue) {
					if ($cavalue == $sivalue) {
						$cat_html .= '<span class="label label-primary label-style">'.$categories['name'].'</span>';
						$check_match = true;
						break;
					} else {
						continue;
					}
				}
				if($check_match == false) {
					$cat_html .= '<span class="label label-default label-style">'.$categories['name'].'</span>';
				}
			}
		}
		return $cat_html;
	}


	static public function prepareThreadsAndThreadReply($threads) {
		$html = '' ;
		if (isset($threads)) {
			if (isset($threads->description)) {
				$threads->description = json_decode($threads->description);
			}
			$ban_flag = false;
			$count_for_ban = 0;

			$count_for_ban_re = 0;
			$this_user = User::find($threads->user_id);
			$this_main_username = $this_user->username;
			//TIME AGO
			$time_s = date(strtotime($threads['created_at']));
			$time_ago_main = Job::formatTimeAgo(Job::humanTiming($time_s));
			//PROFILE IMAGE
			$profile_image = Job::imageValidator($this_user->profile_image);

			//FLAGS COUNT
			$main_flag_count = count(Flag::where('reply_id',0)
						->where('thread_id',$threads->id)
						->whereNull('quote_id')
						->whereIn('status', array(1,2,4,5,7))
						->get());

			if (Auth::check()) {
				$count_for_ban = count(Flag::where('reply_id',0)
							->where('thread_id',$threads->id)
							->where('status', 3)
							->where('flagger_user_id',Auth::user()->id)
							->get());
				if ($count_for_ban != 0) {
					$ban_flag = true;
				}
			}
			$is_owner = false;
			$setting_icon = '';
			if (Auth::check()) {
				if ($threads->user_id == Auth::user()->id) {
					$is_owner = true;
					$setting_icon = '<i class="glyphicon glyphicon-cog setting-icon"></i>';
				}
			}
			//PREPARING THE MAIN THREADS
			$html .= '<div class="thread-single" id="main-thread">
				            <div class="media">
				              <div class="media-left">
				                <a href="#">';
            if ($is_owner == true) {
            	$html .='<img class="media-object auth-img-border" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">';
            } else {
              $html .='<img class="media-object media-image" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">';
            }
          $html .=  '</a>
          </div>
          <div class="media-body">
            <div class="media-inner-left">
              <div class="thread-info"> <span class="quoter-username">'.$this_main_username.'</span>
                <span class="thread-date"> - '.$time_ago_main.'</span>
                	'.$setting_icon.'
        			<div class="panel-btn-bg pull-right panel-parent" this_reply="0" this_thread="'.$threads->id.'">';
				

		    if ($ban_flag != true) {
		    	if ($is_owner != true) {
					$html .=	'<div class="btn-group" role="group" aria-label="...">
							  <button type="button" class="btn btn-default btn-panel-single flag-it"><i class="glyphicon glyphicon-flag"></i></br><span class="inner-val">'.$main_flag_count.'</span></button>
							</div>';
						}
		    }
 
             $html .=    '</div>
				                  </div> 
				                  <h4>'.$threads->title.'</h4>
				                </br>
				                <div class="thread-description">
									'.$threads->description.'
				                </div>
				                  <div class="label-container">
				                  </div>
				                </div>
				              </div>
				            </div>
				          </div>';

				          if ($is_owner == true) {
				          	$html .= '';
				          }

			//GET ALL REPLIES
			$all_replies = Reply::where('thread_id',$threads->id)
				->where('quote_id',null)
				->get();
			foreach ($all_replies as $arkey => $arvalue) {
				if ($arvalue->status != 3) {
				$ban_flag_re = false;
				$is_owner_reply = false;
				$this_replier = User::find($arvalue->user_id);
				$this_replier_username = $this_replier->username;

				//TIME AGO
				$time_s_r = date(strtotime($arvalue['created_at']));
				$time_ago_replies = Job::formatTimeAgo(Job::humanTiming($time_s_r));

				//PROFILE IMAGE
				$replier_profile_image = Job::imageValidator($this_replier->profile_image);

				//NUMBER OF QUOTES
				$quote_count = count(Reply::where('quote_id',$arvalue->id)->get());

				//FLAGS COUNT
				$flag_count = count(Flag::where('reply_id',$arvalue->id)
											->where('thread_id',$threads->id)
											->whereNull('quote_id')
											->whereIn('status', array(1,2,4,5,7))
											->get());

				// LIKES
				$like_count = count(Like::where('reply_id',$arvalue->id)
											->where('thread_id',$threads->id)
											->get());


				// DISLIKES
				$dislike_count = count(Dislike::where('reply_id',$arvalue->id)
											->where('thread_id',$threads->id)
											->get());

				if (Auth::check()) {
					$count_for_ban_re = count(Flag::where('reply_id',$arvalue->id)
								->where('thread_id',$threads->id)
								->where('status', 3)
								->where('flagger_user_id',Auth::user()->id)
								->get());
					if ($count_for_ban_re != 0) {
						$ban_flag_re = true;
					}
				}
				if (Auth::check()) {
					if ($arvalue->user_id == Auth::user()->id) {
						$is_owner_reply = true;
					}
				}
					//PREPARE ALL REPLIES
					$html .= '<div class="panel-btn-sm pull-right panel-parent reply-sm-'.$arvalue->id.'" this_reply="'.$arvalue->id.'" this_thread="'.$threads->id.'">
								<div class="btn-group" role="group" aria-label="...">';
					if ($is_owner_reply != true) {	
						if ($ban_flag_re != true) {	
									$html .= '<button type="button" class="btn btn-default btn-panel-single show-quote" style="width: 25%"><i class="fa fa-quote-right"></i></br><span class="inner-val">'.$quote_count.'</span></button>
						 					 <button type="button" class="btn btn-default btn-panel-single eye-like" style="width: 25%"><i class="fa fa-thumbs-o-up"></i></br><span class="inner-val">'.$like_count.'</span></button>
											  <button type="button" class="btn btn-default btn-panel-single dont-like" style="width: 25%"><i class="fa fa-thumbs-o-down"></i></br><span class="inner-val">'.$dislike_count.'</span></button>';
									$html .=  '<button type="button" class="btn btn-default btn-panel-single flag-it" style="width: 25%"><i class="glyphicon glyphicon-flag"></i></br><span class="inner-val">'.$flag_count.'</span></button>';
								} else {
									$html .= '<button type="button" class="btn btn-default btn-panel-single show-quote" style="width: 33.333333333333%"><i class="fa fa-quote-right"></i></br><span class="inner-val">'.$quote_count.'</span></button>
				 					<button type="button" class="btn btn-default btn-panel-single eye-like" style="width: 33.333333333333%"><i class="fa fa-thumbs-o-up"></i></br><span class="inner-val">'.$like_count.'</span></button>
									<button type="button" class="btn btn-default btn-panel-single dont-like" style="width: 33.333333333333%"><i class="fa fa-thumbs-o-down"></i></br><span class="inner-val">'.$dislike_count.'</span></button>';
								}
						} else {
							$html .= '<button type="button" class="btn btn-default btn-panel-single show-quote" style="width: 33.333333333333%"><i class="fa fa-quote-right"></i></br><span class="inner-val">'.$quote_count.'</span></button>
							  <button type="button" class="btn btn-default btn-panel-single eye-like" style="width: 33.333333333333%"><i class="fa fa-thumbs-o-up"></i></br><span class="inner-val">'.$like_count.'</span></button>
							  <button type="button" class="btn btn-default btn-panel-single dont-like" style="width: 33.333333333333%"><i class="fa fa-thumbs-o-down"></i></br><span class="inner-val">'.$dislike_count.'</span></button>';
						}
						$arvalue->reply = json_decode($arvalue->reply);
						$html .='</div>
				                    </div>
									<div class="thread-single">
							            <div class="media">
							              <div class="media-left">
							                <a href="#">';
						if ($is_owner_reply == true) {
							$html .= '<img class="media-object auth-img-border" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$replier_profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">';
						} else {
							$html .= '<img class="media-object media-image" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/'.$replier_profile_image.'" data-holder-rendered="true" style="width: 64px; height: 64px;">';
						}

						$html .= '</a>
									</div>
									<div class="media-body">
									<div class="media-inner-left">
									<div class="thread-info"><span class="quoter-username">'.$this_replier_username.'</span>
									<span class="thread-date"> - '.$time_ago_replies.'</span>
									<div class="panel-btn-bg pull-right panel-parent reply-bg-'.$arvalue->id.'"  this_reply="'.$arvalue->id.'" this_thread="'.$threads->id.'">
									<div class="btn-group  role="group" aria-label="...">
									<button type="button" class="btn btn-default btn-panel-single show-quote"><i class="fa fa-quote-right"></i></br><span class="inner-val">'.$quote_count.'</span></button>
									<button type="button" class="btn btn-default btn-panel-single eye-like"><i class="fa fa-thumbs-o-up"></i></br><span class="inner-val">'.$like_count.'</span></button>
									<button type="button" class="btn btn-default btn-panel-single dont-like"><i class="fa fa-thumbs-o-down"></i></br><span class="inner-val">'.$dislike_count.'</span></button>';
							if ($ban_flag_re != true) {	
								if ($is_owner_reply != true) {		 
									$html .=  '<button type="button" class="btn btn-default btn-panel-single flag-it"><i class="glyphicon glyphicon-flag"></i></br><span class="inner-val">'.$flag_count.'</span></button>';
								}
							}
						$html .= '</div>
					                    </div>
					                  </div> 
					                </br>
					                <div class="thread-description">
										'.$arvalue->reply.'
					                  </div>
					                  <div class="label-container">
					                  </div>
					                </div>
					              </div>
					            </div>
					          </div>';
					} else {
						//MESSAGED BEEN FLAGGED
						$been_removed = Thread::FlaggedMessagePlaceholder();
						$html .= $been_removed;
					}

				}
		}
		return $html;
	}

    public static function PerpareStatusForInput() {
    	$selects = [];
        $selects['1'] = 'Active';
        $selects['2'] = 'Cancel';
        return $selects;
    }

    public static function FlaggedMessagePlaceholder() {
    	$p = '<div class="thread-single thread-single-flagged" >
					<div id="message-overlay" > 
			    		<p class="bg-danger p-flagged" >&nbspThis Reply Has Been Removed</p>
			    	</div>
		   		</div>
		    ';
        return $p;
    }



    public static function CheckThreadStatus($status) {
    	$condition = true;
    	switch ($status) {
    		case 3:
    			$condition = false;
    			break;
    		case 4:
    			$condition = false;
    			break;
    		case 5:
    			$condition = false;
    			break;
    		case 6:
    			$condition = false;
    			break;
    	}
        return $condition;
    }
    

}
