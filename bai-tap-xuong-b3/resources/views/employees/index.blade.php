@extends('master')
@section('title')
    Danh nhân viên
@endsection
@section('content')
    <h1>Chào các bé nhân viên cute</h1>

    @if (session()->has('success') && !session()->get('success'))
        {{-- có tồn tại không, và session['success'] phải là false --}}
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success') && session()->get('success'))
        {{-- có tồn tại không, và session['success'] phải là false --}}
        <div class="alert alert-info">
            Thao tác thành công
        </div>
    @endif
    {{-- Thông báo --}}
    <a href="{{ route('employees.create') }}" class="btn btn-info my-2">Thêm mới</a>
    <div class="table-responsive table-bordered">
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Birth day</th>
                    <th scope="col">rental date</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Operating status</th>
                    <th scope="col">Department ID</th>
                    <th scope="col">Manager ID</th>
                    <th scope="col">Address</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="">
                        <td scope="row">{{ $item->id }}</td>
                        <td>{{ $item->first_name }}</td>
                        <td>{{ $item->last_name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->date_of_birth }}</td>
                        <td>{{ $item->hire_date }}</td>
                        <td>{{ $item->salary }}</td>
                        <td>

                            @if ($item->is_active)
                                <span class="badge bg-primary">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>{{ $item->department_id }}</td>
                        <td>{{ $item->manager_id }}</td>
                        <td>{{ $item->address }}</td>
                        <td>
                            @if ($item->profile_picture)
                                <div>
                                    <img src="{{ Storage::url($item->profile_picture) }}" alt="" width="100px">
                                </div>
                            @endif
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('employees.show', $item) }}">Show</a>
                            <a class="btn btn-warning" href="{{ route('employees.edit', $item) }}">Edit</a>
                            <form action="{{ route('employees.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Xác nhận xóa')" type="button"
                                    class="btn btn-danger">
                                    XM
                                </button>
                            </form>

                            <form action="{{ route('employees.forceDestroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Xác nhận xóa')" type="button"
                                    class="btn btn-dark">
                                    Xc
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
        {{ $data->links() }}
    </div>
@endsection
