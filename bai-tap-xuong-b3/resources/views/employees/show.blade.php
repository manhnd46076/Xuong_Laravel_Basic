@extends('master')
@section('title')
    Chi tiết nhân viên:{{ $employee->last_name }}
@endsection
@section('content')
    <h1> Chi tiết nhân viên:{{ $employee->last_name }}
    </h1>

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Tên trường</th>
                    <th scope="col">Giá trị</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($employee->toArray() as $key => $item)
                    <tr class="">
                        <td scope="row">{{ strtoupper($key) }}</td>
                        <td>
                            @php
                                switch ($key) {
                                    case 'profile_picture':
                                        $url = Storage::url($item);
                                        echo "<img src='$url' width='100px'>";
                                        break;

                                    case 'is_active':
                                        $url = Storage::url($item);
                                        echo $item
                                            ? '<span class="badge bg-primary">Yes</span>'
                                            : '<span class="badge bg-danger">No</span>';
                                        break;
                                    default:
                                        echo $item;
                                        break;
                                }
                            @endphp
                        </td>
                       
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
