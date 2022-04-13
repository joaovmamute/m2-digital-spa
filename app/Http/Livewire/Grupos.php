<?php

namespace App\Http\Livewire;

use App\Models\Campanha;
use App\Models\Grupo;
use Livewire\Component;
use Livewire\WithPagination;

class Grupos extends Component
{
    use WithPagination;

    public $modal = false;
    public $deleteModal = false;
    public $grupo_id = null;
    public $nome, $campanha_id;
    public $filtroCampanha = '';
    public $search = '';

    protected $rules = [
        'nome' => 'required|unique:cidades|max:255'
    ];

    protected $messages = [
        'nome.required' => 'Nome obrigatório.',
        'nome.unique' => 'Grupo já cadastrado.'
    ];

    protected $listeners = ['gruposRender' => 'render'];

    public function getGruposProperty()
    {
        $grupo = Grupo::orderBy('id');

        if ($this->filtroCampanha) {
            $grupo->where('campanha_id', $this->filtroCampanha);
        }

        if ($this->search) {
            $grupo->where('nome', 'like', '%' . $this->search . '%');
        }

        return $grupo->paginate(10);
    }

    public function getCampanhasProperty()
    {
        return Campanha::orderBy('id')->get();
    }

    public function callRenders()
    {
        $this->emit('cidadesRender');
        $this->emit('campanhasRender');
        $this->emit('produtosRender');
    }

    public function render()
    {
        return view('livewire.grupos');
    }

    public function openModal($id = null)
    {
        if($this->modal) {
            $this->modal = false;
        } else {
            $this->resetValidation();

            $this->grupo_id = $id;

            if (!$this->grupo_id) {
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
        $this->campanha_id = null;
    }

    public function setInput()
    {
        $grupo = Grupo::find($this->grupo_id);

        $this->nome = $grupo->nome;
        $this->campanha_id = $grupo->campanha_id;
    }

    public function criar()
    {
        $this->validate();

        Grupo::create([
            'nome' => $this->nome,
            'campanha_id' => $this->campanha_id
        ]);

        $this->resetInput();
        $this->callRenders();
        $this->modal = false;
    }

    public function atualizar()
    {
        $this->validate([
            'nome' => 'required|max:255'
        ]);

        if(Grupo::where('nome', $this->nome)->fist()->id != $this->grupo_id) {
            $this->addError('nome', 'Grupo já cadastrado.');
            return;
        }

        Grupo::find($this->grupo_id)
            ->update([
                'nome' => $this->nome,
                'campanha_id' => $this->campanha_id
            ]);

        $this->resetInput();
        $this->callRenders();
        $this->modal = false;
    }

    public function openDeleteModal($id)
    {
        $this->grupo_id = $id;
        $this->setInput();
        $this->deleteModal = true;
    }

    public function delete()
    {
        $grupo = Grupo::find($this->grupo_id);

        foreach ($grupo->cidades as $cidade) {
            $cidade->grupo()->dissociate();

            $cidade->save();
        }

        $grupo->delete();
        $this->resetInput();
        $this->callRenders();
        $this->deleteModal = false;
    }
}
