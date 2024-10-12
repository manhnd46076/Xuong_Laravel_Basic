@extends('master')
@section('title')
    Cập nhật
@endsection
@section('content')
    <h1>Cập nhật khách: {{ $customer->name }}</h1>

    @if (session()->has('success') && !session()->get('success'))
        {{-- có tồn tại không, và session['success'] phải là false --}}
        <div class="alert alert-danger">

            <li>{{ session()->get('error') }}</li>

        </div>
    @endif

    {{-- Thành công --}}
    @if (session()->has('success') && session()->get('success'))
        {{-- có tồn tại không, và session['success'] phải là false --}}
        <div class="alert alert-info">
            Thao tác thành công
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </div>
    @endif
    <div class="container">
        <form method="POST" action="{{ route('customers.update', $customer) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT');
            <div class="mb-3 row">
                <label for="name" class="col-4 col-form-label">Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                        value="{{ $customer->name }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="address" class="col-4 col-form-label">Address</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="address" id="address" placeholder="Address"
                        value="{{ $customer->address }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="phone" class="col-4 col-form-label">Phone</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone"
                        value="{{ $customer->phone }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                        value="{{ $customer->email }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="is_active" class="col-4 col-form-label">Is active</label>
                <div class="col-8">
                    <input type="checkbox"
                     @checked($customer->is_active) 
                     value="1" class="form-checkbox"
                     name="is_active" id="is_active" placeholder="Is active" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="avatar" class="col-4 col-form-label">Avatar</label>
                <div class="col-8">
                    
                    <input type="file" class="form-control" name="avatar" id="avatar" placeholder="Avatar" />
                    @if ($customer->avatar)
                        <div>
                            <img src="{{ Storage::url($customer->avatar) }}" alt="" width="100px">
                        </div>
                    @endif
                </div>



            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
    </div>
    </form>
    </div>
@endsection
