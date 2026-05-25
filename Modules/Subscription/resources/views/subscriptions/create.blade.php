<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Subscription</h2></x-slot>
    <div class="py-8"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8">@include('subscription::subscriptions.form', ['subscription' => null, 'action' => route('subscriptions.store'), 'method' => 'POST'])</div></div>
</x-app-layout>
