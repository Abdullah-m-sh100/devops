<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Company</h2></x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @include('companies::companies.form', ['company' => null, 'action' => route('companies.store'), 'method' => 'POST'])
        </div>
    </div>
</x-app-layout>
