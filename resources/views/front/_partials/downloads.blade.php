@if($item->hasMedia('downloads'))
    <section>
        <h2>{{ $title ?? __('downloads') }}</h2>
        @foreach($item->getMedia('downloads') as $download)
            <a href="{{ $download->getUrl() }}">
                @if($download->type === $download::TYPE_OTHER)
                    Placeholder
                @else
                    <img src="{{ $download->getUrl('thumb') }}" alt="{{ $download->name }}" style="width: 100px;">
                @endif
            </a>
            <strong>{{ $download->name }}.{{ $download->extension }}</strong>
            {{ $download->humanReadableSize }}
        @endforeach
    </section>
@endif


