<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lista de tareas</title>
  <!-- Fuentes -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" />
  <!-- Estilos -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
  <div style="padding: 60px 160px 0px 160px" class="container d-flex flex-column ">
    <p class="text-center">Nueva Tarea</p>
    @if(count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form action="/store" method="POST" class="form-inline align-items-center justify-content-center">
      {{ csrf_field() }}
      <div class="form-group mx-sm-3 mb-2">
        <input class="form-control" id="nombre" name="name" placeholder="Tarea nueva">
      </div>
      <button type="submit" class="btn btn-success mb-2">Aceptar</button>
    </form>
  </div>

  <div style="padding: 40px 160px 0px 160px" class="container">
    <p class="text-center">Lista de Tareas</p>
    <!-- "a partir de aqui" añadidos botones para filtros del contenido de la tabla (inacabado). -->
    <div class="row"> 
      <div class="col-md-3">
        <a class="btn btn-secondary btn-block" href="/?filtro=all">Overview</a>
      </div>
      <div class="col-md-3">
        <a class="btn btn-success btn-block" href="/?filtro=done">Done</a>
      </div>
      <div class="col-md-3">
        <a class="btn btn-primary btn-block" href="/?filtro=undone">Undone</a>
      </div>
      <div class="col-md-3">
        <a class="btn btn-danger btn-block" href="/?filtro=bin">Bin</a>
      </div>
    </div>
    <!-- Fin del comentario. -->

    @if(count($tareas) > 0)
    <ul class="list-group">
      @foreach($tareas as $tarea)
      <li @if($tarea->done == true)
        style="background-color: #d7ff7c"
        @endif

        class="list-group-item d-flex justify-content-between align-items-center action"
        >
        {{$tarea->name}}
        <div class="d-flex">

          @if($tarea->done == false)

          <form action="/done/{{$tarea->id}}" method="POST" style="margin-right: 5px">
            {{ csrf_field() }}
            <button class="btn btn-info" type="submit">Done</button>
          </form>

          @endif

          @if($tarea->trashed())
          <form action="/recover/{{$tarea->id}}" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-secondary" type="submit">Recover</button>
          </form>
          @else
          <form action="/delete/{{$tarea->id}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
          @endif

        </div>
      </li>
      @endforeach
    </ul>
    @endif
  </div>

</body>

</html>