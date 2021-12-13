@props(['name'])

<div class="mb-6">
    <x-form.label name="{{ $name }}" />
    <input class="border border-gray-400 p-2 w-full rounded"
    name="{{ $name }}"
    id="{{ $name }}"
    {{--stores the input value if redirected back to this form --}}
    {{ $attributes( ['value' => old($name)] ) }}
    >
    <x-form.error name="{{ $name }}" />
</div>

