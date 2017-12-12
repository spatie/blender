<form id="logout-form" action="{{ route('logout') }}" method="POST">
    <button class="button is-danger" type="submit" title="log out">
        Log out
    </button>
    {{ csrf_field() }}
</form>
