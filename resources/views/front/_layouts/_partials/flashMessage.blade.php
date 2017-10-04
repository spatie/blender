@if(request()->hasSession() && html()->flashMessage())
    {{ html()->flashMessage() }}
@endif
