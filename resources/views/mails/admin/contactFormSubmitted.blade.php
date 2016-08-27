@extends('mails._layouts.master')

@section('content')

    <h1>Contactformulier</h1>

    <p>
        Naam: {{ $formResponse->name }}<br />
        Telefoon: {{ $formResponse->telephone }}<br />
        Email: {{ $formResponse->email }}<br />
        Adres: {{ $formResponse->address }}<br />
        Postcode: {{ $formResponse->postal }}<br />
        Stad: {{ $formResponse->city }}<br />
        Opmerkingen: {{ $formResponse->remarks }}<br />
    </p>

@endsection
