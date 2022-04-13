<?php

namespace App\Http\Livewire;

use App\Models\Campanha;
use App\Models\Produto;
use Livewire\Component;
use Livewire\WithPagination;

class Produtos extends Component
{
    use WithPagination;

    public $modal = false;
    public $deleteModal = false;
    public $campanhasModal = false;
    public $produto_id = null;
    public $nome, $preco;
    public $search = '';

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

    protected $listeners = ['produtosRender' => 'render'];

    public function getProdutosProperty()
    {
        $produto = Produto::orderBy('id');

        if ($this->search) {
            $produto->where('nome', 'like', '%' . $this->search . '%');
        }

        return $produto->paginate(10);
    }

    public function getCampanhasProperty()
    {
        return Campanha::orderBy('id')->get();
    }

    public function callRenders()
    {
        $this->emit('cidadesRender');
        $this->emit('gruposRender');
        $this->emit('campanhasRender');
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
        $this->callRenders();
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
        $this->callRenders();
        $this->modal = false;
    }

    public function openDeleteModal($id)
    {
        $this->produto_id = $id;
        $this->setInput();
        $this->deleteModal = true;
    }

    public function delete()
    {
        $produto = Produto::find($this->produto_id);

        if($produto->campanhas->count()) {
            $produto->campanhas()->detach();
        }

        $produto->delete();
        $this->resetInput();
        $this->callRenders();
        $this->deleteModal = false;
    }

    public function openCampanhasModal($id = null)
    {
        $this->produto_id = $id;

        $this->campanhasModal = true;
    }

    public function analisaCampanha($id)
    {
        $produto = Produto::find($this->produto_id);

        if($produto->campanhas->find($id)) {
            $produto->campanhas()->detach($id);
        } else {
            $produto->campanhas()->attach($id);
        }
    }
}
