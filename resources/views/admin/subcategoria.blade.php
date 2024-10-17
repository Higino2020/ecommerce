@extends('layouts.admin')
@section('base')
    
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">SubCategoria</h3>
        
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
            <a href="#">SubCategoria</a>
          </li>
        </ul>
      </div>
      @if(Session::has('success'))
            <div class="alert alert-success" id="alerta">
                <p>{{Session::get('success')}}</p>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger" id="alerta">
                <p>{{Session::get('error')}}</p>
            </div>
        @endif
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header titulo">
              <h4 class="card-title">Lista de SubCategoria</h4>
              <input type="text" id="campo_busca" onkeyup="busca()" style="width: 30%" class="form-control" placeholder="buscar dados">
              <a href="#Cadastrar" onclick="limpar()" data-bs-toggle="modal" class="text-primary" style="font-size: 30px"><i class="fa fa-circle-plus"></i></a>
            </div>
            <div class="card-body">
                <span id="result"></span>
              <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Imagem</th>
                      <th>Titulo da Subcateoria</th>
                      <th>Titulo da categoria</th>
                      <th>Descrição</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($subcategoria as $sub)
                        <tr>
                            <td> <img  src="{{asset('img/subcategoria/'.$sub->imagem)}}" style="width: 50px; height: 50px;object-fit: cover" alt=""></td>
                            <td>{{$sub->titulo}}</td>
                            <td><a href="{{route('catego.index')}}">{{$sub->categoria->titulo}}</a></td>
                            <td>{{$sub->descricao}}</td>
                            <td>
                                <a href="#Cadastrar" data-bs-toggle="modal" onclick="editar({{$sub}})" style="font-size: 20px; margin-right:10px" class="text-primary"><i class="fa fa-edit"></i></a>
                                <a href="#Confirmar" data-bs-toggle="modal" onclick="atribuirhref({{$sub->id}})" class="text-danger" style="font-size: 20px"><i class="fa fa-trash"></i></a>
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
<div class="modal fade"   id="Cadastrar" tabindex="-1"  role="dialog" aria-labelledby="modalTitleId"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Cadastro de SubCategoria
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form action="{{route('subcatego.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="">Imagem</label>
                        <div class="input-form">
                            <input type="file" class="form-control" name="imagem" id="imagem">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Titulo da SubCategoria</label>
                        <div class="input-form">
                            <input type="text" class="form-control" name="titulo" id="titulo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Titulo da Categoria </label>
                        <select name="categoria_id" id="categoria_id" class="form-control">
                            @foreach (App\Models\Categoria::all() as $item)
                                <option value="{{$item->id}}">{{$item->titulo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-descricao-component titulo="Descrição da SubCategoria" />

            </div>
            <div class="modal-footer">
              <x-button />
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

    <script>
      function editar(valor){
        document.getElementById('id').value = valor.id
        document.getElementById('titulo').value = valor.titulo
        document.getElementById('categoria_id').value = valor.categoria.titulo
        document.getElementById('descricao').value = valor.descricao
      }
      function limpar(){
        document.getElementById('id').value = ""
        document.getElementById('titulo').value = ""
        document.getElementById('categoria_id').value = ""
        document.getElementById('descricao').value = ""
      }
      function atribuirhref(id){
        document.getElementById('apagarid').setAttribute("href","http://localhost:8000/gestor/subcatego/"+id+"/apagar")
      }
    </script>


<div class="modal fade"   id="Confirmar" tabindex="-1"  role="dialog" aria-labelledby="modalTitleId"  aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalTitleId">
                Confirmação de Exclusão da SubCategoria
              </h5>
              <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
              ></button>
          </div>
          <div class="modal-body">
              <div class="alert alert-warning">
                 <p> <i class="fa fa-alert"></i> Tem a certeza de que deseja apagar esta Subcategoria? Esta ação é permanente e não poderá ser desfeita.</p>
              </div>
          </div>
          <div class="modal-footer">
              <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
              >
                  Cancelar
              </button>
              <a href="" id="apagarid"  class="btn btn-success">Sim, quero apagar</a>
          </div>
      </form>
      </div>
  </div>
</div>
@endsection