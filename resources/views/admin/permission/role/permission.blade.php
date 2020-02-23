@extends('admin.layout.default')
@section('title_area')
Assign Permission
@endsection
@section('main_section')
<div class="content">
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}}">{{Session::get("message")}}</div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-border panel-info">
                    <div class="panel-heading"><h3 class="panel-title">Assign Permission ({{$role_name}})</h3></div>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'assign-permission/'.$role_id]) !!}
                        @method("POST")
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Module Name</th>
                                                <th>Child Module Name</th>
                                                <th>Is View</th>
                                                <th>Is Add</th>
                                                <th>Is Edit</th>
                                                <th>Is Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($permission_list)>0)
                                                @foreach($permission_list as $key=>$value)
                                                    @if(hasPermission($value['group_code'],VIEW) && hasActive($value['group_code']))
                                                        <tr>
                                                            <th>
                                                                {{$value['group_name']}}<br />
                                                                <span class="m-l-15"><input value="{{$value['group_code']}}" class="group" type="checkbox"></span>
                                                            </th>
                                                            @if(hasPermission($value['permission'][0]->short_code,VIEW))
                                                            @if (!empty($value['permission']))
                                                                    <td>
                                                                        <input type="hidden" name="per_cat[]" value="{{$value['permission'][0]->pc_id}}" />
                                                                        <input type="hidden" name="{{"roles_permissions_id_" . $value['permission'][0]->pc_id}}" value="{{$value['permission'][0]->rp_id}}" />
                                                                        {{$value['permission'][0]->name}}
                                                                    </td>
                                                                    <td>
                                                                        @if(($value['permission'][0]->enable_view == 1) && hasPermission($value['permission'][0]->short_code,VIEW))
                                                                            <label class="">
                                                                                <input class="group_{{$value['group_code']}}" type="checkbox" name="{{"can_view-perm_" . $value['permission'][0]->pc_id}}" value="{{$value['permission'][0]->pc_id}}" {{$value['permission'][0]->can_view == 1?"checked":""}}>
                                                                            </label>
                                                                        @endif
                                                                    </td>

                                                                    <td>
                                                                        @if(($value['permission'][0]->enable_add == 1) && hasPermission($value['permission'][0]->short_code,ADD))
                                                                            <label class="">
                                                                                <input type="checkbox" class="group_{{$value['group_code']}}" name="{{"can_add-perm_" . $value['permission'][0]->pc_id}}" value="{{$value['permission'][0]->pc_id}}" {{$value['permission'][0]->can_add == 1?"checked":""}}>
                                                                            </label>
                                                                        @endif

                                                                    </td>

                                                                    <td>
                                                                        @if(($value['permission'][0]->enable_edit == 1) && hasPermission($value['permission'][0]->short_code,EDIT))
                                                                        <label class="">
                                                                            <input type="checkbox" class="group_{{$value['group_code']}}" name="{{"can_edit-perm_" . $value['permission'][0]->pc_id}}" value="{{$value['permission'][0]->pc_id}}" {{$value['permission'][0]->can_edit == 1?"checked":""}}>
                                                                        </label>
                                                                        @endif
                                                                    </td>

                                                                    <td>
                                                                        @if(($value['permission'][0]->enable_delete == 1) && hasPermission($value['permission'][0]->short_code,DELETE))
                                                                        <label class="">
                                                                            <input type="checkbox" class="group_{{$value['group_code']}}" name="{{"can_delete-perm_" . $value['permission'][0]->pc_id}}" value="{{$value['permission'][0]->pc_id}}" {{$value['permission'][0]->can_delete == 1?"checked":""}}>
                                                                        </label>
                                                                        @endif
                                                                    </td>
                                                            @else
                                                                <td colspan="5"></td>
                                                            @endif
                                                            @else
                                                                <td colspan="5"></td>
                                                            @endif
                                                        </tr>
                                                        @if(!empty($value["permission"])&& count($value["permission"]) > 1)
                                                            @unset($value["permission"][0])
                                                            @foreach($value["permission"] as $new_feature_key => $new_feature_value)
                                                                @if(hasPermission($new_feature_value->short_code,VIEW))
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>
                                                                            <input type="hidden" name="per_cat[]" value="{{$new_feature_value->pc_id}}" />
                                                                            <input type="hidden" name="{{"roles_permissions_id_" . $new_feature_value->pc_id}}" value="{{$new_feature_value->rp_id}}" />
                                                                            {{$new_feature_value->name}}
                                                                        </td>
                                                                        <td>
                                                                            @if( $new_feature_value->enable_view == 1 && hasPermission($new_feature_value->short_code,VIEW))
                                                                                <label class="">
                                                                                    <input type="checkbox" class="group_{{$value['group_code']}}" name="{{"can_view-perm_" . $new_feature_value->pc_id}}" value="{{$new_feature_value->pc_id}}" {{$new_feature_value->can_view == 1?"checked":""}}>
                                                                                </label>
                                                                            @endif
                                                                        </td>

                                                                        <td>
                                                                            @if($new_feature_value->enable_add == 1 && hasPermission($new_feature_value->short_code,ADD))
                                                                                <label class="">
                                                                                    <input type="checkbox" class="group_{{$value['group_code']}}" name="{{"can_add-perm_" . $new_feature_value->pc_id}}" value="{{$new_feature_value->pc_id}}" {{$new_feature_value->can_add== 1?"checked":""}}>
                                                                                </label>
                                                                            @endif

                                                                        </td>

                                                                        <td>
                                                                            @if($new_feature_value->enable_edit == 1 && hasPermission($new_feature_value->short_code,EDIT))
                                                                            <label class="">
                                                                                <input type="checkbox" class="group_{{$value['group_code']}}" name="{{"can_edit-perm_" . $new_feature_value->pc_id}}" value="{{$new_feature_value->pc_id}}" {{$new_feature_value->can_edit == 1?"checked":""}}>
                                                                            </label>
                                                                            @endif
                                                                        </td>

                                                                        <td>
                                                                            @if($new_feature_value->enable_delete == 1  && hasPermission($new_feature_value->short_code,DELETE))
                                                                            <label class="">
                                                                                <input type="checkbox" class="group_{{$value['group_code']}}" name="{{"can_delete-perm_" . $new_feature_value->pc_id}}" value="{{$new_feature_value->pc_id}}" {{$new_feature_value->can_delete == 1?"checked":""}}>
                                                                            </label>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                               @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                <input type="submit" class="btn-lg btn btn-primary pull-right" value="Save" name="submit" />
                                </div>
                            </form>
                    </div> <!-- panel-body -->
                </div> <!-- panel -->
            </div> <!-- col -->
        </div> <!-- End row -->

    </div> <!-- container -->

</div>
<script>
    $(".group").on("click",function(){
       var group_code=$(this).val();
        $('.group_'+group_code).not(this).prop('checked', this.checked);

    });
</script>
@endsection
