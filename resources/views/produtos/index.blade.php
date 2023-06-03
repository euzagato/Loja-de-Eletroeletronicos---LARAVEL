@extends('layouts.app')
@section('content')
    <main class="container">
        <section>
            <div class="titlebar">
                <h1><b>Cuiabana Eletro-marcas</b></h1>
                <a class="btn-link" href="{{ route('produtos.create') }}">Adicionar Produto</a>
            </div>

            @if ($message = Session::get('sucesso'))
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: '{{ $message }}'
                    })
                </script>
            @endif


            <div class="table">
                <div class="table-filter">
                    <div>
                        <ul class="table-filter-list">
                            <li>
                                <p><b>- Inventário de Itens</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <form action="{{ route('produtos.index') }}" method="get" accept-charset="UTF-8" role="search">
                    <div class="table-search">
                        <div>
                            <button class="search-select">Buscar</button>
                            <span class="search-select-arrow">
                                <i class="fas fa-caret-down"></i>
                            </span>
                        </div>
                        <div class="relative">
                            <input class="search-input" type="text" name="buscar" placeholder="Buscar produto..."
                                value="{{ request('buscar') }}" />
                        </div>
                    </div>
                </form>

                <div class="table-product-head">
                    <p>Foto</p>
                    <p>Nome</p>
                    <p>Categoria</p>
                    <p>Inventário</p>
                    <p>Ações</p>
                </div>
                <div class="table-product-body">

                    @if (count($produtos) > 0)
                        @foreach ($produtos as $i => $produto)
                            <img src="{{ asset('prod_fotos/' . $produto->prod_foto) }}" />
                            <p>{{ $produto->prod_nome }}</p>
                            <p>{{ $produto->prod_categoria }}</p>
                            <p>{{ $produto->prod_quantidade }}</p>
                            <div>
                                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-success">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('produtos.destroy', $produto->id) }}" method="post"
                                    style="display: inline;">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" onclick="deleteConfirm(event)">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    @else
                        <p>Nenhum produto encontrado... :(</p>
                    @endif

                </div>
                <div class="table-paginate">
                    {{ $produtos->links('layouts.paginacao') }}
                </div>
            </div>
        </section>
    </main>
    <script>
        window.deleteConfirm = function(e) {
            e.preventDefault();
            var form = e.target.form;

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Esta certo disso?',
                text: "Seu item jamais será recuperado!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Continuar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
    </script>
@endsection
