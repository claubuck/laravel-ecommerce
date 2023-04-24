@extends('layouts.layout')



@section('content')

<form action="{{route('categories.update',$category)}}" method="POST">
    @csrf @method('PUT')
  <div class="mb-3 mt-3">
    <label for="name">Nombre</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{old('name',$category->name)}}">
  </div>
  <div class="mb-3 mt-3">
    <label for="description">Descripcion</label>
    <textarea rows="3" class="form-control" id="description" name="description">{{old('body',$category->description)}}</textarea>
  </div>
  <a href="{{route('categories.index')}}" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
  <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  
</form>

@endsection