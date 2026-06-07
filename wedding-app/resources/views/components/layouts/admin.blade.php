@props(['title' => 'Admin', 'back' => null])

<x-admin-layout :title="$title" :back="$back">
    {{ $slot }}
</x-admin-layout>
