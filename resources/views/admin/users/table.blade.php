<div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead class="bg-primary text-white">
            <tr>
                <th width="5%" class="ps-4 text-white">No</th>
                <th class="text-white">Nama</th>
                <th class="text-white">Email</th>
                @if($type === 'dokter')
                    <th class="text-white">Spesialis</th>
                @elseif($type === 'pasien')
                    <th class="text-white">No. RM</th>
                    <th class="text-white">Jenis Kelamin</th>
                @endif
                <th width="15%" class="pe-4 text-end text-white">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold" 
                                 style="width: 32px; height: 32px; background-color: #FFDFEF; color: #AA60C8;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <span class="fw-medium">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="text-muted">{{ $user->email }}</td>
                    
                    @if($type === 'dokter')
                        <td><span class="badge" style="background-color: #EABDE6; color: #AA60C8;">{{ optional($user->dokter)->spesialis ?? '-' }}</span></td>
                    @elseif($type === 'pasien')
                        <td><span class="badge" style="background-color: #FFDFEF; color: #AA60C8;">{{ optional($user->pasien)->no_rm ?? '-' }}</span></td>
                        <td>{{ optional($user->pasien)->jenis_kelamin ?? '-' }}</td>
                    @endif
                    
                    <td class="pe-4 text-end">
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $type === 'dokter' || $type === 'pasien' ? ($type === 'pasien' ? 6 : 5) : 4 }}" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                        Tidak ada data {{ $type }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
