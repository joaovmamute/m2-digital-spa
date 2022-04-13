<div class="mt-6">
    <h2 class="text-xl font-semibold leading-tight text-gray-700">
        {{ __('Produtos') }}
    </h2>
    <div class="flex flex-col mt-3 sm:flex-row justify-between">
        <div class="flex">
            <div class="relative block mt-2 sm:mt-0">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="w-4 h-4 text-gray-500 fill-current">
                        <path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path>
                    </svg>
                </span>
                <input wire:model.debounce.750ms="search" placeholder="Search" class="block w-full py-2.5 pl-8 pr-6 text-sm text-gray-700 placeholder-gray-400 bg-white border border-b border-gray-400 rounded-l rounded-r appearance-none sm:rounded-l-none focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none">
            </div>
        </div>

        <div class="flex">
            <button wire:click="openModal" class="px-4 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-green-600 rounded-md hover:bg-green-500 focus:outline-none focus:bg-green-500">
                {{ __('Criar') }}
            </button>
        </div>
    </div>
    <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            {{ __('Nome') }}
                        </th>
                        <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            {{ __('Preço') }}
                        </th>
                        <th class="px-5 py-3 text-xs font-semibold tracking-wider text-right text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            {{ __('Ações') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->produtos as $produto)
                        <tr>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-nowrap">
                                    {{ $produto->nome }}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-nowrap">
                                    {{ 'R$ ' . number_format($produto->preco, 2, ',')  }}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200 w-60 text-right">
                                {{-- <span wire:click="openProdutoDetalhe({{ $produto->id }})" class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight cursor-pointer">
                                    <span aria-hidden="" class="absolute inset-0 bg-blue-400 opacity-50 rounded-full"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="black" viewBox="0 0 576 512">
                                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path d="M279.6 160.4C282.4 160.1 285.2 160 288 160C341 160 384 202.1 384 256C384 309 341 352 288 352C234.1 352 192 309 192 256C192 253.2 192.1 250.4 192.4 247.6C201.7 252.1 212.5 256 224 256C259.3 256 288 227.3 288 192C288 180.5 284.1 169.7 279.6 160.4zM480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6V112.6zM288 112C208.5 112 144 176.5 144 256C144 335.5 208.5 400 288 400C367.5 400 432 335.5 432 256C432 176.5 367.5 112 288 112z"/>
                                    </svg>
                                </span> --}}
                                <span wire:click="openCampanhasModal({{ $produto->id }})" class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight cursor-pointer">
                                    <span aria-hidden="" class="absolute inset-0 bg-green-400 opacity-50 rounded-full"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="black" viewBox="0 0 448 512">
                                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path d="M323.5 51.25C302.8 70.5 284 90.75 267.4 111.1C240.1 73.62 206.2 35.5 168 0C69.75 91.12 0 210 0 281.6C0 408.9 100.2 512 224 512s224-103.1 224-230.4C448 228.4 396 118.5 323.5 51.25zM304.1 391.9C282.4 407 255.8 416 226.9 416c-72.13 0-130.9-47.73-130.9-125.2c0-38.63 24.24-72.64 72.74-130.8c7 8 98.88 125.4 98.88 125.4l58.63-66.88c4.125 6.75 7.867 13.52 11.24 19.9C364.9 290.6 353.4 357.4 304.1 391.9z"/>
                                    </svg>
                                </span>
                                <span wire:click="openModal({{ $produto->id }})" class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight cursor-pointer">
                                    <span aria-hidden="" class="absolute inset-0 bg-yellow-400 opacity-50 rounded-full"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="black" viewBox="0 0 512 512">
                                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z"/>
                                    </svg>
                                </span>
                                <span wire:click="openDeleteModal({{ $produto->id }})" class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight cursor-pointer">
                                    <span aria-hidden="" class="absolute inset-0 bg-red-400 opacity-50 rounded-full"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="black" viewBox="0 0 448 512">
                                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"/>
                                    </svg>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $this->produtos->links('vendor.livewire.simple-tailwind') }}
        </div>
    </div>

    <x-jet-dialog-modal wire:model="modal">
        <x-slot name="title">
            <div class="flex justify-between">
                @if (!$produto_id)
                    <p class="text-2xl font-bold">{{ __('Criar Produto') }}</p>
                @else
                    <p class="text-2xl font-bold">{{ __('Editar Produto') }}</p>
                @endif

                <div wire:click="$toggle('modal')" class="z-50 cursor-pointer modal-close">
                    <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-700">
                    {{ __('Nome') }}
                </h2>
                <input wire:model="nome" class="w-full mt-2 border-gray-200 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500" type="text">
                @error('nome')
                    <span class="error" style="color: #ff0000">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-700">
                    {{ __('Preço (ex: 10.00)') }}
                </h2>
                <input wire:model="preco" class="w-full mt-2 border-gray-200 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500" type="number" min="0" max="100" step=".01">
                @error('preco')
                    <span class="error" style="color: #ff0000">{{ $message }}</span>
                @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end pt-2">
                <button wire:click="$toggle('modal')" class="p-3 px-6 py-3 mr-2 text-indigo-500 bg-transparent rounded-lg hover:bg-gray-100 hover:text-indigo-400 focus:outline-none">
                    {{ __('Fechar') }}
                </button>

                @if (!$produto_id)
                    <button wire:click="criar" class="px-6 py-3 font-medium tracking-wide text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none">
                        {{ __('Criar') }}
                    </button>
                @else
                    <button wire:click="atualizar" class="px-6 py-3 font-medium tracking-wide text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none">
                        {{ __('Salvar') }}
                    </button>
                @endif
            </div>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="deleteModal">
        <x-slot name="title">
            <div class="flex justify-between">
                <p class="text-2xl font-bold">{{ __('Deletar Produto') }}</p>

                <div wire:click="$toggle('deleteModal')" class="z-50 cursor-pointer modal-close">
                    <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <h2 class="text-xl font-semibold leading-tight text-gray-700">
                {{ __('Deseja deletar o produto ') . $nome . '?' }}
            </h2>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end pt-2">
                <button wire:click="$toggle('deleteModal')" class="p-3 px-6 py-3 mr-2 text-indigo-500 bg-transparent rounded-lg hover:bg-gray-100 hover:text-indigo-400 focus:outline-none">
                    {{ __('Não') }}
                </button>

                <button wire:click="delete" class="px-6 py-3 font-medium tracking-wide text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none">
                    {{ __('Sim') }}
                </button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="campanhasModal">
        <x-slot name="title">
            <div class="flex justify-between">
                <p class="text-2xl font-bold">{{ __('Editar Campanhas de ') . $nome }}</p>

                <div wire:click="$toggle('campanhasModal')" class="z-50 cursor-pointer modal-close">
                    <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <h2 class="text-xl font-semibold leading-tight text-gray-700">
                    {{ __('Campanhas') }}
                </h2>
            </div>
            <div class="grid grid-cols-3 gap-2">
                @foreach ($this->Campanhas as $campanha)
                    <div wire:click="analisaCampanha({{ $campanha->id }})" class="px-3 py-2 ml-0 leading-tight border border-gray-200 rounded-l hover:bg-indigo-400 hover:text-white cursor-pointer text-center @if($campanha->produtos->find($produto_id)) text-white bg-indigo-500 @else text-indigo-700 bg-white @endif">
                        <span>
                            {{ $campanha->nome }}
                        </span>
                    </div>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end pt-2">
                <button wire:click="$toggle('campanhasModal')" class="px-6 py-3 font-medium tracking-wide text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none">
                    {{ __('Fechar') }}
                </button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
