@if (count($errors) > 0)
    <div class="alert alert-danger">
        <div class="alert-title-danger">
            @lang('auth.errors_title')
        </div>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif