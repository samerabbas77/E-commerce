@extends('admin.layout.layout')
@section('content')
 <section class="content" style="padding: 0.5rem">
     <div class="container-fluid">
               <div class="row">

            <h2>Main Categories</h2>
    <a href="{{ route('admin.main_categories.create') }}" class="btn btn-primary mb-3">Add New</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->main_category_name }}</td>
                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                    <td><a href="{{ route('admin.main_categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a></td>
                    <td>
                        <form method="POST" action="{{ route('admin.main_categories.destroy', $category) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}

</div>
</div>
</div>
@endsection
