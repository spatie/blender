@extends('emails.layout.master')

@section('content')

    <h1>Contactformulier</h1>

    <p>
        Naam: {{ $name }}<br />
        Telefoon: {{ $telephone }}<br />
        Email: {{ $email }}<br />
        Adres: {{ $address }}<br />
        Postcode: {{ $postal }}<br />
        Stad: {{ $city }}<br />
        Opmerkingen: {{ $remarks }}<br />
    </p>

@endsection
