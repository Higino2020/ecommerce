@extends('layouts.admin')
@section('base')
    
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Utilizadores</h3>
        @if(Session::has('Sucesso'))
            <div class="alert alert-success">
                <p>{{Session::get('success')}}</p>
            </div>
        @endif
        @if(Session::has('Error'))
            <div class="alert alert-danger">
                <p>{{Session::get('error')}}</p>
            </div>
        @endif
        <ul class="breadcrumbs mb-3">
          <li class="nav-home">
            <a href="#">
              <i class="icon-home"></i>
            </a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li> 
          <li class="nav-item">
            <a href="{{route('admin.index')}}">Inicio</a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item">
            <a href="#">Categoria</a>
          </li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header titulo">
              <h4 class="card-title">Lista de Categoria</h4>
              <input type="text" id="campo_busca" onkeyup="busca()" style="width: 30%" class="form-control" placeholder="buscar dados">
              <a href="#Cadastrar" data-bs-toggle="modal" class="text-primary" style="font-size: 30px"><i class="fa fa-circle-plus"></i></a>
            </div>
            <div class="card-body">
                <span id="result"></span>
              <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Imagem</th>
                      <th>Titulo da cateoria</th>
                      <th>Descrição</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categoria as $cate)
                        <tr>
                            <td> <a href="{{asset('img/categoria/'.$cate->imagem)}}" download="{{$cate->imagem}}"><img src="{{asset('img/categoria/'.$cate->imagem)}}" style="width: 50px" alt=""></a></td>
                            <td>{{$cate->titulo}}</td>
                            <td>{{$cate->descricao}}</td>
                            <td>
                                <a href="{{route('catego.apagar',$cate->id)}}" style="font-size: 20px"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Modal -->
<div
    class="modal fade"
    id="Cadastrar"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Cadastro de Categoria
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form action="{{route('catego.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="">Imagem</label>
                        <div class="input-form">
                            <input type="file" class="form-control" name="imagem" id="imagem">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Titulo da Categoria</label>
                        <div class="input-form">
                            <input type="text" class="form-control" name="titulo" id="titulo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Descrição da Categoria</label>
                        <div class="input-form">
                            <textarea name="descricao" id="descricao" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Concelar
                </button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script>
    var modalId = document.getElementById('modalId');

    modalId.addEventListener('show.bs.modal', function (event) {
          // Button that triggered the modal
          let button = event.relatedTarget;
          // Extract info from data-bs-* attributes
          let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });
</script>

    


<script>
    function busca() {
      // declaração das variaáveis
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("campo_busca"); // id do campo de busca
      filter = input.value.toUpperCase();
      table = document.getElementById("basic-datatables"); // id da tabela
      tr = table.getElementsByTagName("tr");
      // loop em todas as linhas da tabela e oculte aquelas que não correspondem à consulta de pesquisa
      for (i = 0; i < tr.length; i++)  
      {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) 
        {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) 
          {
            tr[i].style.display = "";
          } 
          else 
          {
            tr[i].style.display = "none";
          }
        }
      }
    }
    </script>

@endsection