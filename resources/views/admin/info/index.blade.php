@extends('admin.layout.default')
@section('title_area')
    Header Info
@endsection
@section('main_section')
    <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}}">{{Session::get("message")}}</div>
        @endif
        <div class="container">
            <div class="row">
                    @isset($add)
                    {!! Form::open(['url' => 'info']) !!}
                    @method("POST")
                        <div class="col-sm-12">
                            <div class="panel-group panel-group-joined" id="accordion-test">
                                <div class="panel panel-border panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                                info
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="title">Title</label><small class="req">*</small>
                                                    <input required   name="title" placeholder="Title" type="text" value="@isset($single){{  $single->title }} @endisset" class="form-control" id="title">
                                                    <input   name="id" type="hidden"  value="@isset($single){{  $single->id }} @endisset">
                                                    @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="sub_title">Sub Title</label><small class="req">*</small>
                                                    <input required   name="sub_title" type="text" value="@isset($single){{  $single->sub_title }} @endisset"  placeholder="Sub Title" class="form-control" id="sub_title">
                                                    @error('sub_title')
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
            </div> <!-- End row -->
        </div> <!-- container -->
    </div>
@endsection
