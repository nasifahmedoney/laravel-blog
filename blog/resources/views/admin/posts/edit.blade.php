<x-layout>

    <x-setting :heading="'Edit Post: '.$post->title">
        <form method="POST" action="/admin/posts/{{$post->id}}" class="mt-10" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <x-form.input name="title" value="{{ $post->title }}"/>
            <x-form.input name="slug" value="{{ $post->slug }}"/>
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" value="{{ $post->thumbnail }}"/>
                </div>
                <img src="{{ asset('storage/'.$post->thumbnail) }}" alt="" class="rounded-xl ml-6" width="100">
            </div>

            <x-form.textarea name="excerpt"> {{ $post->excerpt }}</x-form.textarea>
            <x-form.textarea name="body" >{{ $post->body }}</x-form.textarea>


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
                            {{ old('category_id',$post->category_id)==$category->id ? 'selected' : '' }}
                            >{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                    Update Post
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