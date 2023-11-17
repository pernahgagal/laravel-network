<x-app-layout>
    <x-container>
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-7">
                <div class="border p-5 rounded-xl">
                    <div class="space-y-5">
                        <form action="{{ route('status.store') }}" method="post">
                            @csrf
                            <div class="flex">
                                <div class="flex-shrink-0 mr-3">
                                    <img class="w-10 h-10 rounded-full" src="https://i.pravatar.cc/150?u={{ Auth::user()->email }}" alt="{{ Auth::user()->name }}">
                                </div>
                                <div class="w-full">
                                    <div class="font-semibold">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="my-2">
                                        <textarea
                                        name="body"
                                        id="body"
                                        placeholder="What is on your mind ?"
                                        class="form-textarea w-full border-gray-300 rounded-xl resize-none focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200"></textarea>
                                    </div>
                                    <div class="text-righta">
                                        <x-button>Post</x-button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="space-y-6 mt-5">
                    <div class="space-y-5">
                        <x-statuses :statuses=$statuses></x-statuses>
                    </div>
                </div>
            </div>
            <div class="col-span-5">
                <div class="border p-5 rounded-xl">
                    <h1 class="font-semibold mb-5">Recently Follows</h1>
                    <div class="space-y-5">
                        @foreach (Auth::user()->follows()->limit(5)->get() as $user)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 mr-3">
                                    <img class="w-10 h-10 rounded-full" src="https://i.pravatar.cc/150?u={{ $user->email }}" alt="{{ $user->name }}">
                                </div>
                                <div>
                                    <div class="font-semibold">
                                        {{ $user->name }}
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        {{ $user->pivot->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>
