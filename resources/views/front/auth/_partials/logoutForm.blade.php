<form id="logout-form" action="{{ logout_url() }}" method="POST">
    <button class="" type=submit title="log out">
        log out
    </button>
    {{ csrf_field() }}
</form>
