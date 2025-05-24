<div>
    <div class="max-w-2xl mx-auto p-2 bg-white shadow-lg rounded-lg">
        <h2 class="text-xl font-bold text-center mb-4">Search</h2>

        <form wire:submit.prevent="search">
            <div class="mb-4 flex gap-3 justify-center">
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <input type="text" wire:model="message" id="message"
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg" placeholder="">
                </div>
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700">Url</label>
                    <input type="text" wire:model="url" id="url"
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg" placeholder="">
                </div>
            </div>
            <div class="flex justify-center gap-3">
                <button type="submit" class=" bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Search
                </button>
                @if ($message || $url)
                    <button wire:click.prevent='clearSearch'
                        class="cursor-pointer bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">x</button>
                @endif
            </div>

        </form>

    </div>

    <div class="overflow-x-auto shadow-lg rounded-lg p-5 mt-2 bg-white">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Message</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Url</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Created at</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($logs as $log)
                    <tr class="border-b">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $log->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $log->message }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $log->url }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>

</div>
