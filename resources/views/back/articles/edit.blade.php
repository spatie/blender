@component('back._layouts.master', [
    'pageTitle' => __('Artikels'),
    'breadcrumbs' => html()->backToIndex('Back\ArticlesController@index'),
])

    <section>
        <div class="grid">
            <h1>
                {{ html()->onlineIndicator($model->online) }}
                {{ $model->name ?: __('Nieuw artikel') }}
            </h1>

            {{ html()
                ->modelForm($model, 'PATCH', action('Back\ArticlesController@update', $model->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Bewaar artikel') }}

            @if($model->technical_name && view()->exists("back.articles._partials.{$model->technical_name}Form"))
                @include("back.articles._partials.{$model->technical_name}Form")
            @else
                @include('back.articles._partials.form')
            @endif

            {{ html()->formGroup()->submit('Bewaar artikel') }}

            {{ html()->endModelForm() }}
        </div>
    </section>
@endcomponent
