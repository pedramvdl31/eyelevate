@extends($layout)
@section('stylesheets')

@stop
@section('scripts')
<script src="assets/js/home/results.js"></script>
@stop

@section('content')
<div class="site-wrapper">
  <div class="container-fluid">
    <div  id="tread-title-container">
      <i class="glyphicon glyphicon-menu-left pull-left" id="back-arrow"><span class="back-title">Back</span></i>
    </div>

    <!-- LEFT BOX START -->
    <div class="col-md-9" id="left-box" target="false">
      <div class="container" id="left-box-inner">
        <div class="" id="preferences-frame">
            <div class="input-group " id="top-search-bar" >
              <input type="text" class="form-control" id="top-search-input" placeholder="Search for Categories">
              <span class="input-group-btn">
                <button class="btn btn-default " id="top-search-btn" type="button"><i class="glyphicon glyphicon-search">  </i></button>
              </span>
            </div><!-- /input-group -->
          </br>
            <ul class="" id="preferences">
              <li class="preferences-li"><a class="preferences-text preferences-text-first">Newest</a></li>
              <li class="preferences-li"><a class="preferences-text">Active</a></li>
              <li class="preferences-li"><a class="preferences-text">Unanswered</a></li>
              <li class="preferences-li"><a class="preferences-text">Featured</a></li>
            </ul>


        </div>

        <div id="thread-group">

          <div class="thread-single">
            <div class="media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">
                </a>
              </div>
              <div class="media-body">
                <div class="media-inner-left">
                  <h4 class="media-heading">My small business needs help</h4>
                  <div class="thread-info">Pedram kh . 
                    <span class="thread-date">1 hours ago</span>
                  </div> 
                </br>
                <div class="label-container">
                  <span class="label label-default">Business</span>
                  <span class="label label-default">Social</span>
                  <span class="label label-default">Politics</span>
                </div>
              </div>
              <div class="media-inner-right">
                <div class="right-text"><span class="reply-no"><i class="fa fa-eye-slash"></i></span></br><span class="reply-html">0</span></div>
              </div>
            </div>
          </div>
        </div>
        @for ($i = 1; $i < 5; $i++)
        <div class="thread-single">
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">
              </a>
            </div>
            <div class="media-body">
              <div class="media-inner-left">
                <h4 class="media-heading">My small business needs help</h4>
                <div class="thread-info">Pedram kh . 
                  <span class="thread-date">{{$i}} hours ago</span>
                </div> 
              </br>
              <div class="label-container">
                <span class="label label-default">Business</span>
                <span class="label label-default">Social</span>
                <span class="label label-default">Politics</span>
              </div>
            </div>
            <div class="media-inner-right">
              <div class="right-text"><span class="reply-no"><i class="fa fa-eye"></i></span></br><span class="reply-html">{{$i}}</span></div>
            </div>
          </div>
        </div>
      </div>
      @endfor



    </div>
  </div>


</div>
<!-- LEFT BOX END -->


<!-- RIGHT BOX START -->
<div class="col-md-3 " id="right-box"> 
  <div class="" id="right-box-inner">
    <div class="list-group list-group-container">
      <a href="#" class="list-group-item active " id="list-search-bar">

        <div class="input-group" >
          <input type="text" class="form-control" id="list-search-input" placeholder="Search for Categories">
          <span class="input-group-btn">
            <button class="btn btn-default " id="list-search-btn" type="button"><i class="glyphicon glyphicon-search">  </i></button>
          </span>
        </div><!-- /input-group -->

      </a>
      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item">Morbi leo risus</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item">Morbi leo risus</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item">Morbi leo risus</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item">Morbi leo risus</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item">Morbi leo risus</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item">Morbi leo risus</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
    </div>
  </div>
</div>
<!-- RIGHT BOX END -->
</div>
</div>

<style>
.site-wrapper{
  background: rgb(241, 241, 241);
}
/*LEFT AND RIGHT WRAPPERS*/
#left-box{
  /*border:1px solid red;*/
  min-height: 650px;
  padding-top: 75px;
  padding-bottom: 20px;
}
#left-box-inner{
  width: 100%;
  height: 100%;
  min-height: 650px;

  /* border:1px solid yellow;*/
  background-color:#fff;
  box-shadow: 0 1px 2px rgba(0,0,0,.1);
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  border-radius: 5px;
}
/*background: rgb(241, 241, 241);*/
#right-box{
  min-height: 650px;
  position: fixed;
  right: 0;
  padding-top: 75px;
  padding-bottom: 20px;
}
#right-box-inner{
  width: 100%;
  height: 650px;
  min-height: 650px;
  /* border:1px solid yellow;*/
  overflow: auto;
  background-color:#fff;
  box-shadow: 0 1px 2px rgba(0,0,0,.1);
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  border-radius: 5px;

}
a:hover{
  color: #61666A;
  text-decoration: none;
  cursor: pointer;
}
/*LEFT BOX component*/
#preferences-frame{
  width: 100%;
  height: 70px;
  border-bottom: 2px rgba(199, 200, 203, 0.54) solid;

}
#preferences{
  text-align: left;
  padding: 0;
  margin: 4px 0 0 0;
  font-family: inherit;
  font-size: 15px;
  font-weight: 700;
}
.preferences-text{
  color:  rgba(129, 130, 133, 1);
  margin-left: 25px;
}
.preferences-text-first {
  margin-left: 0;
}

.preferences-li{
  list-style-type: none;
  margin: 0 30px 0 0;
  display: inline-block;
}
#thread-group{
  margin: 27px 0 0 0;
  height: 100%;
}

.thread-single{
  padding-top: 20px;
  padding-bottom: 20px;
  border-bottom: 1px rgba(199, 200, 203, 0.54) solid;
}

.media-heading{
  color: #3B88BB;
  font-weight: bold;
  cursor: pointer;
}
.thread-info{
  color:rgba(111, 111, 111, 1);
  font-size: 14px;
}
.thread-replies{
  color: gray;
  font-size: 14px;
  cursor: pointer;
  color: rgb(101, 101, 101);
}
.media-inner-left{
  float: left;
}
.media-inner-right{
  float: right;
  font-size: 30px;
  font-weight: bold;
  color: rgb(150, 152, 160);
  font: xx-large;
  font-family: monospace;
  text-align: center;
  line-height: 1.0;
}
.reply-html{
  font-size: 23px;
}
.label-container{
  display: inline !important;
  font-size: 17px;
}
.thread-date{
  color:rgba(111, 111, 111, 1);
}



/*RIGHT BOX component */

#top-search-bar{
    width: 36%;
    float: right;
    top: 15px;
    display: none;
}
#top-search-input{
 border-radius:0;
 border-top-left-radius:4px;
  border-bottom-left-radius:4px;
 height: 50px;
}
#top-search-btn{
 border-radius:0;
 height: 50px;
  border-top-right-radius:4px;
   border-bottom-right-radius:4px;
}




#list-search-bar{
  padding: 0;
  border: 0;
  background-color: none;
}
#list-search-input{
 border-radius:0;
 border-top-left-radius:4px;
 height: 50px;
   border-bottom: 4px rgb(188, 188, 188) solid;
}
#list-search-btn{
 border-radius:0;
 height: 50px;
 border-bottom: 4px rgb(188, 188, 188) solid;

}

.list-group-container{
  width: 100%;

}

body,html{
  color:black;
}
.list-group-item:first-child {
  border-top-right-radius: 0px;
  border-top-left-radius: 0px;
}

#tread-title{
  margin-top: 10px;
  margin-bottom: 10px;
  font-size: 27px;
  font: 19px/29px "Gotham Rounded A", "Gotham Rounded B", "Helvetica Neue", Helvetica, Arial, sans-serif;
  color: rgb(75, 75, 75);
}
#back-arrow{
  font-size: 20px;
  padding-top: 9px;
  color: #8d9aa5;
  padding-left: 10px;
  cursor: pointer;
}
.back-title{
  font-size: 27px;
  color: #8d9aa5;
  padding-left: 3px;
}

#tread-title-container{
  position: fixed;
  right: 0;
  top: 0; 
  text-align: center;
  height: 50px;
  z-index: 100;
  margin-top: 0px;
  background-color: rgb(241, 241, 241);
  width: 100%;
  box-shadow: 0px 0px 9px #DBDBDB;
  
}
#tread-side-title{
  height: 55px;
  border-bottom: 1px solid gray;
}
#tread-side-group{
  overflow: hidden;
}


.container-fluid {
  padding-right: 0;
  padding-left: 0;
}

.dash-separator{
  color: #807676;
  margin: 0 8px;
}
.heading-date{
  font-size: 0.8em;
  color: #807676;
  letter-spacing: 0.6px;
}
.media-text {
  padding-top: 10px;
}

.thumb-up {
  cursor: pointer;
}
.thumb-down {
  cursor: pointer;
}

.flags {
  cursor: pointer;
  margin-left: 10px;
}

.thumbs-text {
  background: #FFFFFF;
  padding: 0px 3px 3px 3px;
  border: 1px solid #E6E6E6;
  border-radius: 3px;
}
.thumbs-icon{
  font-size: 16px;
}
.thumb-set{
  margin-left:5px;
  margin-right: 5px;
  vertical-align: top;
}

/*TEST*/
.tip {
  width: 0px;
  height: 0px;
  position: absolute;
  background: transparent;
  border: 10px solid #FFF;
}

.tip-left {
  top: 10px;
  left: -20px;
  border-top-color: transparent;
  border-left-color: transparent;
  border-bottom-color: transparent;
}

.dialogbox .body {
  position: relative;
  /* max-width: 300px; */
  height: auto;
  margin-left: 9px;
  background: #fff;
  padding: 15px 11px 20px 25px;
  border: 1px solid #ddd;
  border-radius: 3px;
  font-size: 16px;
  line-height: 1.6;

}
.body .message {
  font-size: 16px;
  line-height: 1.6;
  color: rgb(10, 10, 10);
}
.reply-text{
  color: #555;
  cursor: pointer;
  font-size: 11px;
  font-weight: bold;
  opacity: .75;
  /*  vertical-align: top;*/
}
.reply-text-a:hover{
  color: black;
  text-decoration: none;
}
a{
  color: #555;
}
.spam-popup{
  cursor: pointer;
  white-space: nowrap;
  list-style-type:none;
  margin-left: 5px;
  margin-right: 5px;
  background:#fff;
  color: black;
  padding:3px;
  border:none;
}
.spam-popup:hover{
  white-space: nowrap;
  list-style-type:none;
  background:rgb(28, 27, 27);
  color: white;
  border:1px gray solid;
}

.popover-content {
  padding: 9px 0px;
}
.popover{
  padding:0;

}

.message-header{
  font-size: 16px;
  line-height: 1.6;
  color: rgb(10, 10, 10);
  cursor: pointer;
  font-weight: bold;
  opacity: .75;
}
.message-header:hover{
  text-decoration: underline;
}
.message-body{

}
.reply-box{
  padding-top: 10px;
}
textarea{
  resize: vertical;
}
.reply-form{
  margin-bottom: 5px;
}
.left-btn{
  margin-right: 10px;

}

.more-wrapper{
  height: 45px;

}
.more-text{
  cursor: pointer;
}

.thumb-group{
 float: right;
}




@media (max-width: 400px) {
  .heading-date{
    display:inline-flex !important;
    font-size: 0.6em !important;
  }
  .media-inner-left{
    width: 150px;
  }
  .label-container{
    display: table-footer-group !important;
    margin-left: 0; 
  }
  .label{
    border-radius: 0;
  }
}
@media (max-width: 679px) {
  #preferences{
     margin: 65px 0 0 0;
  }
#top-search-bar {
  width: 100%;
  float: right;
    top: 18px;
}
  .label-container{
    display: table-footer-group !important;
    margin-left: 0; 
  }
  .label{
    border-radius: 0;
  }
  .preferences-li{
    height: 40px;
    display: block;
    margin: 0;
    border-bottom: 1px solid #f0f2f4;
    padding-top: 8px;
  }
  #preferences-frame{
    border-bottom: none;
      height: 231px;
  }
  .preferences-text{
    margin-left: 0;
  }
  .media-inner-left{

  }

}

@media (max-width: 850px) {

  .media-heading{
    display: block;
  }
  .heading-date{
    display: block;
    padding-top: 10px;
    padding-bottom: 10px;
    line-height: 1.6;
  }
  .flags{
    display: block;
    float:right;
  }
  .dash-separator{
    display: none;
  }
  .thumb-group{
    float: left;
  }
}

@media (max-width: 991px) {

  #top-search-bar{
    display: inline-table;
  }
   #preferences{
     margin: 65px 0 0 0;
  }
#top-search-bar {
  width: 100%;
  float: right;
    top: 18px;
}
  .label-container{
    display: table-footer-group !important;
    margin-left: 0; 
  }
  .label{
    border-radius: 0;
  }
  .preferences-li{
    height: 40px;
    display: block;
    margin: 0;
    border-bottom: 1px solid #f0f2f4;
    padding-top: 8px;
  }
  #preferences-frame{
    border-bottom: none;
      height: 231px;
  }
  .preferences-text{
    margin-left: 0;
  }
}


</style>


@stop