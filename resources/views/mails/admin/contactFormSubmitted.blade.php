@component('mail::message')
# Nieuwe reactie

Hello,

A visitor submitted a new response on [{{ Request::getHost() }}]({{ url('/') }}).

@component('mail::panel')
Name: {{ $formResponse->name }} <br>
Telephone: {{ $formResponse->telephone }} <br>
E-mail: {{ $formResponse->email }} <br>
Address: {{ $formResponse->address }} <br>
Postal: {{ $formResponse->postal }} <br>
City: {{ $formResponse->city }} <br>
Remarks: {{ $formResponse->remarks }} <br>
Referer: {{ $formResponse->referer ?? 'Onbekend' }} <br>
@endcomponent

@slot('subcopy')
Download all previous responses on [{{ config('app.url') }}]({{ action('Back\FormResponsesController@showDownloadButton') }}).
@endslot
@endcomponent


