@extends('app')

@section('content')
    <ul>
       <li>Nombre total de tickets : {{ $issues_num }}</li>
       <li>Nombre total de tickets ouverts : {{ $open_issues_num }}</li>
    </ul>
@endsection
