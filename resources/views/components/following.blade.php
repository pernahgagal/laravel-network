@foreach ($users as $user)
<x-card>
    <div class="flex items-center">
        <div class="flex-shrink-0 mr-3">
            <img class="w-10 h-10 rounded-full" src="https://i.pravatar.cc/150?u={{ $user->email }}"
                alt="{{ $user->name }}">
        </div>
        <div>
            <div class="font-semibold">
                <a href="{{ route('profile', $user->username) }}" class="font-semi-bold block">
                    {{ $user->name }}
                </a>
                @if (request()->routeIs('users.index'))
                    <form action="{{ route('follow.store', $user) }}" method="post">
                        @csrf
                        <x-button>
                            @if (Auth::user()->follows()->where('following_user_id', $user->id)->first())
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-x" viewBox="0 0 16 16">
                                <path
                                    d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                <path
                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-add" viewBox="0 0 16 16">
                                <path
                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                <path
                                    d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                            </svg>
                            @endif
                        </x-button>
                    </form>
                @endif
            </div>
            @if ($user->pivot)
            <div class="text-sm text-gray-600">
                {{ $user->pivot->created_at->diffForHumans() }}
            </div>
            @endif
        </div>
    </div>
</x-card>
@endforeach
