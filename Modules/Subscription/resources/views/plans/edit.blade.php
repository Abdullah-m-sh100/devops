<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Plan</h2></x-slot>
    <div class="py-8"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8">@include('subscription::plans.form', ['plan' => $plan, 'action' => route('plans.update', $plan), 'method' => 'PUT'])</div></div>
</x-app-layout>
