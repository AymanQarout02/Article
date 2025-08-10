<x-app-layout>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

     <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-gray-500 text-sm font-medium"># of Articles</h3>
                <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $numberOfArticles }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-gray-500 text-sm font-medium"># of Categories</h3>
                <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $numberOfCategories }}</p>
            </div>
            @if(auth()->user()->role === 'admin')
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-gray-500 text-sm font-medium"># of Users</h3>
                <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $numberOfUsers }}</p>
            </div>
            @endif
        </div>

         <div class="bg-white shadow rounded-lg p-6">
             <h3 class="text-gray-700 text-lg font-medium mb-4">Articles per Category</h3>
             <div class="relative h-60">
                 <canvas id="myChart" class="absolute inset-0 w-full h-full"></canvas>
             </div>
         </div>

     </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categoriesName) !!},
                datasets: [{
                    label: '# of articles in the category',
                    data: {!! json_encode($articlesNumber) !!},
                    borderWidth: 1,
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
