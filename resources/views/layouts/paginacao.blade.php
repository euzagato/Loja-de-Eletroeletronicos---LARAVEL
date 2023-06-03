@if ($paginator->hasPages())
    <div class="pagination">


        {{-- VOLTAR UMA PAGINA --}}
        @if ($paginator->onFirstPage())
            <a href="#" disabled="disabled">&laquo;</a>
        @else
            <a class="active-page" href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
        @endif



        {{-- NUMERO DE PAGINAS --}}
        @foreach ($elements as $i => $elemento)
            @if (is_string($elemento))
                <a href="">{{ $elemento }}</a>
            @endif

            @if (is_array($elemento))
                @foreach ($elemento as $pagina => $url)
                    @if ($pagina == $paginator->currentPage())
                        <a class="active-page" href="#"> {{ $pagina }} </a>
                    @else
                        <a href="{{ $url }}"> {{ $pagina }} </a>
                    @endif
                @endforeach
            @endif
        @endforeach


        {{-- PASSAR UMA PAGINA --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
        @else
            <a href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
        @endif
    </div>
@endif
