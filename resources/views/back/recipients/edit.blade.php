@component('back.layouts.app', [
    'title' => 'Recipients',
    'breadcrumbs' => html()->backToIndex('Back\RecipientsController@index'),
])
    <section>
        <div class="grid">
            <h1>
                {{ $model->name ?: 'New recipient' }}
            </h1>

            {{ html()
                ->modelForm($model, 'PATCH', action('Back\RecipientsController@update', $model->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Save recipient') }}

            @include('back.recipients.partials.form')

            {{ html()->formGroup()->submit('Save recipient') }}

            {{ html()->closeModelForm() }}
        </div>
    </section>
@endcomponent
