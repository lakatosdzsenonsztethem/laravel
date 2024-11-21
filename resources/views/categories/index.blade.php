@extends('layout')
@section('content')
<h1>Category index</h1>

@if(session('success'))
<div class="alert alert-succes">
    {{session('success')}}
</div>
@endif

<ul>
    @foreach($categories as $category)
    <li class="actions">
        {{ $category->name }}
        <a class="button" href="{{route('categories.show', $category->id)}}">Megjelenítés</a>
        <a class="button" href="{{route('categories.edit', $category->id)}}">Szerkesztés</a>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="danger" onclick="return confirm('Tutire töröljük?')" type="submit"> Törlés</button>
        </form>
    </li>
    @endforeach
</ul>
@endsection