@extends('layout.admin.main')

@section('title', 'Danh sách nhóm')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                @if (session('mess'))
                    <div class="alert">
                        {{ session('mess') }}
                    </div>
                @endif
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Danh sách nhóm</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('admin.roles.add') }}" class="form__btn mb-3">Danh sách</a>
                        </div>
                    </div>
                </div>
                <!-- users -->
                <div class="col-12">
                    <div>
                        <form action="" method="POST">
                            @csrf

                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;">Module</th>
                                        <th>Quyền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modules as $item)
                                        <tr>
                                            <td>
                                                {{ $item->title }}
                                            </td>
                                            <td>
                                                <div class="sign__group--checkbox">
                                                    @foreach ($roleListArr as $key => $value)
                                                        <input {{ isRole($roleArr, $item->name, $key) ? 'checked' : false }}
                                                            id="{{ $item->name }}_{{ $key }}"
                                                            value="{{ $key }}" type="checkbox"
                                                            name="role[{{ $item->name }}][]">
                                                        <label style="margin-right: 100px"
                                                            for="{{ $item->name }}_{{ $key }}">{{ $value }}</label>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="sign__group--checkbox my-3">
                                <input {{ isRole($roleArr, 'permissions', 'permissions') ? 'checked' : false }}
                                    type="checkbox" value="permissions" name="role[permissions][]" id="permissions">
                                <label for="permissions">Được phép phân quyền</label>
                            </div>

                            <button type="submit" class="form__btn">Phân quyền</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


@section('scripts')
    <style>
        .dataTables_filter {
            display: none;
        }
    </style>
    <script>
        new DataTable('#myTable', {
            "language": {
                "decimal": "",
                "emptyTable": "Không có dữ liệu nào trong bảng",
                "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                "infoEmpty": "Hiển thị 0 đến 0 của 0 mục",
                "infoFiltered": "(được lọc từ _MAX_ tổng số mục)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Hiển thị _MENU_ mục",
                "loadingRecords": "Đang tải...",
                "processing": "",
                "search": "Tìm kiếm:",
                "zeroRecords": "Không tìm thấy bản ghi phù hợp",
                "paginate": {
                    "first": "Đầu tiên",
                    "last": "Cuối cùng",
                    "next": "Tiếp theo",
                    "previous": "Trước đó"
                },
                "aria": {
                    "sortAscending": ": kích hoạt để sắp xếp cột theo thứ tự tăng dần",
                    "sortDescending": ": kích hoạt để sắp xếp cột theo thứ tự giảm dần"
                }
            }

        });
    </script>
@endsection
