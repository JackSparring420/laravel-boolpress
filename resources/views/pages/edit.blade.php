@extends('layouts.main-layout')
@section('content')

    <h1>Modifica</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('post.update', $post -> id )}}" method="POST">

            @method('POST')
            @csrf
    
            <label for="title">title:</label>
            <input type="text" name="title" value="{{$post -> title}}"> <br>

            <label for="author">author:</label>
            <input type="textarea" name="author" value="{{$post -> author}}"> <br>


            <label for="description">description:</label>
            <input type="textarea" name="description" placeholder="{{$post -> description}}" rows="10"> <br>


            <label for="release_date">release_date:</label>
            <input type="date" name="release_date" value="{{$post -> release_date}}"> <br>

            <select name="category_id">
                @foreach ($categories as $category)
                    
                    <option value="{{ $category -> id}}"ù
                        @if ($category -> id == $post -> category -> id )
                        selected
                        @endif
                        >{{ $category -> name}}</option>
                @endforeach
            </select> <br>
            <span>Tags:</span>
            <select name="tags">
                @foreach ($tags as $tag)
                    <input type="checkbox" name="tags[]" value="{{ $tag -> id }}"
                    @foreach ($post -> tags as $postTag)

                        @if ($tag -> id == $postTag -> id)
                        checked
                    @endif
                        
                    @endforeach
                    > {{$tag -> name}}
                @endforeach
            </select> <br>

            

            <input type="submit" value="EDIT">
        </form>
    </form>
@endsection