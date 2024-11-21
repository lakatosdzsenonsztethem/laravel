@extends('layout')
@section('content')

@error('name')
<div class="alert alert-warning">{{ $message }}</div>
@enderror

<form action="{{ route('aitools.update' , $aitool->id) }}" method="post">
    @csrf 
    @method('PUT')
    <fieldset>
        <label for="name">aitool név</label>
        <input type="text" name="name" id="name" value="{{ old('name' , $aitool->name) }}">
    </fieldset>
    <fieldset>
        <label for="category_id">Kategória</label>
        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{$aitool->category_id == $category->id ? 'selected': ''}}>{{$category->name }}</option>
                @endforeach
        </select>
    </fieldset>
    <fieldset>
    <label for="description">Leírás</label>
    <textarea name="description" id="description">{{$aitool->description}}</textarea>
    </fieldset>
    <fieldset>
    <label for="link">Link</label>
    <input type="text" name="link" id="link" value="{{ old('link' , $aitool->link) }}">
    </fieldset>
    <fieldset>
    <label for="hasFreePlan">Van ingyenes változat?</label>
    <input type="checkbox" name="hasFreePlan" id="hasFreePlan" {{$aitool->hasFreePlan ? 'checked': ''}}>
    </fieldset>
    <fieldset>
    <label for="price">Ár (havonta Ft-ban)</label>
    <input type="number" name="price" id="price" value="{{ old('price' , $aitool->price) }}">
    </fieldset>
    <button type="submit">Ment</button>
</form>
@endsection