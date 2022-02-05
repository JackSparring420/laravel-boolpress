@extends('layouts.main-layout')
@section('content')

    <h1>Inserisci nuova auto</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('store')}}" method="POST">

        @method('post')
        @csrf

            <label for="name">Nome:</label>
            <input type="text" name="name" placeholder="Nome"> <br>

            <label for="manifacture">Produttore:</label>
            <input type="text" name="manifacture" placeholder="Porduttore"> <br>

            <label for="displacement">displacement:</label>
            <input type="text" name="displacement" placeholder="displacement"> <br>


            <input type="submit" value="CREATE">
    </form>
@endsection