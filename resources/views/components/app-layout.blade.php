@props(['header' => null])

<x-layouts.app :header="$header ?? null">
    {{ $slot }}
</x-layouts.app>
