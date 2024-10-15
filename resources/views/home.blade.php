@extends('master')

@section('content')
    <div>
        <h3 class="mb-4">Selamat Datang di Nasari Digital</h3>
        <hr/>
        <h4 class="mb-4">Daftar User</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + $users->firstItem() }}</td> <!-- Penomoran berdasarkan pagination -->
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection