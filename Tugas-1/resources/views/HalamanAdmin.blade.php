@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-[#050505] text-zinc-300"
    x-data="{ 
        currentTab: '{{ old('currentTab', 'dashboard') }}', 
        showModal: {{ $errors->any() ? 'true' : 'false' }}, 
        editMode: {{ old('_method') === 'PUT' ? 'true' : 'false' }},
        formAction: '{{ old('formAction', '') }}',
        courtData: { 
            id: '{{ old('id', '') }}', 
            name: '{{ old('name', '') }}', 
            status: '{{ old('status', 'Active') }}', 
            harga: '{{ old('harga', '') }}' 
        }
     }">

    <aside class="w-64 bg-zinc-950 border-r border-zinc-800 flex flex-col">
        <div class="p-6 mb-8 text-xl font-neon text-[#ccff00]">E-RESERVE_</div>
        <nav class="flex-1 px-4 space-y-2">
            <button @click="currentTab = 'dashboard'" :class="currentTab === 'dashboard' ? 'bg-zinc-900 text-[#ccff00] border-l-4 border-[#ccff00]' : ''" class="w-full flex items-center space-x-4 p-3 rounded hover:bg-zinc-900 transition text-left">
                <span>Dashboard</span>
            </button>
            <button @click="currentTab = 'courts'" :class="currentTab === 'courts' ? 'bg-zinc-900 text-[#ccff00] border-l-4 border-[#ccff00]' : ''" class="w-full flex items-center space-x-4 p-3 rounded hover:bg-zinc-900 transition text-left">
                <span>Manage_Courts</span>
            </button>
            <button @click="currentTab = 'jadwal'" :class="currentTab === 'jadwal' ? 'bg-zinc-900 text-[#ccff00] border-l-4 border-[#ccff00]' : ''" class="w-full flex items-center space-x-4 p-3 rounded hover:bg-zinc-900 transition text-left">
                <span>Tambah_Jadwal</span>
            </button>
            <button @click="currentTab = 'bookings'" :class="currentTab === 'bookings' ? 'bg-zinc-900 text-[#ccff00] border-l-4 border-[#ccff00]' : ''" class="w-full flex items-center space-x-4 p-3 rounded hover:bg-zinc-900 transition text-left">
                <span>Manage_Bookings</span>
            </button>
        </nav>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-500/10 border border-red-500 text-red-500 rounded-xl font-mono text-xs uppercase tracking-widest">
            System_Error:
            <ul class="mt-2 list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!--untuk styling halaman admin manage courts-->
        <div x-show="currentTab === 'courts'" x-transition>
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-neon text-white uppercase italic">System_Court_Registry</h2>
                <button @click="
                    editMode = false; 
                    courtData = { id: '', name: '', status: 'Active', harga: '' };
                    formAction = '{{ route('courts.store') }}';
                    showModal = true;
                " class="px-4 py-2 bg-[#ccff00] text-black text-xs font-bold rounded hover:brightness-110">
                    + ADD_NEW_COURT
                </button>
            </div>

            <div class="bg-zinc-900/40 border border-zinc-800 rounded-2xl overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-900 text-zinc-500 uppercase text-[10px] tracking-widest">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Name</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Price/Hr</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        @foreach($courts as $court)
                        <tr class="hover:bg-zinc-800/30 transition">
                            <td class="p-4 font-mono text-zinc-500">#{{ $court->id }}</td>
                            <td class="p-4 text-white font-bold">{{ $court->name }}</td>
                            <td class="p-4">
                                <span class="px-2 py-1 {{ $court->status == 'Active' ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }} text-[10px] rounded font-bold uppercase">
                                    {{ $court->status }}
                                </span>
                            </td>
                            <td class="p-4 text-[#ccff00]">Rp {{ number_format($court->harga) }}</td>
                            <td class="p-4 flex justify-center space-x-2">
                                <button @click="
                                    editMode = true;
                                    courtData = { id: '{{ $court->id }}', name: '{{ $court->name }}', status: '{{ $court->status }}', harga: '{{ $court->harga }}' };
                                    formAction = '{{ route('courts.update', $court->id) }}';
                                    showModal = true;
                                " class="p-2 border border-zinc-700 hover:border-blue-500 text-blue-500 rounded transition">
                                    Edit
                                </button>
                                <form action="{{ route('courts.destroy', $court->id) }}" method="POST" onsubmit="return confirm('SURE_TO_DELETE?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 border border-zinc-700 hover:border-red-500 text-red-500 rounded transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" x-cloak>
            <div class="bg-zinc-950 border border-zinc-800 p-8 rounded-3xl w-full max-w-md shadow-2xl overflow-y-auto max-h-screen">
                <h3 class="font-neon text-white mb-6 uppercase tracking-widest" x-text="editMode ? 'Edit_Data' : 'Initialize_New_Data'"></h3>

                <form :action="formAction" method="POST">
                    @csrf
                    <input type="hidden" name="currentTab" :value="currentTab">
                    <input type="hidden" name="formAction" :value="formAction">
                    <input type="hidden" name="id" :value="courtData.id">
                    <input type="hidden" name="_method" value="PUT" :disabled="!editMode">

                    <div class="space-y-4 text-xs font-mono">
                        <!-- COURTS FORM -->
                        <template x-if="currentTab === 'courts'">
                            <div>
                                <label class="block text-zinc-500 mb-2 uppercase">Court_Name</label>
                                <input type="text" name="name" x-model="courtData.name" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none" placeholder="Ex: COURT_E">
                            </div>
                        </template>

                        <template x-if="currentTab === 'courts'">
                            <div>
                                <label class="block text-zinc-500 mb-2 uppercase">Status</label>
                                <select name="status" x-model="courtData.status" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none">
                                    <option value="Active">ACTIVE</option>
                                    <option value="Maintenance">MAINTENANCE</option>
                                </select>
                            </div>
                        </template>

                        <template x-if="currentTab === 'courts'">
                            <div>
                                <label class="block text-zinc-500 mb-2 uppercase">Price_Per_Hour (IDR)</label>
                                <input type="number" name="harga" x-model="courtData.harga" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none" required>
                            </div>
                        </template>

                        <!-- JADWAL FORM -->
                        <template x-if="currentTab === 'jadwal'">
                            <div>
                                <label class="block text-zinc-500 mb-2 uppercase">Court_Select</label>
                                <select name="court_id" x-model="courtData.court_id" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none">
                                    <option value="">SELECT_COURT</option>
                                    @foreach($courts as $court)
                                    <option value="{{ $court->id }}">{{ $court->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </template>

                        <template x-if="currentTab === 'jadwal'">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-zinc-500 mb-2 uppercase">Date</label>
                                    <input type="date" name="tanggal" x-model="courtData.tanggal" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none">
                                </div>
                                <div>
                                    <label class="block text-zinc-500 mb-2 uppercase">Status</label>
                                    <select name="status" x-model="courtData.status" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none">
                                        <option value="tersedia">AVAILABLE</option>
                                        <option value="penuh">FULL</option>
                                    </select>
                                </div>
                            </div>
                        </template>

                        <template x-if="currentTab === 'jadwal'">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-zinc-500 mb-2 uppercase">Start_Time</label>
                                    <input type="time" name="jam_mulai" x-model="courtData.jam_mulai" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none">
                                </div>
                                <div>
                                    <label class="block text-zinc-500 mb-2 uppercase">End_Time</label>
                                    <input type="time" name="jam_selesai" x-model="courtData.jam_selesai" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none">
                                </div>
                            </div>
                        </template>

                        <template x-if="currentTab === 'jadwal'">
                            <div>
                                <label class="block text-zinc-500 mb-2 uppercase">Price_Per_Hour (IDR)</label>
                                <input type="number" name="harga" x-model="courtData.harga" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none" required>
                            </div>
                        </template>

                        <!-- BOOKINGS FORM -->
                        <template x-if="currentTab === 'bookings'">
                            <div>
                                <label class="block text-zinc-500 mb-2 uppercase">Customer</label>
                                <select name="user_id" x-model="courtData.user_id" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none">
                                    <option value="">SELECT_CUSTOMER</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </template>

                        <template x-if="currentTab === 'bookings'">
                            <div>
                                <label class="block text-zinc-500 mb-2 uppercase">Court</label>
                                <select name="court_id" x-model="courtData.court_id" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none">
                                    <option value="">SELECT_COURT</option>
                                    @foreach($courts as $court)
                                    <option value="{{ $court->id }}">{{ $court->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </template>

                        <template x-if="currentTab === 'bookings'">
                            <div>
                                <label class="block text-zinc-500 mb-2 uppercase">Date</label>
                                <input type="date" name="date" x-model="courtData.date" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none">
                            </div>
                        </template>

                        <template x-if="currentTab === 'bookings'">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-zinc-500 mb-2 uppercase">Start_Time</label>
                                    <input type="time" name="start_time" x-model="courtData.start_time" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none">
                                </div>
                                <div>
                                    <label class="block text-zinc-500 mb-2 uppercase">End_Time</label>
                                    <input type="time" name="end_time" x-model="courtData.end_time" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none">
                                </div>
                            </div>
                        </template>

                        <template x-if="currentTab === 'bookings'">
                            <div>
                                <label class="block text-zinc-500 mb-2 uppercase">Duration_Hours</label>
                                <input type="number" name="duration_hours" x-model="courtData.duration_hours" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none" min="1">
                            </div>
                        </template>

                        <template x-if="currentTab === 'bookings'">
                            <div>
                                <label class="block text-zinc-500 mb-2 uppercase">Total_Price (IDR)</label>
                                <input type="number" name="total_price" x-model="courtData.total_price" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none" min="0">
                            </div>
                        </template>

                        <template x-if="currentTab === 'bookings'">
                            <div>
                                <label class="block text-zinc-500 mb-2 uppercase">Status</label>
                                <select name="status" x-model="courtData.status" class="w-full bg-zinc-900 border border-zinc-800 p-3 rounded text-white focus:border-[#ccff00] outline-none">
                                    <option value="pending">PENDING</option>
                                    <option value="approved">APPROVED</option>
                                    <option value="rejected">REJECTED</option>
                                </select>
                            </div>
                        </template>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <button type="button" @click="showModal = false" class="flex-1 py-3 border border-zinc-800 rounded text-zinc-500 hover:bg-zinc-900 font-bold">CANCEL</button>
                        <button type="submit" class="flex-1 py-3 bg-[#ccff00] text-black rounded font-bold hover:brightness-110 uppercase tracking-widest" x-text="editMode ? 'Update_Data' : 'Save_Data'"></button>
                    </div>
                </form>
            </div>
        </div>

        <!--untuk styling halaman admin dashboard yang tambah jadwal-->
        <div x-show="currentTab === 'jadwal'" x-transition>
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-neon text-white uppercase italic">System_Schedule_Registry</h2>
                <button @click="
                    editMode = false; 
                    courtData = {id: '', court_id: '', tanggal: '', jam_mulai: '', jam_selesai: '', harga: '', status: 'tersedia' };
                    formAction = '{{ route('jadwal.store') }}';
                    showModal = true;
                " class="px-4 py-2 bg-[#ccff00] text-black text-xs font-bold rounded hover:brightness-110">
                    + ADD_NEW_JADWAL
                </button>
            </div>

            <div class="bg-zinc-900/40 border border-zinc-800 rounded-2xl overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-900 text-zinc-500 uppercase text-[10px] tracking-widest">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Court</th>
                            <th class="p-4">Date</th>
                            <th class="p-4">Time</th>
                            <th class="p-4">Price</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        @foreach($jadwals as $jadwal)
                        <tr class="hover:bg-zinc-800/30 transition">
                            <td class="p-4 font-mono text-zinc-500">#{{ $jadwal->id }}</td>
                            <td class="p-4 text-white font-bold">{{ $jadwal->court->name }}</td>
                            <td class="p-4 uppercase text-[10px] tracking-widest">{{ $jadwal->tanggal }}</td>
                            <td class="p-4 font-mono text-zinc-400">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                            <td class="p-4 text-[#ccff00]">Rp {{ number_format($jadwal->harga) }}</td>
                            <td class="p-4">
                                <span class="px-2 py-1 {{ $jadwal->status == 'tersedia' ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }} text-[10px] rounded font-bold uppercase">
                                    {{ $jadwal->status }}
                                </span>
                            </td>
                            <td class="p-4 flex justify-center space-x-2">
                                <button @click="
                                    editMode = true; 
                                    courtData = {id: '{{ $jadwal->id }}', court_id: '{{ $jadwal->court_id }}', tanggal: '{{ $jadwal->tanggal }}', jam_mulai: '{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}', jam_selesai: '{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}', harga: '{{ $jadwal->harga }}', status: '{{ $jadwal->status }}' };
                                    formAction = '{{ route('jadwal.update', $jadwal->id) }}';
                                    showModal = true;
                                " class="p-2 border border-zinc-700 hover:border-blue-500 text-blue-500 rounded transition">
                                    Edit
                                </button>
                                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('SURE_TO_DELETE?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 border border-zinc-700 hover:border-red-500 text-red-500 rounded transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="currentTab === 'bookings'" x-transition>
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-neon text-white uppercase italic">System_Booking_Registry</h2>
                <button @click="
                    editMode = false; 
                    courtData = {id: '', user_id: '', court_id: '', date: '', start_time: '', end_time: '', duration_hours: '', total_price: '', status: 'pending'};
                    formAction = '{{ route('bookings.store') }}';
                    showModal = true;
                " class="px-4 py-2 bg-[#ccff00] text-black text-xs font-bold rounded hover:brightness-110">
                    + ADD_NEW_BOOKING
                </button>
            </div>

            <div class="bg-zinc-900/40 border border-zinc-800 rounded-2xl overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-900 text-zinc-500 uppercase text-[10px] tracking-widest">
                        <tr>
                            <th class="p-4">Code</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Court</th>
                            <th class="p-4">Date</th>
                            <th class="p-4">Time</th>
                            <th class="p-4">Total Price</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        @foreach($bookings as $booking)
                        <tr class="hover:bg-zinc-800/30 transition">
                            <td class="p-4 font-mono text-zinc-500">#{{ $booking->booking_code }}</td>
                            <td class="p-4 text-white font-bold">{{ $booking->user->name }}</td>
                            <td class="p-4 text-white font-bold">{{ $booking->court->name }}</td>
                            <td class="p-4 uppercase text-[10px] tracking-widest">{{ $booking->date }}</td>
                            <td class="p-4 font-mono text-zinc-400">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                            <td class="p-4 text-[#ccff00]">Rp {{ number_format($booking->total_price) }}</td>
                            <td class="p-4">
                                <span class="px-2 py-1 {{ $booking->status == 'approved' ? 'bg-green-500/10 text-green-500' : ($booking->status == 'rejected' ? 'bg-red-500/10 text-red-500' : 'bg-yellow-500/10 text-yellow-500') }} text-[10px] rounded font-bold uppercase">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="p-4 flex justify-center space-x-2">
                                <button @click="
                                    editMode = true;
                                    courtData = { id: '{{ $booking->id }}', user_id: '{{ $booking->user_id }}', court_id: '{{ $booking->court_id }}', date: '{{ $booking->date }}', start_time: '{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}', end_time: '{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}', duration_hours: '{{ $booking->duration_hours }}', total_price: '{{ $booking->total_price }}', status: '{{ $booking->status }}' };
                                    formAction = '{{ route('bookings.update', $booking->id) }}';
                                    showModal = true;
                                " class="p-2 border border-zinc-700 hover:border-blue-500 text-blue-500 rounded transition">
                                    Edit
                                </button>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('SURE_TO_DELETE?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 border border-zinc-700 hover:border-red-500 text-red-500 rounded transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="currentTab === 'dashboard'" x-transition>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-zinc-900/50 border border-zinc-800 p-6 rounded-2xl shadow-lg">
                    <p class="text-[10px] text-zinc-500 uppercase mb-2">Total_Active_Courts</p>
                    <h3 class="text-3xl font-neon text-white">{{ $courts->where('status', 'Active')->count() }}</h3>
                </div>
                <div class="bg-zinc-900/50 border border-zinc-800 p-6 rounded-2xl shadow-lg">
                    <p class="text-[10px] text-zinc-500 uppercase mb-2">Total_Revenue_Stream</p>
                    <h3 class="text-3xl font-neon text-[#ccff00]">IDR {{ number_format($courts->sum('harga')) }}</h3>
                </div>
                <div class="bg-zinc-900/50 border border-zinc-800 p-6 rounded-2xl shadow-lg border-l-4 border-l-red-500">
                    <p class="text-[10px] text-zinc-500 uppercase mb-2">System_Errors</p>
                    <h3 class="text-3xl font-neon text-white">00</h3>
                </div>
            </div>
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-2xl font-neon text-white uppercase italic tracking-tighter">Admin_Overview_Signal</h2>
            </div>
        </div>

    </main>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }

    .font-neon {
        font-family: 'Orbitron', sans-serif;
    }
</style>
@endsection