<div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead>
            <tr style="background-color: #FFDFEF; color: #AA60C8;">
                <th width="5%" class="ps-4 text-center">No</th>
                <th>Nama</th>
                <th>Email</th>
                @if($type === 'dokter')
                    <th>Spesialis</th>
                @elseif($type === 'pasien')
                    <th>No. RM</th>
                    <th>Jenis Kelamin</th>
                @endif
                <th width="15%" class="pe-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td class="ps-4 text-center text-muted align-middle">{{ $index + 1 }}</td>
                    <td class="align-middle">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                                 style="width: 32px; height: 32px; background-color: #FFF0F5; color: #AA60C8; border: 1px solid #EABDE6;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <span class="fw-medium text-dark">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="text-muted align-middle">{{ $user->email }}</td>
                    
                    @if($type === 'dokter')
                        <td class="align-middle"><span class="badge rounded-pill fw-normal" style="background-color: #EABDE6; color: #AA60C8; border: 1px solid #D69ADE;">{{ optional($user->dokter)->spesialis ?? '-' }}</span></td>
                    @elseif($type === 'pasien')
                        <td class="align-middle"><span class="badge rounded-pill fw-normal" style="background-color: #FFF0F5; color: #AA60C8; border: 1px solid #EABDE6;">{{ optional($user->pasien)->no_rm ?? '-' }}</span></td>
                        <td class="align-middle">{{ optional($user->pasien)->jenis_kelamin ?? '-' }}</td>
                    @endif
                    
                    <td class="pe-4 text-center align-middle">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-light text-info shadow-sm" style="border-radius: 8px 0 0 8px; border: 1px solid #eee;" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger shadow-sm" style="border-radius: 0 8px 8px 0; border: 1px solid #eee;" title="Hapus">
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
