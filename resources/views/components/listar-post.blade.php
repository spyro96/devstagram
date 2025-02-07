<div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @if ($posts->count())
        @foreach ($posts as $post)
            <div>
                <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                    <img src="{{ asset('uploads'). '/' .$post->imagen}}" alt="imagen del post {{$post->titulo}}">
                </a>


            </div>
        @endforeach

        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>

        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold"> No hay posts, sigue a alaguien para poder mostrar sus posts.</p>
        @endif
    </div>
</div>