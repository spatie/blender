@component('back._layouts.master', [
    'pageTitle' => fragment('back.news.title'),
    'breadcrumbs' => '', /*Html::backToIndex('Back\NewsController@index'),*/
])

    <section>
        <div class="grid">
            <h1>{{-- Html::onlineIndicator($model->online) !!}{{ $model->name ?: fragment('back.news.new') --}}</h1>

            @include('back.news._partials.form')
        </div>
    </section>

@endcomponent
