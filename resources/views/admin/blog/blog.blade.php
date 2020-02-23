@extends('admin.layout.default')
@section('title_area')
    Write Blog Post
@endsection
@section('main_section')
    <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}}">{{Session::get("message")}}</div>
        @endif
        <div class="container">
            <div class="row">
                    @isset($add)
                    {!! Form::open(['url' => 'blog','enctype'=>"multipart/form-data"]) !!}
                    @method("POST")
                        <div class="col-sm-12">
                            <div class="panel-group panel-group-joined" id="accordion-test">
                                <div class="panel panel-border panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                                Write Blog Post
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="category_id">Category</label><small class="req"> *</small>
                                                    <select name="category_id" required id="category_id" class="form-control selectpicker" data-container="body" data-live-search="true">
                                                        <option value="">--Select--</option>
                                                        @isset($category_list)
                                                            @foreach($category_list as $value)
                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    @error('category_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="title">Title</label><small class="req"> *</small>
                                                    <input  required name="title" type="text"  class="form-control" value="{{old("title")}}" id="title" placeholder="Title">
                                                    @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="status">Status</label><small class="req"> *</small>
                                                    <select name="status" required id="status" class="form-control selectpicker" data-container="body">
                                                        <option value="">--Select--</option>
                                                        <option value="1">Published</option>
                                                        <option value="0">Unpublished</option>
                                                    </select>
                                                    @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                 <label for="details">Details</label><small class="req"> *</small>
                                                <textarea  name="details" id="details" class="form-control" cols="30" rows="10">{{old("details")}}</textarea>
                                                @error('details')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group pull-left m-t-22">
                                                    <input type="submit" class=" btn btn-primary pull-right" value="Save" name="submit" />
                                                </div>
                                            </div>
                                        </div> <!-- panel-body -->
                                    </div>
                                </div> <!-- panel -->
                            </div>
                        </div> <!-- col -->
                        {!! Form::close() !!}
                    @endisset
                    @isset($edit)
                    {!! Form::open(['url' => 'blog','enctype'=>"multipart/form-data"]) !!}
                    @method("POST")
                        <div class="col-sm-12">
                            <div class="panel-group panel-group-joined" id="accordion-test">
                                <div class="panel panel-border panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                                Edit Blog Post
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="category_id">Category</label><small class="req"> *</small>
                                                    <select name="category_id" required id="category_id" class="form-control selectpicker" data-container="body" data-live-search="true">
                                                        <option value="">--Select--</option>
                                                        @isset($category_list)
                                                            @foreach($category_list as $value)
                                                                <option {{ $single->category_id==$value->id?"selected":""   }} value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    @error('category_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="title">Title</label><small class="req"> *</small>
                                                    <input  required name="title" type="text" value="{{$single->title}}" class="form-control"  id="title" placeholder="Title">
                                                    <input  required name="id" type="hidden" value="{{$single->id}}">
                                                    @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="status">Status</label><small class="req"> *</small>
                                                    <select name="status" required id="status" class="form-control selectpicker" data-container="body">
                                                        <option value="">--Select--</option>
                                                        <option {{ $single->status=="1"?"selected":""   }} value="1">Published</option>
                                                        <option {{ $single->status=="0"?"selected":""   }} value="0">Unpublished</option>
                                                    </select>
                                                    @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                 <label for="details">Details</label><small class="req"> *</small>
                                                <textarea  name="details" id="details" class="form-control" cols="30" rows="10">{{html_entity_decode($single->details)}}</textarea>
                                                @error('details')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group pull-left m-t-22">
                                                    <input type="submit" class=" btn btn-primary pull-right" value="Update" name="submit" />
                                                </div>
                                            </div>
                                        </div> <!-- panel-body -->
                                    </div>
                                </div> <!-- panel -->
                            </div>
                        </div> <!-- col -->
                        {!! Form::close() !!}
                    @endisset
            </div> <!-- End row -->

            <div class="row">
               <div class="col-sm-12">
                    <div class="panel-group panel-group-joined" id="accordion-test">
                        <div class="panel panel-border panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                        Blog List
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4 m-b-10 pull-left">
                                            <div class="">
                                                <div class="col-md-12 m-b-10 pull-right">
                                                    <div class="form-group">
                                                    <label for="filter_by">Filter By</label>
                                                        <select id="filter_by"  name="filter_by"  class="form-control selectpicker" >
                                                            <option value="">All</option>
                                                            <option value="1">Published</option>
                                                            <option value="0">Unpublished</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 m-b-10 pull-right  m-t-22">
                                            <div class="">
                                                <div class="col-md-12 m-b-10 pull-right">
                                                    <div class="input-group">
                                                        <input type="text" name="search_key" placeholder="Search Title" id="search_key" class="form-control">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-info" id="add_button" type="button">
                                                                <i class="md md-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <div id="blog_loading">
                                            <div class="cv-spinner">
                                                <span class="spinner"></span>
                                            </div>
                                        </div>
                                        <table id="blogs" class="table table-responsive table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Category</th>
                                                    <th>Title</th>
                                                    <th>Details</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- panel-body -->
                            </div>
                        </div> <!-- panel -->
                    </div>
                </div> <!-- col -->
            </div>
        </div> <!-- container -->
    </div>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#details').summernote({
                height:300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture','video', 'hr']]
                ]
            });
        });
    </script>

    <script !src="">
        $(document).ready(function () {
            $("#search_key").on("change",function () {
			    get_view(false);
                return false;
            });
            $("#filter_by").on("change",function () {
                get_view(false);
                return false;
            });
            $("#blogs").on("click",'.pagination li a',function () {
                var page_url=$(this).attr("href");
                if(page_url=="javascript:void(0)")
                {
                    return false;
                }
                get_view(page_url);
                return false;
            });
            get_view(false);
         function get_view(page_url)
        {
			var filter_by=$("#filter_by").val();
        	var search_key=$("#search_key").val();
        	var base_url="{{url('blog/view')}}";
        	if(page_url)
			{
				base_url=page_url;
			}
            $.ajax({
                url:base_url,
                type:"get",
                dataType:"json",
				data:{
                	"search_key":search_key,
					"filter_by":filter_by
				},
                beforeSend: function(){
                		$("#blog_loading").fadeIn(300);　
                },
                success:function(data){
                   $("#blogs tbody").html(data.html);
                	$("#blog_loading").fadeOut(300);　
                },
                error:function (e) {
                	$("#blog_loading").fadeOut(300);
				}
            });
        }
        });
    </script>
@endsection
