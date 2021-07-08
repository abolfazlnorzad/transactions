@extends('layouts.app')

@section('main')

    <div class="container ">
        <div class="col-10 mx-auto ">
            <div class="card card-primary m-5">
                <div class="card-header">
                    <h3 class="card-title">فرم ایجاد دسته بندی</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('category.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputname">نام دسته بندی</label>
                            <input type="text" name="name" class="form-control" id="exampleInputname"
                                   placeholder="نام دسته بندی را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdes">توضیحات (اختیاری)</label>
                            <textarea name="description" class="form-control" id="exampleInputdes"
                                      placeholder="توضیحات دسته بندری را وارد کنید ">
                           </textarea>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">ایجاد دسته بندی جدید</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

