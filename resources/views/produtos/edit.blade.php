@extends('layouts.app')

@section('content')
    <main class="container">
        <section>
            <form action="{{ route('produtos.update', $produto->id) }}" method="post" enctype="multipart/form-data">
 
                @csrf
                @method('put')
                <div class="titlebar">
                    <h1>Atualizar Produtos</h1>
                </div>
                <div class="card">
                    <div>
                        <label>Nome</label>
                        <input type="text" name="prod_nome" required="required" value="{{ $produto->prod_nome }}">
                        <label>Descrição (opicional)</label>
                        <textarea cols="10" rows="5" name="prod_descricao"> {{ $produto->prod_descricao }} </textarea>
                        <label>Adicionar Foto</label>
                        <img src="{{ asset('prod_fotos/' . $produto->prod_foto) }}" class="img-product" id="image" />
                        <input type="hidden" name="prod_foto_hidden" value="{{ $produto->prod_foto }}">
                        <input type="file" name="prod_foto" accept="image/*" onchange="mostrarFoto(event)">
                    </div>
                    <div>
                        <label>Categoria</label>
                        <select name="prod_categoria" id="" required="required">

                            @foreach (json_decode('{"Eletroeletrônico":"Eletroeletrônico","Aparelho Celular":"Aparelho Celular","Relógios":"Relógios","Fones":"Fones","Carregadores":"Carregadores","Periféricos":"Periféricos"}', true) as $indice => $categoria)
                                <option value="{{ $indice }}"
                                    {{ isset($produto->prod_categoria) && $produto->prod_categoria == $indice ? 'selected="selected"' : '' }}>
                                    {{ $categoria }} </option>
                            @endforeach

                        </select>
                        <hr />
                        <label>Quantidade</label>
                        <input type="text" class="input" name="prod_quantidade" required="required"
                            value="{{ $produto->prod_quantidade }}" />
                        <hr />
                        <label>Valor</label>
                        <input type="text" class="input" name="prod_preco" required="required"
                            value="{{ $produto->prod_preco }}" />
                        <input type="hidden" name="prod_id" value="{{ $produto->id }}">
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
