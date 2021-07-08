@extends('layouts.app')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- AREA CHART -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">نمودار میله ای</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                       نمودار واریز و برداشت یک سال گذشته
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                            <p class="highcharts-description">

                            </p>
                        </figure>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>

            <div class="col-md-12">
                <!-- AREA CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">نمودار دایره ای</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label>تاریخ مورد نظر را انتخاب کنید</label>
                                <select id="selectMonth" name="month"  class="form-control">

                                    @foreach($yearAndMonth as $date)
                                        <option
                                            value="{{$date['yearAndMonth']}}"


                                            @if(request()->month == null ){{ $loop->last ? 'selected' :''}} @else{{$date[
                                    'yearAndMonth'] === request()->month ? 'selected' : ''}} @endif
                                        > {{ jdate($date['fullDate'])->format('Y/m') }} </option>
                                    @endforeach
                                </select>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-primary">ارسال</button>
                            </div>
                        </form>


                        <figure class="highcharts-figure">
                            <div id="containerPie"></div>
                            <p class="highcharts-description">

                            </p>
                        </figure>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>

            <!-- /.row -->
        </div>
    </div>

        @endsection

        @section('js')

            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/series-label.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>


            <script>
                Highcharts.setOptions({
                    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                        return {
                            radialGradient: {
                                cx: 0.5,
                                cy: 0.3,
                                r: 0.7
                            },
                            stops: [
                                [0, color],
                                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                            ]
                        };
                    })
                });

                Highcharts.chart('container', {
                    title: {
                        text: 'تراکنش های  12 ماه گذشته'
                    },
                    xAxis: {
                        categories: [@foreach($yearAndMonth as $month) '{{ jdate($month['fullDate'])->format('Y-m-d')  }}',  @endforeach]
                    },
                    legend: {
                        rtl: true
                    },
                    tooltip: {
                        useHTML: true,
                        style: {
                            fontSize: '20px',
                            fontFamily: 'tahoma',
                            direction: 'rtl',
                        },
                        formatter: function () {
                            return (this.x ? "تاریخ: " + this.x + "<br>" : "") + "مبلغ: " + this.y
                        }
                    },
                    yAxis: {
                        title: {
                            text: "مبلغ"
                        },
                        labels: {
                            formatter: function () {
                                return this.value + " تومان"
                            }
                        }
                    },
                    labels: {
                        items: [{
                            // html: 'تراکنش های  12 ماه گذشته',
                            style: {
                                left: '50px',
                                top: '18px',
                                color: ( // theme
                                    Highcharts.defaultOptions.title.style &&
                                    Highcharts.defaultOptions.title.style.color
                                ) || 'black'
                            }
                        }]
                    },


                    series: [
                        {
                            type: 'column',
                            name: 'برداشت',
                            color: "green",
                            data: [@foreach($yearAndMonth as $date) {{$repo->howWithdrawInMonth(\Illuminate\Support\Str::afterLast($date['yearAndMonth'],"/"),\Illuminate\Support\Str::beforeLast($date['yearAndMonth'],"/"))}}, @endforeach]
                        },
                        {
                            type: 'column',
                            name: 'واریز',
                            data: [@foreach($yearAndMonth as $date)  {{$repo->howDepositInMonth(\Illuminate\Support\Str::afterLast($date['yearAndMonth'],"/"),\Illuminate\Support\Str::beforeLast($date['yearAndMonth'],"/"))}}, @endforeach]
                        },
                    ]
                });


            </script>

            <script>

                // Build the chart
                Highcharts.chart('containerPie', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'نسبت تراکنش هر دسته بندی در ماه اخیر'
                    },
                    legend: {
                        rtl: true
                    },
                    tooltip: {
                        pointFormat: '<p> {series.name}: <b>{point.percentage:.1f}%</b> </p>',
                        formatter: function () {
                            return (this.x ? "تاریخ: " + this.x + "<br>" : "") + "مبلغ: " + this.y
                        }
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: ' <p> <b>{point.name}</b>: {point.percentage:.1f} % </p>',
                                connectorColor: 'silver'
                            }
                        }
                    },
                    series: [{
                        name: 'Share',
                        data: [
                                @foreach($categories as $category)
                            {
                                name: '{{$category->name}}',
                                y:{{$repo->getPriceForEveryMonth($category,request()->month)}}
                            },
                            @endforeach
                        ]
                    }]
                });
                // .contents().unwrap().wrap('<div/>');

                $('g text tspan tspan tspan').each(function() {
                    $(this).replaceWith("<span>"+$(this).text()+"</span>")
                });

            </script>



        @endsection
        @section('head')
            <style>
                .highcharts-figure, .highcharts-data-table table {
                    min-width: 320px;
                    max-width: 660px;
                    margin: 1em auto;
                }

                .highcharts-data-table table {
                    font-family: Verdana, sans-serif;
                    border-collapse: collapse;
                    border: 1px solid #EBEBEB;
                    margin: 10px auto;
                    text-align: center;
                    width: 100%;
                    max-width: 500px;
                }

                .highcharts-data-table caption {
                    padding: 1em 0;
                    font-size: 1.2em;
                    color: #555;
                }

                .highcharts-data-table th {
                    font-weight: 600;
                    padding: 0.5em;
                }

                .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
                    padding: 0.5em;
                }

                .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
                    background: #f8f8f8;
                }

                .highcharts-data-table tr:hover {
                    background: #f1f7ff;
                }
            </style>
@endsection
