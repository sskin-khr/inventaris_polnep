@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex h-16 shrink-0 items-center border-b-2 border-blue-600 px-3 text-sm font-semibold text-blue-700 transition'
            : 'inline-flex h-16 shrink-0 items-center border-b-2 border-transparent px-3 text-sm font-medium text-slate-500 transition hover:border-slate-300 hover:text-slate-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
