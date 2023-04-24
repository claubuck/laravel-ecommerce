@extends('layouts.layout')

@section('heading_page')

                        <h1 class="h3 mb-0 text-gray-800">Categorias</h1>
                        {{-- <a href="{{route('categories.create')}}"  data-bs-toggle="modal" data-bs-target="#myModal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa-solid fa-plus"></i> Nueva Categoria</a>
                         --}}
                         <a href=""  data-bs-toggle="modal" data-bs-target="#crear" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Nueva Categoria</a>
                        
    
@endsection


@section('content')

<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                            
                                        </tr>
                                    </thead>
                                   <!--  <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                            
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                                        @foreach ($categories as $category )
                                            
                                        
                                        <tr>
                                            <td>{{$category->id}}</td>
                                            <td><a href="{{route('categories.show',$category)}}">{{$category->name}}</a></td>
                                            {{-- <td><a href="">{{$category->name}}</a></td> --}}
                                            <td>{{$category->description}}</td>
                                            <td>
                                                <form action="{{route('categories.destroy',$category)}}" method="POST">
                                                  @csrf @method('DELETE')
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a href="{{route('categories.edit',$category)}}" class="btn btn-outline-primary">editar</a>
                                                    <button type="submit" class="btn btn-outline-primary">Eliminar</button>
                                                  </div>
                                                </form>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    

                    
<div class="container mt-3">

  <!-- The Modal -->
  <div class="modal fade" id="crear">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Crear Nuevo Articulo</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{route('categories.store')}}" method="POST">
                @csrf
              <div class="mb-3 mt-3">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
              </div>
              <div class="mb-3 mt-3">
                <label for="description">Descripcion</label>
                <textarea rows="3" class="form-control" id="description" name="description" placeholder="Descripcion"></textarea>
              </div>
              <a class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
              <button type="submit" class="btn btn-primary">Guardar</button>
              
            </form>

          
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> --}}
        </div>
  
      </div>
    </div>
  </div>
  
@endsection