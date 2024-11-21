@extends('layout')
@section('content')
<h1>AI eszközök
    <a href="{{route('aitools.create')}}" title="Új AI eszköz">🧞</a>
</h1>
@if(session('success'))
<div class="alert alert-succes">
    {{ session('success') }}
</div>
@endif
<ul>
    @foreach($aitools as $aitool)
    <li class="actions">
        {{ $aitool->name }}
        <a class="button" href="{{route('aitools.show', $aitool->id)}}">Megjelenítés</a>
        <a class="button" href="{{route('aitools.edit', $aitool->id)}}">Szerkesztés</a>
        <form action="{{ route('aitools.destroy', $aitool->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="danger" onclick="return confirm('Tutire töröljük?')" type="submit">Törlés</button>
        </form>
    </li>
    @endforeach
</ul>
@endsection