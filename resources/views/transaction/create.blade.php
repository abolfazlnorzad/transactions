@extends('layouts.app')

@section('main')
    <div class="container-fluid ">
        <div class="col-10  mx-auto">
            <div class="card card-primary m-5">
                <div class="card-header">
                    <h3 class="card-title">فرم ایجاد تراکنش ها </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form
                    enctype="multipart/form-data"
                    role="form" method="post" action="{{route('transaction.store')}}">
                    @csrf


                    <div class="card-body">

                        <div class="form-group">
                            <label>انتخاب تاریخ:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                                </div>
                                <input id="date" name="date" class=" form-control  persian-digit-example"/>
                            </div>
                            <!-- /.input group -->
                        </div>


                        <div class="form-group">
                            <label>دسته بندی را انتخاب کنید</label>
                            <select name="category_id" class="form-control">
                                <option value=""> انتخاب کنید . . .</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>نوع تراکنش را انتخاب کنید</label>
                            <select name="status" class="form-control">
                                <option value=""> انتخاب کنید . . .</option>
                                <option value="withdraw"> برداشت</option>
                                <option value="deposit"> واریز</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputprice">مبلغ :</label>
                            <input type="text" name="price" class="form-control" id="exampleInputprice"
                                   placeholder="مبلغ به تومان">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputcart">کارت :</label>
                            <input type="text" name="cart" class="form-control" id="exampleInputcart"
                                   placeholder="کارت">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputdes">توضیحات (اختیاری)</label>
                            <textarea name="description" class="form-control" id="exampleInputdes"
                                      placeholder="توضیحات دسته بندری را وارد کنید ">
                           </textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">ارسال فایل</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">انتخاب فایل</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">ثبت تراکنش جدید</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="/assets/persianDatePicker/js/persianDatepicker.min.js"></script>
    <script>
        $("#date").persianDatepicker({
            formatDate: "YYYY/0M/0D",
        });
    </script>
@endsection
@section('head')
    <link rel="stylesheet" href="/assets/persianDatePicker/css/persianDatepicker-default.css">
@endsection
