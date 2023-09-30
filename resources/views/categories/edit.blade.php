@extends('layouts.layout')



@section('content')
    <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3 mt-3">
            <label for="name">Nombre</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                placeholder="Nombre" value="{{ old('name', $category->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 mt-3">
            <label for="description">Descripción</label>
            <textarea rows="3" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" placeholder="Descripción">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 mt-3">
            <label for="image">Imagen</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <a href="{{ route('categories.index') }}" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>

    </form>
@endsection
