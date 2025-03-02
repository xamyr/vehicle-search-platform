<div class="md:max-w-[50%] md:mx-auto md:pt-10">
    <div class="flex justify-center py-5">
        <h1 class="font-semibold text-2xl"> Vehicle Search Platform</h1>
    </div>
    <div class="md:flex gap-10 p-4">
        <input type="text" wire:model.live="search" placeholder="Search by Reg. Number (min: 3 characters)" class="border p-2 w-full mb-4 rounded-lg" />
    
        <select wire:model.lazy="vehicleType" class="border p-2 w-full mb-4 rounded-lg">
            <option selected disabled value="">All Types</option>
            <option value="Motorcycle">Motorcycle</option>
            <option value="Car">Car</option>
            <option value="Pickup Truck">Pickup Truck</option>
        </select>
        <select wire:model.lazy="sort" class="border p-2 w-full mb-4 rounded-lg">
            <option selected value="desc">Descending</option>
            <option value="asc">Ascending</option>
        </select>
    </div>
    

    <table class="w-full border-collapse text-center text-sm">
        <thead>
            <tr>
                <th class="cursor-pointer" wire:click="sortBy('reg_no')">Reg. Number</th>
                <th>Type</th>
                <th>Model/Manufacturer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle["reg_no"] }}</td>
                <td>{{ $vehicle["type"]["type"] }}</td>
                <td>{{ $vehicle["model"]["name"] }} - {{ $vehicle["model"]["manufacturer"]["name"] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex justify-center gap-5 fixed bottom-5 w-full md:max-w-[50%]">
        <button wire:click="previousPage" class="p-2 bg-gray-200 rounded-lg {{ ($current == 1) ? 'text-gray-500 cursor-not-allowed' : 'text-black' }}">Previous</button>
        <button wire:click="nextPage" class="p-2 bg-gray-200 rounded-lg {{ ($current >= $last) ? 'text-gray-500 cursor-not-allowed' : 'text-black' }}">Next</button>
    </div>
        
</div>
