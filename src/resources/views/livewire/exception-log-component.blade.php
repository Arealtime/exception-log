<div>
    <div class="max-w-md mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-xl font-bold text-center mb-4">Search</h2>

        <form wire:submit.prevent="search">
            <div class="mb-4 relative">
                <label for="message" class="block text-sm font-medium text-gray-700">Error</label>
                <input type="text" wire:model="message" id="message"
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg" placeholder="">
                @if ($message)
                    <span wire:click='clearSearch' class="text-red-500 cursor-pointer absolute bottom-3 right-3">x</span>
                @endif
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Search
            </button>

        </form>
       
    </div>

    <div class="overflow-x-auto shadow-lg rounded-lg bg-white">
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
