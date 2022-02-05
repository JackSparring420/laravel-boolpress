@extends('layouts.main-layout')
@section('content')

    <h3 >
        <a class="text-secondary" href="{{ route('create')}}"> CREATE NEW</a>
    </h3>

    <h1>Lista macchine</h1>
    <ul>
        @foreach ($cars as $car)
            <li>
                {{-- <a href="{{ route('show', $car -> id)}}"> --}}
                    {{ $car -> name }} - {{ $car -> manifacture }} - {{ $car -> displacement }}
                {{-- </a> |  --}}
                {{-- <a href="{{ route('edit', $car -> id)}}">EDIT</a> |  --}}
                {{-- <a href="{{ route('delete', $car -> id)}}">DELETE</a> --}}
            </li>
        @endforeach
    </ul>
    <a class="btn btn-secondary" href="{{ route('logout') }}">LOGOUT</a>
@endsection