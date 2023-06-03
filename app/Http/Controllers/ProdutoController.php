<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    // BARRA DE PESQUISA DE PRODUTOS.
    public function index(Request $request)
    {
        //  Trazendo o nome do produto que o usuário digitou.
        $palavraChave = $request->get('buscar');

        //  Número de produtos a serem exibidos por página.
        $cadaPagina = 4;

        if (!empty($palavraChave)) {
            $produtos = Produto::where('prod_nome', 'LIKE', "%$palavraChave%")->orWhere('prod_categoria', 'LIKE', "%$palavraChave%")->latest()->paginate($cadaPagina);
        } else {
            $produtos = Produto::latest()->paginate($cadaPagina);
        }


        //  Retornando o produto desejado, de acordo com o digitado pelo usuário.
        return view('produtos.index', ['produtos' => $produtos])->with('i', (request()->input('page', 1) - 1) * 5);
    }


    // IR PARA A PÁGINA DE CRIAÇÃO DE UM NOVO PRODUTO.
    public function create()
    {
        return view('produtos.create');
    }


    //  CRIAR UM PRODUTO.
    public function store(Request $request)
    {
        $produto = new Produto();

        //  Criando um nome único para a imagem do produto, de acordo com o MOMENTO de seu cadastramento.
        $nome_foto = time() . '.' . request()->prod_foto->getClientOriginalExtension();
        request()->prod_foto->move(public_path('prod_fotos'), $nome_foto);


        //  Atribuindo os dados do novo produto
        $produto->prod_nome = $request->prod_nome;
        $produto->prod_descricao = $request->prod_descricao;
        $produto->prod_categoria = $request->prod_categoria;
        $produto->prod_quantidade = $request->prod_quantidade;
        $produto->prod_preco = $request->prod_preco;
        $produto->prod_foto = $nome_foto;
        $produto->save();


        //  Retornando uma mensagem, que vai chamar um PopUp na página do index.
        return redirect()->route('produtos.index')->with('sucesso', 'Produto adicionado!');
    }


    //  PEGAR O ID DO PRODUTO A SER ALTERADO.
    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos.edit', ['produto' => $produto]);
    }


    // ALTERAR UM PRODUTO.
    public function update(Request $request, Produto $produto)
    {
        $nome_foto = $request->prod_foto_hidden;


        //  Resgatando a imagem anterior do produto editado, caso ele não receba uma nova imagem.
        if ($request->prod_foto != '') {
            $nome_foto = time() . '.' . request()->prod_foto->getClientOriginalExtension();
            request()->prod_foto->move(public_path('prod_fotos'), $nome_foto);
        }

        //  Buscando o ID do produto a ser alterado.
        $produto = Produto::find($request->prod_id);

        //  Atribuindo os novos dados à um produto.
        $produto->prod_nome = $request->prod_nome;
        $produto->prod_descricao = $request->prod_descricao;
        $produto->prod_categoria = $request->prod_categoria;
        $produto->prod_quantidade = $request->prod_quantidade;
        $produto->prod_preco = $request->prod_preco;
        $produto->prod_foto = $nome_foto;
        $produto->save();


        //  Retornando uma mensagem, que vai chamar um PopUp na página do index.
        return redirect()->route('produtos.index')->with('sucesso', 'Produto atualizado!');
    }

    // EXCLUIR UM PRODUTO.
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $caminhoImagem = public_path() . "/prod_fotos/";
        $image = $caminhoImagem . $produto->prod_foto;

        if (file_exists($image)) {
            @unlink($image);
        }

        $produto->delete();
        return redirect('produtos')->with('sucesso', 'Produto excluido!');
    }
}
