@component('back.layouts.app', [
    'title' => 'Articles',
    'breadcrumbs' => html()->backToIndex('Back\ArticlesController@index'),
])

    <section>
        <div class="grid">
            <h1>
                {{ html()->onlineIndicator($model->online) }}
                {{ $model->name ?: 'New article' }}
            </h1>

            {{ html()
                ->modelForm($model, 'PATCH', action('Back\ArticlesController@update', $model->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Save article') }}

            @if($model->technical_name && view()->exists("back.articles.partials.{$model->technical_name}Form"))
                @include("back.articles.partials.{$model->technical_name}Form")
            @else
                @include('back.articles.partials.form')
            @endif

            {{ html()->formGroup()->submit('Save article') }}

            {{ html()->closeModelForm() }}
        </div>
    </section>
@endcomponent
