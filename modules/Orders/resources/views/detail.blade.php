@extends('layout.admin.main')

@section('title', 'Chi tiết đơn hàng')


@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Chi tiết đơn hàng</h2>
                    </div>
                </div>

                <!-- form -->
                <div class="col-12">
                    <form action="" method="POST" class="form">
                        @csrf
                        <div class="col-12 col-md-7 form__content">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form__group">
                                        <label for="" class="form__lable">Tên khách hàng</label>
                                        <input disabled value="{{ $order->customers->name }}" type="text" name="name"
                                            class="title form__input" placeholder="Tên danh mục...">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form__group">
                                        <label for="" class="form__lable">Tổng tiền</label>
                                        <input disabled
                                            value="{{ number_format($order->total_amount, 0, '', '.') . ' VNĐ' }}"
                                            type="text" name="name" class="title form__input"
                                            placeholder="Tên danh mục...">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form__group">
                                        <label for="" class="form__lable">Ngày hết hạn</label>
                                        <input disabled value="{{ $order->expiry_date }}" type="date" name="name"
                                            class="title form__input" placeholder="Tên danh mục...">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form__group">
                                        <label for="" class="form__lable">Ngày đặt</label>
                                        <input disabled value="{{ $order->created_at }}" type="text" name="name"
                                            class="title form__input" placeholder="Tên danh mục...">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="" class="form__lable">Chế độ xem</label>
                                    @foreach (json_decode($order->packages->powers) as $value)
                                        <div class="main__table-text main__table-text--green"><span><i
                                                    class="icon ion-ios-checkmark"></i> Chất lượng
                                                {{ $value }}</span></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end form -->
            </div>
        </div>
    </main>
@endsection
