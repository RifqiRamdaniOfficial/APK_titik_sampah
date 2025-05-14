<h1>Laporan Titik Sampah</h1>
<style>
    @page {
        size: A4 landscape;
        margin: 20mm;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Image</th>
            <th>Alamat</th>
            <th>RW</th>
            <th>Informasi</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Status</th>
            <th>Penginput</th>
            
            
        </tr>
    </thead>
    <tbody>
        @foreach ($reqs as $req)
        <tr>
            <td>
                @if($req->image)
                    <img src="{{ public_path('storage/' . $req->image) }}" alt="Image" width="100">
                @else
                    No Image
                @endif
            </td>
            <td>{{ $req->addres }}</td>
            <td>{{ $req->region_id }}</td>
            <td>{{ strip_tags($req->information) }}</td>
            <td>{{ $req->latitude }}</td>
            <td>{{ $req->longitude }}</td>
            <td>{{ $req->status }}</td>
            <td>{{ $req->user->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>