@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop

@section('content')
<div class="panel panel-default" style="font-size:18px">
  <div class="panel-heading" style="font-weight:900">Type: {{$comment_output['type']}} &nbsp
      <a href="{!! route('thread_view',$comment['id']) !!}"> 
      <i class="glyphicon glyphicon-share"></i>
    </a>
  </div>
  <div class="panel-body">
@if($comment_output['type'] == "thread")

  <div class="form-group">
    <label >Thread Id</label>
  </br>
    <p style="font-size:16px !important;color:black">{{$comment['id']}}</p>
  </div>


  <div class="form-group">
    <label >Username</label>
  </br>
    <p style="font-size:16px !important;color:black">{{$comment['user_id']}}</p>
  </div>


  <div class="form-group">
    <label >Title</label>
  </br>
    <p style="font-size:16px !important;color:black">{{$comment['title']}}</p>
  </div>


  <div class="form-group">
    <label >Description</label>
  </br>
    <p style="font-size:16px !important;color:black">{{$comment['description']}}</p>
  </div>


  <div class="form-group">
    <label >Status</label>
  </br>
    <p style="font-size:16px !important;color:black">{{$comment['status']}}</p>
  </div>


  <div class="form-group">
    <label >Date</label>
  </br>
    <p style="font-size:16px !important;color:black">{{$comment['date']}}</p>
  </div>
@else
  <div class="form-group">
    <label >Reply Id</label>
  </br>
    <p style="font-size:16px !important;color:black">{{$comment['id']}}</p>
  </div>

  <div class="form-group">
    <label >Username</label>
  </br>
    <p style="font-size:16px !important;color:black">{{$comment['user_id']}}</p>
  </div>

  <div class="form-group">
    <label >Reply</label>
  </br>
    <p style="font-size:16px !important;color:black">{{$comment['reply']}}</p>
  </div>

  <div class="form-group">
    <label >Status</label>
  </br>
    <p style="font-size:16px !important;color:black">{{$comment['status']}}</p>
  </div>

  <div class="form-group">
    <label >Date</label>
  </br>
    <p style="font-size:16px !important;color:black">{{$comment['date']}}</p>
  </div>
@endif
    
  </div>
</div>

<div class="panel panel-default" style="font-size:18px">
    <div class="panel-heading" style="font-weight:900">All Flags (<span style="color:#d9534f">{{$all_flags_count}} flags</span>)</div>
  <div class="panel-body">
<table class="table table-bordered" >
      <thead>
        <tr>
          <th>#</th>
          <th>Thread Id</th>
          <th>Reply Id</th>
          <th>Flagger-User User-Id</th>
          <th>Flagged-User User-Id</th>
          <th>Status</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($all_flags as $flags)
        <tr>
          <th scope="row">{{$flags['id']}}</th>
          <td>{{$flags['thread_id']}}</td>
          <td>{{$flags['reply_id']}}</td>
          <td>{{$flags['flagger_user_id']}}</td>
          <td>{{$flags['flagged_user_id']}}</td>
          <td>{{$flags['status']}}</td>
          <td>{{$flags['date']}}</td>
          <td>edit</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
{!! Form::open(array('action' => 'FlagsController@postView', 'class'=>'','permission'=>"form")) !!}

@if($comment_output['type'] == "thread")
  <input type="hidden" name="thread_id" value="{{$comment['id']}}">
  <input type="hidden" name="reply_id" value="0">
@else 
  <input type="hidden" name="reply_id" value="{{$comment['id']}}">
  <input type="hidden" name="thread_id" value="{{$comment['thread_id']}}">
@endif

<div class="panel panel-default" style="font-size:18px">
  <div class="panel-heading" style="font-weight:900"> Action
  </div>
  <div class="panel-body">

    <div class="form-group">
      <label for="exampleInputEmail1">Action</label>
    </br>
  <select name="action" class="form-control">
    <option>Select Action</option>
    <option value="2">Approve</option>
    <option value="5">Final Approve</option>
    <option value="3">Reject</option>
    <option value="6">Final Reject</option>
    <option value="7">Banned</option>
  </select>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Reason</label>
      </br>
      <textarea name="reason" class="form-control" rows="3"></textarea> 
    </div>
  </div>
        <div class="panel-footer clearfix">
          <button class="btn btn-primary pull-right" type="submit"> Save </button>
      </div>
</div>
{!! Form::close() !!}
@stop