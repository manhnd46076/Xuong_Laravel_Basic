@extends('master')
@section('title')
    Thêm mới
@endsection
@section('content')
    <h1>Thêm mới nhân viên</h1>

    @if (session()->has('success') && !session()->get('success'))
        {{-- có tồn tại không, và session['success'] phải là false --}}
        <div class="alert alert-danger">
            <ul>
                <li>{{ session()->get('error') }}</li>
            </ul>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">First Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="first_name" id="inputName"  value="{{ old('first_name') }}" placeholder="Họ" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Last Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="last_name" id="inputName"  value="{{ old('last_name') }}" placeholder="Tên" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="inputName"  value="{{ old('email') }}" placeholder="Email" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Phone</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="phone" id="inputName"  value="{{ old('phone') }}" placeholder="SDT" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Ngày sinh</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="date_of_birth" id="inputName"
                         value="{{ old('date_of_birth') }}" placeholder="Sinh nhật" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Ngày thuê</label>
                <div class="col-8">
                    <input type="datetime" class="form-control" name="hire_date" id="inputName"  value="{{ old('hire_date') }}" placeholder="Ngày kí HĐ" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Lương</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="salary" id="inputName"  value="{{ old('salary') }}" placeholder="Nguồn sống" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="is_active" class="col-4 col-form-label">Trạng thái</label>
                <div class="col-8">
                    <input type="checkbox" value="1" class="form-checkbox" name="is_active" id="is_active"   placeholder="Trạng thái" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Mã phòng ban</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="department_id" id="inputName"
                         value="{{ old('department_id') }}" placeholder="Mã phòng ban" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Mã quản lý</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="manager_id" id="inputName"  value="{{ old('manager_id') }}" placeholder="Mã xếp" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Địa chỉ</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="address" id="inputName"  value="{{ old('address') }}" placeholder="In tư" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Ảnh đại diện </label>
                <div class="col-8">
                    <input type="file" class="form-control" name="profile_picture" id="inputName"
                          placeholder="Name" />
                </div>
            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>


        </form>
    </div>
@endsection
