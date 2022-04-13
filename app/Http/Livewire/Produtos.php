<?php

namespace App\Http\Livewire;

use App\Models\Campanha;
use App\Models\Produto;
use Livewire\Component;

class Produtos extends Component
{
    public $modal = false;
    public $produto_id = null;
    public $nome, $preco;

    protected $rules = [
        'nome' => 'required|unique:cidades|max:255',
        'preco' => 'required|numeric|min:0'
    ];

    protected $messages = [
        'nome.required' => 'Nome obrigatório.',
        'nome.unique' => 'Produto já cadastrada.',
        'preco.required' => 'Preço obrigatório.',
        'preco.numeric' => 'Preço deve ser apenas números.',
        'preco.min' => 'Preço não pode ser menor que 0.'
    ];

    public function getProdutosProperty()
    {
        return Produto::orderBy('id')->get();
    }

    public function getCampanhasProperty()
    {
        return Campanha::orderBy('id')->get();
    }

    public function render()
    {
        return view('livewire.produtos');
    }

    public function openModal($id = null)
    {
        if($this->modal) {
            $this->modal = false;
        } else {
            $this->resetValidation();

            $this->produto_id = $id;

            if (!$this->produto_id) {
                $this->resetInput();
            } else {
                $this->setInput();
            }

            $this->modal = true;
        }
    }

    public function resetInput()
    {
        $this->nome = null;
        $this->preco = null;
    }

    public function setInput()
    {
        $produto = Produto::find($this->produto_id);

        $this->nome = $produto->nome;
        $this->preco = $produto->preco;
    }

    public function criar()
    {
        $this->validate();

        Produto::create([
            'nome' => $this->nome,
            'preco' => bcmul($this->preco, '1', 2)
        ]);

        $this->resetInput();
        $this->modal = false;
    }

    public function atualizar()
    {
        $this->validate([
            'nome' => 'required|max:255',
            'preco' => 'required|numeric|min:0'
        ]);

        if(Produto::where('nome', $this->nome)->fist()->id != $this->produto_id) {
            $this->addError('nome', 'Produto já cadastrada.');
            return;
        }

        Produto::find($this->produto_id)
            ->update([
                'nome' => $this->nome,
                'preco' => bcmul($this->preco, '1', 2)
            ]);

        $this->resetInput();
        $this->modal = false;
    }

    public function delete($id)
    {
        Produto::destroy($id);
    }
}
