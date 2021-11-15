{{-- from posts.blade.php --}}
@props(['posts'])

<x-post-featured :post="$posts[0]"/>

@if($posts->count() > 1)
    <div class="lg:grid lg:grid-cols-6">
        
        @foreach ($posts->skip(1) as $post) 
        
            <x-post-card :post="$post" class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2'}}"/>
                
        @endforeach                    
    </div>
@endif 

{{-- collection starts at 1 --}}
{{-- @dd($loop) --}}
{{-- loop iteration less then 3, 2 cards with 3 col span each , 3 or greater 3 cards in a row 2 col span each--}}