@extends('master')
@section('title')
    Chỉnh sửa nhân viên:{{ $employee->last_name }}
@endsection
@section('content')
    <h1>Cập nhật nhân viên</h1>

    @if (session()->has('success') && !session()->get('success'))
        {{-- có tồn tại không, và session['success'] phải là false --}}
        <div class="alert alert-danger">
            <ul>
                <li>{{ session()->get('error') }}</li>
            </ul>
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
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <form method="POST" action="{{ route('employees.update',$employee) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT');
            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">First Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="first_name" id="inputName"
                        value="{{ $employee->first_name }}" placeholder="Họ" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Last Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="last_name" id="inputName"
                        value="{{ $employee->last_name }}" placeholder="Tên" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="inputName" value="{{ $employee->email }}"
                        placeholder="Email" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Phone</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="phone" id="inputName" value="{{ $employee->phone }}"
                        placeholder="SDT" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Ngày sinh</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="date_of_birth" id="inputName"
                        value="{{ $employee->date_of_birth }}" placeholder="Sinh nhật" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Ngày thuê</label>
                <div class="col-8">
                    <input type="datetime" class="form-control" name="hire_date" id="inputName"
                        value="{{ $employee->hire_date }}" placeholder="Ngày kí HĐ" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Lương</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="salary" id="inputName" value="{{ $employee->salary }}"
                        placeholder="Nguồn sống" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="is_active" class="col-4 col-form-label">Trạng thái</label>
                <div class="col-8">
                    <input
                    @checked($employee->is_active)
                    type="checkbox" value="1" class="form-checkbox" name="is_active" id="is_active"
                        placeholder="Trạng thái" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Mã phòng ban</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="department_id" id="inputName"
                        value="{{ $employee->department_id }}" placeholder="Mã phòng ban" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Mã quản lý</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="manager_id" id="inputName"
                        value="{{ $employee->manager_id }}" placeholder="Mã xếp" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Địa chỉ</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="address" id="inputName"
                        value="{{ $employee->address }}" placeholder="In tư" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputName" class="col-4 col-form-label">Ảnh đại diện </label>
                <div class="col-8">
                    <input type="file" class="form-control" name="profile_picture" id="inputName"
                        placeholder="Name" />
                        @if ($employee->profile_picture)
                            <div>
                                <img src="{{Storage::url($employee->profile_picture)}}" alt="" width="100px">
                            </div>
                        @endif
                </div>
            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </div>


        </form>
    </div>
@endsection
