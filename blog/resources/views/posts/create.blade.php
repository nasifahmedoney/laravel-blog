<x-layout>

    <x-setting heading="Publish new post">
        <form method="POST" action="/admin/posts" class="mt-10" enctype="multipart/form-data">
            @csrf
            
            <x-form.input name="title" />
            <x-form.input name="slug" />
            <x-form.input name="thumbnail" type="file" />
            <x-form.textarea name="excerpt" />
            <x-form.textarea name="body" />


            <div class="mb-6">
                <label for="category_id" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                    Category
                </label>
                <select name="category_id" id="category_id" class="rounded-xl px-2 py-2">
                    @php
                        $categories = \App\Models\Category::all();
                    @endphp
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id')==$category->id ? 'selected' : '' }}
                            >{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                    Submit
                </button>
            </div>
            @if($errors->any())
                <ul>
                    @foreach ($errors as $error)
                        <li class="text-red-500 text-xs">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </x-setting>
    
</x-layout>