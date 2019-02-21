@if (count($errors) > 0)
    <div class="alert alert-danger">
        请更正以下错误：
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif