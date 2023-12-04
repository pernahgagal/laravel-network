<div class="border-b mb-5">
    <x-container>
        <div class="flex justify-between items-center">
            <div class="flex">
                <a href="{{ route('profile', $user->username) }}" class="px-10 py-3 text-center border-r border-l">
                    <div class="text-2-xl font-semibold mb-1">{{ $user->statuses->count() }}</div>
                    <div class="uppercase text-xs text-gray-600">Status</div>
                </a>
                <a href="{{ route('follow.index', [$user->username, 'following']) }}"
                    class="px-10 py-3 text-center border-r">
                    <div class="text-2-xl font-semibold mb-1">{{ $user->follows->count() }}</div>
                    <div class="uppercase text-xs text-gray-600">Following</div>
                </a>
                <a href="{{ route('follow.index', [$user->username, 'followers']) }}"
                    class="px-10 py-3 text-center border-r">
                    <div class="text-2-xl font-semibold mb-1">{{ $user->followers->count() }}</div>
                    <div class="uppercase text-xs text-gray-600">Follower</div>
                </a>
            </div>
            <div>
                @if (Auth::user()->isNot($user))
                <form action="{{ route('follow.store', $user) }}" method="post">
                    @csrf
                    <x-button>
                        @if (Auth::user()->follows()->where('following_user_id', $user->id)->first())
                            Unfollow
                        @else
                            Follow
                        @endif
                    </x-button>
                </form>
                @else
                <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white capitalize tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 rounded-xl">Edit Profile</a>
                @endif
            </div>
        </div>
    </x-container>
</div>
