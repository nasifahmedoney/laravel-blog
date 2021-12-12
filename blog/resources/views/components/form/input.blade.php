@props(['name', 'type' => 'text'])

<div class="mb-6">
    <x-form.label name="{{ $name }}" />
    <input class="border border-gray-400 p-2 w-full rounded"
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
    value="{{ old($name) }}"
    {{--stores the input value if redirected back to this form --}}
    required>
    <x-form.error name={{ $name }} />
</div>

