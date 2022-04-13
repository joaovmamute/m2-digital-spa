<?php

namespace App\Http\Livewire;

use App\Models\Cidade;
use App\Models\Grupo;
use Livewire\Component;

class Cidades extends Component
{
    public $modal = false;
    public $cidade_id = null;
    public $nome, $grupo_id;

    protected $rules = [
        'nome' => 'required|unique:cidades|max:255'
    ];

    protected $messages = [
        'nome.required' => 'Nome obrigatório.',
        'nome.unique' => 'Cidade já cadastrada.'
    ];

    public function getCidadesProperty()
    {
        return Cidade::orderBy('id')->get();
    }

    public function getGruposProperty()
    {
        return Grupo::orderBy('id')->get();
    }

    public function render()
    {
        return view('livewire.cidades');
    }

    public function openModal($id = null)
    {
        if($this->modal) {
            $this->modal = false;
        } else {
            $this->resetValidation();

            $this->cidade_id = $id;

            if (!$this->cidade_id) {
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
        $this->grupo_id = null;
    }

    public function setInput()
    {
        $cidade = Cidade::find($this->cidade_id);

        $this->nome = $cidade->nome;
        $this->grupo_id = $cidade->grupo_id;
    }

    public function criar()
    {
        $this->validate();

        Cidade::create([
            'nome' => $this->nome,
            'grupo_id' => $this->grupo_id
        ]);

        $this->resetInput();
        $this->modal = false;
    }

    public function atualizar()
    {
        $this->validate([
            'nome' => 'required|max:255'
        ]);

        $__cidade = Cidade::where('nome', $this->nome)->first();
        if($__cidade && $__cidade->id != $this->cidade_id) {
            $this->addError('nome', 'Cidade já cadastrada.');
            return;
        }

        Cidade::find($this->cidade_id)
            ->update([
                'nome' => $this->nome,
                'grupo_id' => $this->grupo_id
            ]);

        $this->resetInput();
        $this->modal = false;
    }

    public function delete($id)
    {
        Cidade::destroy($id);
    }
}
