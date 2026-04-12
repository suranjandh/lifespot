<div class="msg-container">
    @if($errors->all())
        <div class="alert alert-danger page-msg">
            <span>We Have Following Errors . Please Check And Retry</span>
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ucwords($e)}}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
