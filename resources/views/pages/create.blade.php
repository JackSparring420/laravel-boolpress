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

            <label for="title">title:</label>
            <input type="text" name="title" placeholder="title"> <br>

            <label for="author">author:</label>
            <input type="text" name="author" placeholder="author"> <br>

            <label for="description">description:</label>
            <input type="textarea" name="description" placeholder="description"> <br>

            <label for="release_date">release_date:</label>
            <input type="date" name="release_date"> <br>

            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category -> id}}">{{ $category -> name}}</option>
                @endforeach
            </select> <br>
            

            <input type="submit" value="CREATE">
    </form>
@endsection