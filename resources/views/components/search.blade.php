<div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input type="text" id="searchInput" onkeyup="submitSearch()" value="{{ request()->input('search') ?? '' }}"
            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="Search users...">
    </div>
    <button
        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        onclick="submitSearch()">Search</button>
</div>
<script>
    function submitSearch() {
        const query = document.getElementById('searchInput').value;
        const params = new URLSearchParams(window.location.search);
        params.set('search', query);
        window.location.href = `${location.pathname}?${params}`;
    }
</script>
