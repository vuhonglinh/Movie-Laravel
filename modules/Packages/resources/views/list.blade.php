@extends('layout.admin.main')

@section('title', 'Danh sách gói phim')


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
                        <h2>Danh sách gói phim</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('admin.packages.add') }}" class="form__btn mb-3">Thêm mới</a>
                        </div>
                    </div>
                </div>
                <!-- users -->
                <div class="col-12">
                    <div>
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tên thể loại</th>
                                    <th>Gía</th>
                                    <th>Thời gian sử dụng</th>
                                    <th>Quyền</th>
                                    <th>Ngày tạo</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


@section('scripts')
    <script>
        new DataTable('#myTable', {
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.packages.data') }}",
            "columns": [{
                    data: 'name'
                },
                {
                    data: 'price'
                },
                {
                    data: 'duration'
                },
                {
                    data: 'powers'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'edit'
                },
                {
                    data: 'delete'
                },
            ],
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
