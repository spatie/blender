@extends('back.layout.master')

@section('pageTitle', "{$user->present()->role} {$user->name}")

@section('breadcrumbs', Breadcrumbs::render('editUserBack', $user))

@section('content')
    <section>
        <div class="grid">

            <h1>{{ $user->present()->role }} {{ $user->email }}</h1>

            @if($user->status == App\Models\Enums\UserStatus::WAITING_FOR_APPROVAL)
                {!! HTML::info('Deze gebruiker is nog niet geactiveerd. <a id="activate_user_'.$user->id.'" href="' . action('Back\UserController@activate', [$user->id]) .'">Activeer</a>' ) !!}
            @endif

            {!! Form::model($user, ['method'=>'PATCH', 'action' => ['Back\UserController@update', $user->id] , 'class' =>'-stacked']) !!}
                 @include("back.user.{$user->role}._partials.form")
            {!! Form::close() !!}
        </div>
    </section>
@endsection
