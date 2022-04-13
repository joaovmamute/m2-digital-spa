<?php

namespace App\Http\Livewire;

use App\Models\Campanha;
use App\Models\Grupo;
use Livewire\Component;

class Grupos extends Component
{
    public $modal = false;
    public $grupo_id = null;
    public $nome, $campanha_id;

    protected $rules = [
        'nome' => 'required|unique:cidades|max:255'
    ];

    protected $messages = [
        'nome.required' => 'Nome obrigatório.',
        'nome.unique' => 'Grupo já cadastrado.'
    ];

    public function getGruposProperty()
    {
        return Grupo::orderBy('id')->get();
    }

    public function getCampanhasProperty()
    {
        return Campanha::orderBy('id')->get();
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
        $this->modal = false;
    }

    public function delete($id)
    {
        $grupo = Grupo::find($id);

        foreach ($grupo->cidades as $cidade) {
            $cidade->grupo()->dissociate();

            $cidade->save();
        }

        Grupo::destroy($id);
    }
}
