@component('back._layouts.master', [
    'title' => 'News',
])
    <section>
        <div class="grid">
            <h1>News</h1>

            <a href="{{ action('Back\NewsController@create') }}" class="button">
                New article
            </a>

            <table-component :data="{{ json_encode($models) }}">
                <table-column show="name" label="Name">
                    <template scope="row">
                        <a :href="'/back/news/edit/' + row.id">
                            @{{ row.name.nl }}
                        </a>
                    </template>
                </table-column>
                <table-column show="publish_date" label="Publish date" data-type="date:DD/MM/YYYY"></table-column>
                <table-column sortable="false" filterable="false">
                    <template scope="row">
                        {{ html()->deleteButton("/back/news/") }}
                    </template>
                </table-column>
            </table-component>
        </div>
    </section>
@endcomponent
