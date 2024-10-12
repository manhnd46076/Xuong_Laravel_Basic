@extends('master')
@section('title')
    Danh sách khách hàng
@endsection
@section('content')
    <h1>Danh sách khách hàng</h1>

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

    <br>
    <a class="btn btn-primary" href="{{ route('customers.create') }}">Create</a>
    <div class="table-responsive table-bordered ">
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Is active</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $customer)
                    {{-- @dd($customer->); --}}
                    <tr class="">
                        <td scope="row">{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            @if ($customer->avatar)
                                <div>
                                    <img src="{{ Storage::url($customer->avatar) }}" alt="" width="100px">
                                </div>
                            @endif

                        </td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>
                            @if ($customer->is_active)
                                <span class="badge bg-primary">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>{{ $customer->created_at }}</td>
                        <td>{{ $customer->updated_at }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('customers.show', $customer) }}">Show</a>
                            <a class="btn btn-warning" href="{{ route('customers.edit', $customer) }}">Edit</a>
                            <form action="{{ route('customers.destroy', $customer) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Xác nhận xóa ?')" class="btn btn-danger">
                                    XM
                                </button>
                            </form>
                            {{-- xóa cứng --}}
                            <form action="{{ route('customers.forceDestroy', $customer) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Xác nhận xóa ?')" class="btn btn-dark">
                                    XC
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
