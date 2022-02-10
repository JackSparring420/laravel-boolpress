@extends('layouts.main-layout')
@section('content')

    <h3 >
        <a class="text-secondary" href="{{ route('create')}}"> CREATE NEW POST</a>
    </h3>

    <h1>Posts</h1>
    <ul>
        @foreach ($posts as $post)
            <li>

                {{ $post -> title }} - {{ $post -> author }} - {{ $post -> description }} - {{ $post -> release_date}} <br>
                categoria: {{$post -> category -> name}} 
                @foreach ($post -> tags as $tag)
                tag: {{ $tag -> name}}                    
                @endforeach
                | 
                <a class="btn btn-secondary" href="{{ route('post.edit', $post -> id)}}">EDIT</a> | 
                <a class="btn btn-danger"  href="{{ route('post.delete', $post -> id)}}">DELETE</a>


                <br>
            
            </li>
        @endforeach
    </ul>
    <a class="btn btn-secondary" href="{{ route('logout') }}">LOGOUT</a>
@endsection