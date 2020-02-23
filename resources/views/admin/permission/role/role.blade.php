@extends('admin.layout.default')
@section('title_area')
Role Permission
@endsection
@section('main_section')
<div class="content">
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}}">{{Session::get("message")}}</div>
        @endif
        <div class="row">
            @if(hasPermission("role_permission",ADD))
                @isset($add)
                        <div class="col-sm-6">
                            <div class="panel panel-border panel-info">
                                <div class="panel-heading"><h3 class="panel-title">Role Add</h3></div>
                                <div class="panel-body">
                                     {!! Form::open(['url' => 'role']) !!}
                                        @method("POST")
                                        <div class="form-group">
                                            <label for="name">Role Name</label><small class="req"> *</small>
                                            <input required name="name" type="text" class="form-control" id="name" placeholder="Enter role name">
                                            @error('name')
                                            <p class="req">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                        <input type="submit" class="btn-lg btn btn-primary pull-right" value="Save" name="submit" />
                                        </div>
                                    {!! Form::close() !!}
                                </div> <!-- panel-body -->
                            </div> <!-- panel -->
                        </div> <!-- col -->
                    @endisset
                @endif
            @if(hasPermission("role_permission",EDIT))
                @isset($edit)
                    <div class="col-sm-6">
                        <div class="panel panel-border panel-info">
                            <div class="panel-heading"><h3 class="panel-title">Role Edit</h3></div>
                            <div class="panel-body">
                                     {!! Form::open(['url' => 'role']) !!}
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="name">Name</label><small class="req"> *</small>
                                        <input type="hidden" value="{{$single->id}}" name="id" />
                                        <input required name="name" value="{{$single->name}}" type="text" class="form-control" id="name" placeholder="Enter role name">
                                    </div>
                                    <div class="form-group">
                                    <input type="submit" class="btn-lg btn btn-primary pull-right" value="Update" name="submit" />
                                    </div>
                                </form>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col -->
                  @endisset
            @endif
            <div class="col-sm-6">
                <div class="panel panel-border panel-info">
                    <div class="panel-heading"><h3 class="panel-title">Role View</h3></div>
                    <div class="panel-body">
                        <div class="table">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($role)>0)
                                    @foreach ($role as $key => $value)
                                        @if(logged_in_role_name()=="Super Admin")
                                            <tr>
                                                <td>{{ ++$key}}</td>
                                                <td>{{$value->name}}</td>
                                                <td>{{$value->type}}</td>
                                                <td class="actions btn-group-xs text-right">
                                                    @if(hasPermission("assign_permission",VIEW))
                                                        @if($value->name!="Super Admin")
                                                            <a data-toggle="tooltip" data-placement="top" title="Assign Permission!" href="{{url("assign-permission/".$value->id)}}" class="  btn-xs  waves-effect"><i class="fa fa-tag"></i></a>
                                                        @endif
                                                    @endif
                                                    @if($value->type!="system")
                                                        @if(hasPermission("role_permission",EDIT))
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit" href="{{url("role/edit/".$value->id)}}" class="  btn-xs  waves-effect"><i class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if(hasPermission("role_permission",DELETE))
                                                            @if($value->type!="system")
                                                                <a data-toggle="tooltip" data-placement="top" title="Delete" href="{{url("role/delete/".$value->id)}}" onclick="return confirm('Are you sure you want to delete this user?');" class="text-danger  btn-xs  waves-effect"><i class="fa fa-trash"></i></a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @else
                                           @if($value->name!="Super Admin")
                                            @if($value->name!=logged_in_role_name())
                                                    @if($value->name!="Admin")
                                                    <tr>
                                                        <td>{{++$key}}</td>
                                                        <td>{{$value->name}}</td>
                                                        <td>{{$value->type}}</td>
                                                        <td class="actions btn-group-xs text-right">
                                                            @if(hasPermission("assign_permission",VIEW))
                                                                    <a data-toggle="tooltip" data-placement="top" title="Assign Permission!" href="{{url("role/permission/".$value->id)}}" class=" btn btn-default  waves-effect"><i class="fa fa-tag"></i></a>
                                                            @endif
                                                            @if($value->type!="system")
                                                                @if(hasPermission("role_permission",EDIT))
                                                                <a data-toggle="tooltip" data-placement="top" title="Edit" href="{{url("role/edit/".$value->id)}}" class=" btn btn-default  waves-effect"><i class="fa fa-edit"></i></a>
                                                                @endif
                                                                @if(hasPermission("role_permission",DELETE))
                                                                    @if($value->type!="system")
                                                                        <a data-toggle="tooltip" data-placement="top" title="Delete" href="{{url("role/delete/".$value->id)}}" onclick="return confirm('Are you sure you want to delete this user?');" class="text-danger btn btn-default  waves-effect"><i class="fa fa-trash"></i></a>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center"><h3 class="text-center">No role Found</h3></td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- panel-body -->
                </div> <!-- panel -->
            </div> <!-- col -->
        </div> <!-- End row -->

    </div> <!-- container -->

</div>
<script type="text/javascript">
	$(function () {
        $('[data-toggle="tooltip"]').tooltip();
	});
</script>

@endsection
