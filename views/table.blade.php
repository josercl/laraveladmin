<table border=1>
    <thead>
        <tr>
        @foreach(Admin::fields() as $field)
            <th>{{$field['header']}}</th>
        @endforeach
            <th colspan="{{count(Admin::operations())}}">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach(Admin::list() as $record)
        <tr>
            @foreach(Admin::fields() as $field)
            <td>
                <?php $field_name=$field['name']?>
                {{$record->$field_name}}
            </td>
            @endforeach

            @foreach(Admin::operations() as $name=>$op)
            <td>
                {!!Admin::showOperation($record,$op)!!}
            </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>

<script>
$(document).ready(function(){

$("[data-method='delete']").click(function(e){
    e.preventDefault();

    $.ajax(
        $(this).attr("href"),
        {
            method: "DELETE",
            data:{
                '_token': '{{csrf_token()}}' 
            },
            success: function(data,textStatus){
                
            }
        }
    );
});

});

</script>