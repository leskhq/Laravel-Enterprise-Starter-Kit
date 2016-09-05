<div>
    <h1 style="3D&quot;font-size:12.8px&quot;">Whoops, looks like something went wrong.</h1>
    <b>URL:</b>&nbsp;{{$url}}<br>
    <b>Method:</b>&nbsp;{{$method}}<br>
    <b>User ID:</b>&nbsp;{{$user_id}}<br>
    <b>User name:</b>&nbsp;{{$user_name}}<br>
    <b>User first name:</b>&nbsp;{{$user_first_name}}<br>
    <b>User last name:</b>&nbsp;{{$user_last_name}}<br>
    <b>Exception type:</b>&nbsp;{{$exception_class}}<br>
    <b>Exception message:</b>&nbsp;{{$exception_message}}<br>
    <b>In file:<br/></b>&nbsp;{{$exception_file}}<br>
    <b>On line:</b>&nbsp;{{$exception_line}}<br>
    <b>Input:</b>&nbsp;<br>
    <code>{{($input)?$input:'None'}}</code>
    <div>
        <b>Stack trace:</b><br>
        <div style="3D&quot;font-size:12.8px=">
            <ol>
                @foreach($exception_trace_formatted as $trace)
                    <li style="3D&quot;margin-left:15px&quot;">{!!$trace!!}</li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
