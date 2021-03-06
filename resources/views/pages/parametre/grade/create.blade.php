<x-app-layout>
    <x-header>Gestion des grades</x-header>

    <x-card.card>
        <x-card.header>
            Nouveau grade
        </x-card.header>

        <form action="{{ route('parametre.grade.store') }}" method="POST">
            @csrf

            <div class="px-4 py-2">

                <label class="block mb-2">
                    <span class="text-gray-700">Libelle court</span>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md" name="lib_court">
                </label>

                <label class="block">
                    <span class="text-gray-700">Libelle long</span>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md" name="lib_long">
                </label>
            </div>

            <div class="px-4 py-2 flex justify-end items-center space-x-2">
                <x-form.cancel-btn :href="route('parametre.grade.index')"></x-form.cancel-btn>
                <x-form.submit-btn></x-form.submit-btn>
            </div>

        </form>


    </x-card.card>


</x-app-layout>
