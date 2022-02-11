
@foreach ($logs as $item)
<table>
<tr><th>TIME</th><td>{{$item->created_at}}</td></tr>
<tr><th>REQUEST</th><td><pre>{{$item->request}}</pre></td></tr>
<tr><th>RESPONSE</th><td><pre>{{$item->response}}</pre></td><tr>
</table>
<hr/>
@endforeach

<script>

    setInterval(function(){
        window.location.reload();
    },10000)
</script>
