@auth
    <x-panel>
        <form action="/post/{{ $post->slug }}/comments" method="post">
            @csrf

            <header class="flex items-center">
                <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="40" height="40" class="rounded-full">
                {{-- alternative: auth()->user()->id --}}
                <h2 class="ml-4">Write Comment</h2>
            </header>
            <div class="mt-6">
                {{-- space in textarea, new line and tab issue maybe, deleting the space shows the placeholder --}}
                <textarea name="body" 
                class="w-full text-sm focus:outline-none focus:ring"
                placeholder="Comment"
                rows="5"
                required></textarea>
                {{-- errors if any, show at the bottom of textarea  --}}
                @error('body')
                    <span class="test-xs test-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end mt-10 border-t border-gray-200 pt-6">
                <x-submit-button>
                    Post
                </x-submit-button>
            </div>
        </form>
    </x-panel>
@else
    <div class="font-bold">
        <a href="/login">Login</a> Or <a href="/register">Register</a> to comment
    </div>    
@endauth