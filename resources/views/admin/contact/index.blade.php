@extends('admin.layout.default')
@section('title_area')
    Contact Info
@endsection
@section('main_section')
    <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}}">{{Session::get("message")}}</div>
        @endif
        <div class="container">
            <div class="row">
                    @isset($add)
                    {!! Form::open(['url' => 'contact']) !!}
                    @method("POST")
                        <div class="col-sm-12">
                            <div class="panel-group panel-group-joined" id="accordion-test">
                                <div class="panel panel-border panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                                contact
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="address">Address</label><small class="req">*</small>
                                                    <input required   name="address" placeholder="Address" type="text" value="@isset($single){{  $single->address }} @endisset" class="form-control" id="address">
                                                    <input   name="id" type="hidden"  value="@isset($single){{  $single->id }} @endisset">
                                                    @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label><small class="req">*</small>
                                                    <input required   name="email" type="email" value="@isset($single){{  $single->email }} @endisset"  placeholder="Email" class="form-control" id="email">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="phone">Phone</label><small class="req">*</small>
                                                    <input required  name="phone" type="text" value="@isset($single){{  $single->phone }} @endisset"  placeholder="Phone" class="form-control" id="phone">
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="facebook">Facebook</label>
                                                    <input   name="facebook" type="text" value="@isset($single){{  $single->facebook }} @endisset"  placeholder="Facebook" class="form-control" id="facebook">
                                                    @error('facebook')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="twitter">Twitter</label>
                                                    <input   name="twitter" type="text" value="@isset($single){{  $single->twitter }} @endisset"  placeholder="Twitter" class="form-control" id="twitter">
                                                    @error('twitter')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="youtube">Youtube</label>
                                                    <input   name="youtube" type="text" value="@isset($single){{  $single->youtube }} @endisset"  placeholder="Youtube" class="form-control" id="youtube">
                                                    @error('youtube')
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
