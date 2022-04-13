<?php

namespace App\Http\Livewire;

use App\Models\Campanha;
use Livewire\Component;

class Campanhas extends Component
{
    public $modal = false;
    public $campanha_id = null;
    public $nome, $desconto;

    protected $rules = [
        'nome' => 'required|unique:cidades|max:255',
        'desconto' => 'required|numeric|min:0|max:100'
    ];

    protected $messages = [
        'nome.required' => 'Nome obrigatório.',
        'nome.unique' => 'Campanha já cadastrada.',
        'desconto.required' => 'Desconto obrigatório.',
        'desconto.numeric' => 'Desconto deve ser apenas números.',
        'desconto.min' => 'Desconto não pode ser menor que 0.',
        'desconto.max' => 'Desconto não pode ser maior que 100.'
    ];

    public function getCampanhasProperty()
    {
        return Campanha::orderBy('id')->get();
    }

    public function render()
    {
        return view('livewire.campanhas');
    }

    public function openModal($id = null)
    {
        if($this->modal) {
            $this->modal = false;
        } else {
            $this->resetValidation();

            $this->campanha_id = $id;

            if (!$this->campanha_id) {
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
        $this->desconto = null;
    }

    public function setInput()
    {
        $campanha = Campanha::find($this->campanha_id);

        $this->nome = $campanha->nome;
        $this->desconto = $campanha->desconto;
    }

    public function criar()
    {
        $this->validate();

        Campanha::create([
            'nome' => $this->nome,
            'desconto' => bcdiv($this->desconto, 100, 4)
        ]);

        $this->resetInput();
        $this->modal = false;
    }

    public function atualizar()
    {
        $this->validate([
            'nome' => 'required|max:255',
            'desconto' => 'required|numeric|min:0|max:100'
        ]);

        if(Campanha::where('nome', $this->nome)->fist()->id != $this->campanha_id) {
            $this->addError('nome', 'Campanha já cadastrada.');
            return;
        }

        Campanha::find($this->campanha_id)
            ->update([
                'nome' => $this->nome,
                'desconto' => bcdiv($this->desconto, 100, 4)
            ]);

        $this->resetInput();
        $this->modal = false;
    }

    public function delete($id)
    {
        $Campanha = Campanha::find($id);

        foreach ($Campanha->grupos as $grupo) {
            $grupo->Campanha()->dissociate();

            $grupo->save();
        }

        Campanha::destroy($id);
    }
}
