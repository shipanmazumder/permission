@isset($blogs)
    @foreach($blogs as $key=>$value)
        <tr>
            <td>{{$sl_counter++}}</td>
            <td>{{$value->category->name}}</td>
            <td>{{$value->title}}</td>
            <td>{{textshorten(strip_tags(html_entity_decode($value->details)),300)}}</td>
            <td>
                <a title="Edit" href="{{url("blog-edit/".$value['id'])}}" class=" btn btn-default btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View"><i class="fa fa-edit"></i></a>
                <a onclick="return confirm('Are You Sure?')" href="{{url("blog-control/".$value['id'])}}" title="{{$value['status']==1?"Enable":"Disable"}}" class="text-{{$value['status']==1?"info":"danger"}} btn btn-default  btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-check-circle"></i></a>
            </td>
        </tr>
    @endforeach
     <tr>
        <td colspan="5" class="text-center">{{$blogs->links()}}</td>
    </tr>
@endisset
