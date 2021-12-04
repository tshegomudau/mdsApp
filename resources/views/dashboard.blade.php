<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">Holiday List</div>
                    
                    <div class="flex-auto text-right mt-2">
                        <a href="/year" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Get holiday for the year</a>
                    </div>
                </div>
                <table class="w-full text-md rounded mb-4">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Holiday name</th>
                        <th class="text-left p-3 px-5">Month</th>
                        <th class="text-left p-3 px-5">Week day</th>
                        <th class="text-left p-3 px-5">Date</th>
                        <th class="text-left p-3 px-5">type of Holiday</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(auth()->user()->holiday as $holiday)
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                {{$holiday->name}}
                            </td>
                            <td class="p-3 px-5">
                                {{$holiday->month}}
                            </td>
                            <td class="p-3 px-5">
                                {{$holiday->day_of_week}}
                            </td>
                            <td class="p-3 px-5">
                                {{$holiday->day}}-{{$holiday->month}}-{{$holiday->year}}
                            </td>
                            <td class="p-3 px-5">
                                {{$holiday->flags}}
                            </td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</x-app-layout>
