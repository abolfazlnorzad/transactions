@extends('layouts.app')


@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">تراکنش ها</h3>
        </div>
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="ناریخ: activate to sort column ascending">ناریخ
                                </th>
                                <th class="sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="نوع تراکنش: activate to sort column ascending" aria-sort="descending">نوع تراکنش
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="دسته بندی: activate to sort column ascending">دسته بندی
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="مبلغ: activate to sort column ascending">مبلغ
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="کارت: activate to sort column ascending">کارت
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="فایل پیوست: activate to sort column ascending">فایل پیوست
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="توضیحات: activate to sort column ascending">توضیحات
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                            <tr role="row" class="odd">
                                <td class="">{{jdate($transaction->date)->format('Y/m/d')}}</td>
                                <td class="">{{$transaction->status}}</td>
                                <td class="">{{$transaction->category->name}}</td>
                                <td class="">{{$transaction->price}}</td>
                                <td class="">{{$transaction->cart}}</td>
                                <td class="">
                                    <a href="{{route('download',$transaction->id)}}">دانلود  </a>
                                </td>
                                <td class="">{{$transaction->description}}</td>

                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1"> ناریخ</th>
                                <th rowspan="1" colspan="1">نوع تراکنش</th>
                                <th rowspan="1" colspan="1">دسته بندی </th>
                                <th rowspan="1" colspan="1">مبلغ</th>
                                <th rowspan="1" colspan="1">کارت</th>
                                <th rowspan="1" colspan="1">فایل پیوست</th>
                                <th rowspan="1" colspan="1"> توضیحات</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('js')
    <!-- DataTables -->
    <script src="/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/plugins/datatables/dataTables.bootstrap4.js"></script>
    <!-- SlimScroll -->
    <script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="/plugins/fastclick/fastclick.js"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "language": {
                    "paginate": {
                        "next": "بعدی",
                        "previous" : "قبلی"
                    }
                },
                "info" : false,
            });
            $('#example2').DataTable({
                "language": {
                    "paginate": {
                        "next": "بعدی",
                        "previous" : "قبلی"
                    }
                },
                "info" : false,
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "autoWidth": false
            });
        });
    </script>
@endsection
