@extends('layouts.app')

@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">دسته بندی ها </h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <tbody><tr>
                    <th>#</th>
                    <th>نام دسته بندی</th>
                    <th>نام کاربر ایجاد کننده</th>
                    <th>توضیحات</th>
                    <th>تاریخ</th>
                </tr>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->user->email}}</td>
                    <td>{{$category->description}}</td>
                    <td>{{jdate($category->created_at)->format('Y/m/d')}}</td>

                </tr>
                @endforeach

                </tbody></table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
