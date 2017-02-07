@component('back._layouts.master', [
    'pageTitle' => fragment('back.auth.titleResetPassword')
])



    <section class="v-auth">
        {{-- @include('auth._partials.lang') --}}

        @include('back._layouts._partials.flashMessage', ['extraClass' => 'alerts--fixed'])

        <div class="v-auth__card">
            {!! Form::open(['class'=>'-stacked v-auth__form', 'action' => 'Back\Auth\ForgotPasswordController@sendResetLinkEmail']) !!}
            <h1 class="v-auth__title -small">{{ fragment('back.auth.resetPassword.title') }}</h1>
            @if(session('status'))
                <p class="alert--info">
                    {{ session('status') }}
                </p>
            @else
                <p class="alert--info">
                    {{ fragment('back.auth.resetPassword.intro') }}
                </p>
            @endif
            <div class="form__group">
                {!! Form::label('email', fragment('back.auth.email')) !!}
                {!! Form::email('email', null, ['autofocus' => true]) !!}
                {!! Html::error($errors->first('email')) !!}
            </div>

            <div class="form__group -buttons">
                {!! Form::button( fragment('back.auth.resetPassword.button'), ['type'=>'submit', 'class'=>'button -default']) !!}
            </div>
            <div class="form__group__help">
                <a href="{{ login_url()  }}">{{ fragment('back.auth.toLogin') }}</a>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
@endcomponent
