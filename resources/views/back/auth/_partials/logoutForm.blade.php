<form id="logout-form" action="{{ logout_url() }}" method="POST">
    <button type=submit title="log out" class="menu__log-out">
        <span class="fa fa-power-off"></span>
    </button>
    {{ csrf_field() }}
</form>
