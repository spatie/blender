<form id="logout-form" action="{{ route('logout') }}" method="POST">
    <button class="button--danger" type=submit title="log out">
        Log out
    </button>
    {{ csrf_field() }}
</form>
