@extends('layout.admin.main')

@section('title', 'Danh sách thanh toán')


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
                        <h2>Danh sách thanh toán</h2>
                    </div>
                </div>
                <!-- users -->
                <div class="col-12">
                    <div>
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Số tiền thanh toán</th>
                                    <th>Mã ngân hàng</th>
                                    <th>Mã giao dịch</th>
                                    <th>Loại thẻ</th>
                                    <th>Thông tin đơn hàng</th>
                                    <th>Mã thương hiệu</th>
                                    <th>Chi tiết đơn hàng</th>
                                    <th>Thời gian thanh toán</th>
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
            ajax: "{{ route('admin.vnpay.data') }}",
            "columns": [{
                    data: 'amount'
                },
                {
                    data: 'bank_code'
                },
                {
                    data: 'code'
                },
                {
                    data: 'card_type'
                },
                {
                    data: 'order_info'
                },
                {
                    data: 'tmn_code'
                },
                {
                    data: 'order_id'
                },
                {
                    data: 'created_at'
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
