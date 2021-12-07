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