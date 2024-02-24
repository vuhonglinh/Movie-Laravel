@extends('layout.admin.main')

@section('title', 'Phân quyền cho gói')


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
                        <h2>Phân quyền cho gói</h2>
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
                                        <th style="width: 40%;">Quyền</th>
                                        <th>Quyền hạn</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>Chất lượng</td>
                                        <td>
                                            <div class="sign__group--checkbox">
                                                    <input id="quality1" {{ isPower($powers, 'SD') ? 'checked' : false }}
                                                        value="SD" type="checkbox" name="quality[]">
                                                    <label style="margin-right: 100px" for="quality1">SD</label>

                                                    <input id="quality2" {{ isPower($powers, 'HD') ? 'checked' : false }}
                                                        value="HD" type="checkbox" name="quality[]">
                                                    <label style="margin-right: 100px" for="quality2">HD</label>

                                                    <input id="quality3"
                                                        {{ isPower($powers, 'FULL HD') ? 'checked' : false }} value="FULL HD"
                                                        type="checkbox" name="quality[]">
                                                    <label style="margin-right: 100px" for="quality3">FULL HD</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="form__btn">Lưu</button>
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
@endsection
