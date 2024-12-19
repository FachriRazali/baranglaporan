@extends('layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/masuk.css') }}">
@endsection

@section('content')
<div class="sidebar">
    <div class="profile">
        <div class="photo">
        
        </div>
        <div class="name">
            <h1>Admin Dashboard</h1>
            <h3>{{ Auth::guard('admin')->user()->name }}</h3>
        </div>
    </div>

  <div class="list">
        <img src="{{ asset('img/list.png') }}" class="icon" />
        <a href="{{ route('employees.index') }}">Data Karyawan</a>
    </div>

    <div class="list">
        <img src="{{ asset('img/list.png') }}" class="icon" />
        <a href="{{ route('barang.index') }}">Data Barang</a>
    </div>

    <div class="list">
        <img src="{{ asset('img/list.png') }}" class="icon" />
        <a href="{{ route('peminjaman.index') }}">Laporan Peminjaman Barang</a>
    </div>

    <div class="list">
        <img src="{{ asset('img/list.png') }}" class="icon" />
        <a href="{{ route('pengajuan.index') }}">Pengajuan Peminjaman Barang</a>
    </div>

    <div class="list">
        <img src="{{ asset('img/list.png') }}" class="icon" />
        <a href="{{ route('perizinan.create') }}">Perizinan Barang</a>
    </div>
</div>

</div>

<div class="main">
    <h1>Admin Data</h1>
    <div class="table-rekap">
        <table id="adminTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
      
        </table>
    </div>

    <form method="POST" action="{{ route('admin.logout') }}" style="margin-top: 20px;">
        @csrf
        <button type="submit" class="btn btn-warning">Log Out</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $("#adminTable").DataTable();
    });
</script>
@endsection


