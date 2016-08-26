<span class="span.fa.fa-power-off">
    <form id="logout-form" action="{{ logout_url() }}" method="POST">
        {{ Form::submit('logout', ['class' => 'menu_circle -log-out']) }}
        {{ csrf_field() }}
    </form>
</span>
