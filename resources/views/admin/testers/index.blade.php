@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Testers</h2>
        <a href="{{ route('admin.testers.create') }}" class="btn btn-primary">+ Add Tester</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Variations</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testers as $key => $tester)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $tester->name }}</td>
                        <td>
                            @if($tester->image)
                                <img src="{{ asset('storage/'.$tester->image) }}" width="60" class="rounded">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            @foreach($tester->variations as $variation)
                                <span class="badge bg-info text-dark">
                                    {{ $variation->pack_size }} -
                                    {{ $variation->price }} Rs
                                    @if($variation->discount_price)
                                        <del>{{ $variation->discount_price }} Rs</del>
                                    @endif
                                </span><br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.testers.edit', $tester->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.testers.destroy', $tester->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this tester?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No testers found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
