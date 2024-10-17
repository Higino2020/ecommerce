@extends('layouts.admin')
@section('base')
    
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Produto</h3>
        
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
            <a href="#">Produto</a>
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
              <h4 class="card-title">Lista de Produtos</h4>
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
                        <th>Codigo</th>
                        <th>Produto</th>
                        <th>Marca</th>
                        <th>Preço</th>
                        <th>Qtd(Unid)</th>
                        <th>Estado</th>
                        <th>Categoria</th>
                        <th>Subcateoria</th>
                        <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($produto as $prod)
                        <tr>
                            <td> <img  src="{{asset('img/produto/'.$prod->imagem)}}" style="width: 50px; height: 50px;object-fit: cover" alt=""></td>
                            <td>{{$prod->codigo}}</td>
                            <td>{{$prod->titulo}}</td>
                            <td><a href="{{route('marca.index')}}">{{$prod->marca->titulo}}</a></td>
                            <td><b>{{number_format($prod->preco,0,","," ")}} Kz</b></td>
                            <td><b>{{$prod->qtd}}</b></td>
                            <td class="text-warning" >{{$prod->estado}}</td>
                            <td><a href="{{route('catego.index')}}">{{$prod->categoria->titulo}}</a></td>
                            <td><a href="{{route('subcatego.index')}}">{{$prod->subcategoria->titulo}}</a></td>
                            <td>
                                <a href="#Cadastrar" data-bs-toggle="modal" onclick="editar({{$prod}})" style="font-size: 20px; margin-right:10px" class="text-primary"><i class="fa fa-edit"></i></a>
                                <a href="#Confirmar" data-bs-toggle="modal" onclick="atribuirhref({{$prod->id}})" class="text-danger" style="font-size: 20px"><i class="fa fa-trash"></i></a>
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
                    Cadastro de Produtos
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                   <div class="row">
                    <x-input-form id="imagem" type="file" name="imagem" titulo="Imagem do produto" />
                   </div>
                    <div class="row">
                      <x-select id="marca_id" name="marca_id" titulo="Escolha a Marca" rotulo="Escolhe a Marca" >
                        @foreach (App\Models\Marca::all() as $item)
                          <option value="{{$item->id}}">{{$item->titulo}}</option>
                        @endforeach
                      </x-select>
                      <x-input-form-adapt id="codigo" type="text" name="codigo" titulo="Codigo do Produto" />
                    </div>
                    <div class="row">
                      <x-input-form-adapt id="titulo" type="text" name="titulo" titulo="Titulo do produto" />
                      <x-input-form-adapt id="preco" type="text" name="preco" titulo="Preço do Unitario" />
                    </div>
                    <div class="row">
                        <x-input-form-adapt id="qtd" type="number" name="qtd" titulo="Quantidade Existente" />
                        <x-select id="estado" name="estado" titulo="Estado do produto" rotulo="Escolhe o estado do produto" >
                          <option value="Novo" selected>Novo</option>
                          <option value="Semi-Novo">Semi-Novo</option>
                          <option value="Usado">Usado</option>
                          <option value="Concertado">Concertado</option>
                        </x-select>
                    </div>
                    <div class="row">
                      <x-select id="categoria_id" name="categoria_id" titulo="Escolha a Categoria" rotulo="Escolhe uma categoria" >
                          @foreach (App\Models\Categoria::all() as $item)
                            <option value="{{$item->id}}">{{$item->titulo}}</option>
                          @endforeach
                      </x-select>
                      <x-select id="subcategoria_id" name="subcategoria_id" titulo="Escolha a Subcategoria" rotulo="Escolhe uma subcategoria" >
                          @foreach (App\Models\Subcategoria::all() as $item)
                            <option value="{{$item->id}}">{{$item->titulo}}</option>
                          @endforeach
                      </x-select>
                    </div>
                    
                    <div class="row">
                      <x-descricao-component titulo="Descrição da Produto" />

                    </div>
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
        document.getElementById('codigo').value = valor.codigo
        document.getElementById('estado').value = valor.estado
        document.getElementById('preco').value = valor.preco
        document.getElementById('qtd').value = valor.qtd
        document.getElementById('marca_id').value = valor.marca.titulo
        document.getElementById('categoria_id').value = valor.categoria.titulo
        document.getElementById('subcategoria_id').value = valor.subcategoria.titulo
        document.getElementById('descricao').value = valor.descricao
      }
      function limpar(){
        document.getElementById('id').value = ""
        document.getElementById('titulo').value = ""
        document.getElementById('codigo').value = ""
        document.getElementById('estado').value = ""
        document.getElementById('preco').value = ""
        document.getElementById('qtd').value = ""
        document.getElementById('marca_id').value = ""
        document.getElementById('categoria_id').value = ""
        document.getElementById('subcategoria_id').value = ""
        document.getElementById('descricao').value = ""
      }
      function atribuirhref(id){
        document.getElementById('apagarid').setAttribute("href","http://localhost:8000/gestor/product/"+id+"/apagar")
      }
    </script>


<div class="modal fade"   id="Confirmar" tabindex="-1"  role="dialog" aria-labelledby="modalTitleId"  aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalTitleId">
                Confirmação de Exclusão do produto
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
                 <p> <i class="fa fa-alert"></i> Tem a certeza de que deseja apagar este Produto? Esta ação é permanente e não poderá ser desfeita.</p>
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