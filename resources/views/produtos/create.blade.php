@extends('layouts.app')

@section('content')
    <main class="container">
        <section>
            <form action="{{ route('produtos.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="titlebar">
                    <h1>Adicionar Produtos</h1>
                </div>
                <div class="card">
                    <div>
                        <label>Nome</label>
                        <input type="text" name="prod_nome" required="required">
                        <label>Descrição (opicional)</label>
                        <textarea cols="10" rows="5" name="prod_descricao"></textarea>
                        <label>Adicionar Foto</label>
                        <img src="" alt="" class="img-product" id="image" />
                        <input type="file" name="prod_foto" accept="image/*" onchange="mostrarFoto(event)"
                            required="required">
                    </div>
                    <div>
                        <label>Categoria</label>
                        <select name="prod_categoria" id="" required="required">

                            <option selected="selected">Selecionar categoria</option>
                            @foreach (json_decode('{"Eletroeletrônico":"Eletroeletrônico","Aparelho Celular":"Aparelho Celular","Relógios":"Relógios","Fones":"Fones","Carregadores":"Carregadores","Periféricos":"Periféricos"}', true) as $indice => $categoria)
                                <option value="{{ $indice }}"> {{ $categoria }} </option>
                            @endforeach

                        </select>
                        <hr />
                        <label>Quantidade</label>
                        <input type="text" class="input" name="prod_quantidade" required="required" />
                        <hr />
                        <label>Valor</label>
                        <input type="text" class="input" name="prod_preco" required="required" />
                        <button>Confirmar</button>
                    </div>
            </form>
        </section>
    </main>

    <script>
        function mostrarFoto(event) {
            var entrada = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var dataURL = reader.result;
                var saida = document.getElementById('imagem');
                saida.src = dataURL;
            };
            reader.readAsDataURL(entrada.files[0]);
        }
    </script>
@endsection
