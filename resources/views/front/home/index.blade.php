@extends('front._layouts.main')

@section('title', $article->seo('title'))
@section('seo', $article->renderSeoTags())

@section('mainTitle')
    <h1>{{ $article->name }}</h1>
@endsection

@section('mainImages')

    <div class="srcset"
         style="padding-bottom:100%; background-image: url('data:image/jpg;base64,<?php echo base64_encode(file_get_contents(public_path() . "/images/srcset/01/32.jpg")) ?>')">
        <noscript>
            <img src="/images/srcset/01/2048.jpg">
        </noscript>
        <img class="js-srcset"
             srcset="/images/srcset/01/2048.jpg 2048w,
                    /images/srcset/01/1024.jpg 1024w,
                    /images/srcset/01/512.jpg 512w,
                    /images/srcset/01/256.jpg 256w,
                    /images/srcset/01/128.jpg 128w,
                   data:image/jpg;base64,<?php echo base64_encode(file_get_contents(public_path() . "/images/srcset/01/32.jpg")) ?> 32w"
             sizes="1px"
             src="/images/srcset/01/2048.jpg">
    </div>


    @if($cover = $article->getFirstMedia('images'))
        <img src="{{ $cover->getUrl('thumb') }}" alt="{{ $cover->name }}">
    @endif
@endsection

@section('mainContent')
    {!! $article->text !!}
@endsection
