@extends('admin.layout.default')
@section("title_area")
    Profile Change
@endsection
@section("main_section")
     <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}}">{{Session::get("message")}}</div>
        @endif
        <div class="container">
            <div class="row">
                    {!! Form::open(['url' => 'password-change',"method"=>"post"]) !!}
                    <div class="col-sm-12">
                        <div class="panel-group panel-group-joined" id="accordion-test">
                            <div class="panel panel-border panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                            Profile Change
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="email">Email</label><small class="req">*</small>
                                                <input   name="email" type="email" value="{{ Auth::user()->email  }}" class="form-control" id="email">
                                                <input   name="id" type="hidden" value="@isset($single){{  $single->id }} @endisset">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="oldPass">Old Password</label><small class="req">*</small>
                                                <input   name="oldPass" type="password"  class="form-control" id="oldPass">
                                                @error('oldPass')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="password">New Password</label><small class="req">*</small>
                                                <input   name="password" type="password"  class="form-control" id="password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group pull-left m-t-22">
                                                <input type="submit" class=" btn btn-primary pull-right" value="Change" name="submit" />
                                            </div>
                                        </div>
                                    </div> <!-- panel-body -->
                                </div>
                            </div> <!-- panel -->
                        </div>
                    </div> <!-- col -->
                    {!! Form::close() !!}
            </div> <!-- End row -->
        </div> <!-- container -->
    </div>
@endsection