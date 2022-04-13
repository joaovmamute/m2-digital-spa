<div class="mt-6">
    <h2 class="text-xl font-semibold leading-tight text-gray-700">
        {{ __('Produtos') }}
    </h2>
    <div class="flex flex-col mt-3 sm:flex-row justify-between">
        {{-- <div class="flex">
            <div class="relative">
                <select class="block w-full h-full px-4 py-2 pr-8 leading-tight text-gray-700 bg-white border border-gray-400 rounded-l appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                    </svg>
                </div>
            </div>
            <div class="relative">
                <select class="block w-full h-full px-4 py-2 pr-8 leading-tight text-gray-700 bg-white border-t border-b border-r border-gray-400 rounded-r appearance-none sm:rounded-r-none sm:border-r-0 focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                    <option>All</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                    </svg>
                </div>
            </div>
            <div class="relative block mt-2 sm:mt-0">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="w-4 h-4 text-gray-500 fill-current">
                        <path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path>
                    </svg>
                </span>
                <input placeholder="Search" class="block w-full py-2.5 pl-8 pr-6 text-sm text-gray-700 placeholder-gray-400 bg-white border border-b border-gray-400 rounded-l rounded-r appearance-none sm:rounded-l-none focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none">
            </div>
        </div> --}}

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
                        <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
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
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <span wire:click="openModal({{ $produto->id }})" class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight cursor-pointer">
                                    <span aria-hidden="" class="absolute inset-0 bg-yellow-400 opacity-50 rounded-full"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="black" viewBox="0 0 512 512">
                                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z"/>
                                    </svg>
                                </span>
                                <span wire:click="delete({{ $produto->id }})" class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight cursor-pointer">
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
            {{-- <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
                <span class="text-xs text-gray-900 xs:text-sm">Showing 1 to 4 of 50 Entries</span>
                <div class="inline-flex mt-2 xs:mt-0"><button class="px-4 py-2 text-sm font-semibold text-gray-800 bg-gray-300 rounded-l hover:bg-gray-400"> Prev </button><button class="px-4 py-2 text-sm font-semibold text-gray-800 bg-gray-300 rounded-r hover:bg-gray-400"> Next </button></div>
            </div> --}}
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
                <label class="text-gray-700">
                    {{ __('Nome') }}
                </label>
                <input wire:model="nome" class="w-full mt-2 border-gray-200 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500" type="text">
                @error('nome')
                    <span class="error" style="color: #ff0000">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="text-gray-700">
                    {{ __('Preço (ex: 10.00)') }}
                </label>
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
</div>
