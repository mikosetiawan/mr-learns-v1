@extends('layouts.app')
@section('content')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Dashboard</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Dashboard
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row"> <!--begin::Col-->
                    <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 1-->
                        <div class="small-box text-bg-primary">
                            <div class="inner">
                                <h3>{{ $mapel }}</h3>
                                <p>Mata Pelajaran</p>
                            </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M12 2a1 1 0 00-1 1v18a1 1 0 001 1h9a1 1 0 001-1V8.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0015.586 2H12zm1 2h2v3a1 1 0 001 1h3v12h-6V4zm-8 0a1 1 0 00-1 1v16a1 1 0 001 1h6v-2H5V5h6V3H5z" />
                            </svg>
                            <a href="#"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i> </a>
                        </div> <!--end::Small Box Widget 1-->
                    </div> <!--end::Col-->
                    <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 2-->
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                <h3>{{ $kelas }}</h3>
                                <p>Kelas</p>
                            </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M12 12a5 5 0 100-10 5 5 0 000 10zm6-1a5 5 0 100-10 5 5 0 000 10zm-12 1a5 5 0 100-10 5 5 0 000 10zm0 2c-2.2 0-4 1.8-4 4v1h8v-1c0-2.2-1.8-4-4-4zm12 0c-2.2 0-4 1.8-4 4v1h8v-1c0-2.2-1.8-4-4-4z" />
                            </svg>
                            <a href="#"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i> </a>
                        </div> <!--end::Small Box Widget 2-->
                    </div> <!--end::Col-->
                    <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 3-->
                        <div class="small-box text-bg-warning">
                            <div class="inner">
                                <h3>{{ $siswa }}</h3>
                                <p>Siswa</p>
                            </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M12 12c2.67 0 8 1.34 8 4v3h-16v-3c0-2.66 5.33-4 8-4zm0-2a4 4 0 100-8 4 4 0 000 8z" />
                            </svg>
                            <a href="#"
                                class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i> </a>
                        </div> <!--end::Small Box Widget 3-->
                    </div> <!--end::Col-->
                    <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 4-->
                        <div class="small-box text-bg-danger">
                            <div class="inner">
                                <h3>{{ $jml_nilai }} <sup class="fs-5">(rata-rata)</sup></h3>
                                <p>Nilai</p>
                            </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M4 22h4v-8H4v8zm6 0h4V4h-4v18zm6 0h4v-12h-4v12z" />
                            </svg>
                            <a href="#"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i> </a>
                        </div> <!--end::Small Box Widget 4-->
                    </div> <!--end::Col-->
                </div> <!--end::Row--> <!--begin::Row-->
                <div class="row"> <!-- Start col -->
                    <div class="col-lg-12 connectedSortable">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Grafich Nilai</h3>
                            </div>
                            <div class="card-body">
                                <div id="revenue-chart"></div>
                            </div>
                        </div> <!-- /.card -->
                        <!-- DIRECT CHAT -->
                        {{-- <div class="card direct-chat direct-chat-primary mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Direct Chat</h3>
                                <div class="card-tools"> <span title="3 New Messages" class="badge text-bg-primary">
                                        3
                                    </span> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse"
                                            class="bi bi-dash-lg"></i> </button> <button type="button" class="btn btn-tool"
                                        title="Contacts" data-lte-toggle="chat-pane"> <i class="bi bi-chat-text-fill"></i>
                                    </button> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i
                                            class="bi bi-x-lg"></i>
                                    </button> </div>
                            </div> <!-- /.card-header -->
                            <div class="card-body"> <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages"> <!-- Message. Default to the start -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix"> <span class="direct-chat-name float-start">
                                                Alexander Pierce
                                            </span> <span class="direct-chat-timestamp float-end">
                                                23 Jan 2:00 pm
                                            </span> </div> <!-- /.direct-chat-infos --> <img class="direct-chat-img"
                                            src="{{ asset('') }}assets/img/user1-128x128.jpg"
                                            alt="message user image"> <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            Is this template really for free? That's unbelievable!
                                        </div> <!-- /.direct-chat-text -->
                                    </div> <!-- /.direct-chat-msg --> <!-- Message to the end -->
                                    <div class="direct-chat-msg end">
                                        <div class="direct-chat-infos clearfix"> <span class="direct-chat-name float-end">
                                                Sarah Bullock
                                            </span> <span class="direct-chat-timestamp float-start">
                                                23 Jan 2:05 pm
                                            </span> </div> <!-- /.direct-chat-infos --> <img class="direct-chat-img"
                                            src="{{ asset('') }}assets/img/user3-128x128.jpg"
                                            alt="message user image"> <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            You better believe it!
                                        </div> <!-- /.direct-chat-text -->
                                    </div> <!-- /.direct-chat-msg --> <!-- Message. Default to the start -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix"> <span
                                                class="direct-chat-name float-start">
                                                Alexander Pierce
                                            </span> <span class="direct-chat-timestamp float-end">
                                                23 Jan 5:37 pm
                                            </span> </div> <!-- /.direct-chat-infos --> <img class="direct-chat-img"
                                            src="{{ asset('') }}assets/img/user1-128x128.jpg"
                                            alt="message user image"> <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            Working with AdminLTE on a great new app! Wanna join?
                                        </div> <!-- /.direct-chat-text -->
                                    </div> <!-- /.direct-chat-msg --> <!-- Message to the end -->
                                    <div class="direct-chat-msg end">
                                        <div class="direct-chat-infos clearfix"> <span class="direct-chat-name float-end">
                                                Sarah Bullock
                                            </span> <span class="direct-chat-timestamp float-start">
                                                23 Jan 6:10 pm
                                            </span> </div> <!-- /.direct-chat-infos --> <img class="direct-chat-img"
                                            src="{{ asset('') }}assets/img/user3-128x128.jpg"
                                            alt="message user image"> <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">I would love to.</div>
                                        <!-- /.direct-chat-text -->
                                    </div> <!-- /.direct-chat-msg -->
                                </div> <!-- /.direct-chat-messages--> <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                    <ul class="contacts-list">
                                        <li> <a href="#"> <img class="contacts-list-img"
                                                    src="{{ asset('') }}assets/img/user1-128x128.jpg"
                                                    alt="User Avatar">
                                                <div class="contacts-list-info"> <span class="contacts-list-name">
                                                        Count Dracula
                                                        <small class="contacts-list-date float-end">
                                                            2/28/2023
                                                        </small> </span> <span class="contacts-list-msg">
                                                        How have you been? I was...
                                                    </span> </div> <!-- /.contacts-list-info -->
                                            </a> </li> <!-- End Contact Item -->
                                        <li> <a href="#"> <img class="contacts-list-img"
                                                    src="{{ asset('') }}assets/img/user7-128x128.jpg"
                                                    alt="User Avatar">
                                                <div class="contacts-list-info"> <span class="contacts-list-name">
                                                        Sarah Doe
                                                        <small class="contacts-list-date float-end">
                                                            2/23/2023
                                                        </small> </span> <span class="contacts-list-msg">
                                                        I will be waiting for...
                                                    </span> </div> <!-- /.contacts-list-info -->
                                            </a> </li> <!-- End Contact Item -->
                                        <li> <a href="#"> <img class="contacts-list-img"
                                                    src="{{ asset('') }}assets/img/user3-128x128.jpg"
                                                    alt="User Avatar">
                                                <div class="contacts-list-info"> <span class="contacts-list-name">
                                                        Nadia Jolie
                                                        <small class="contacts-list-date float-end">
                                                            2/20/2023
                                                        </small> </span> <span class="contacts-list-msg">
                                                        I'll call you back at...
                                                    </span> </div> <!-- /.contacts-list-info -->
                                            </a> </li> <!-- End Contact Item -->
                                        <li> <a href="#"> <img class="contacts-list-img"
                                                    src="{{ asset('') }}assets/img/user5-128x128.jpg"
                                                    alt="User Avatar">
                                                <div class="contacts-list-info"> <span class="contacts-list-name">
                                                        Nora S. Vans
                                                        <small class="contacts-list-date float-end">
                                                            2/10/2023
                                                        </small> </span> <span class="contacts-list-msg">
                                                        Where is your new...
                                                    </span> </div> <!-- /.contacts-list-info -->
                                            </a> </li> <!-- End Contact Item -->
                                        <li> <a href="#"> <img class="contacts-list-img"
                                                    src="{{ asset('') }}assets/img/user6-128x128.jpg"
                                                    alt="User Avatar">
                                                <div class="contacts-list-info"> <span class="contacts-list-name">
                                                        John K.
                                                        <small class="contacts-list-date float-end">
                                                            1/27/2023
                                                        </small> </span> <span class="contacts-list-msg">
                                                        Can I take a look at...
                                                    </span> </div> <!-- /.contacts-list-info -->
                                            </a> </li> <!-- End Contact Item -->
                                        <li> <a href="#"> <img class="contacts-list-img"
                                                    src="{{ asset('') }}assets/img/user8-128x128.jpg"
                                                    alt="User Avatar">
                                                <div class="contacts-list-info"> <span class="contacts-list-name">
                                                        Kenneth M.
                                                        <small class="contacts-list-date float-end">
                                                            1/4/2023
                                                        </small> </span> <span class="contacts-list-msg">
                                                        Never mind I found...
                                                    </span> </div> <!-- /.contacts-list-info -->
                                            </a> </li> <!-- End Contact Item -->
                                    </ul> <!-- /.contacts-list -->
                                </div> <!-- /.direct-chat-pane -->
                            </div> <!-- /.card-body -->
                            <div class="card-footer">
                                <form action="#" method="post">
                                    <div class="input-group"> <input type="text" name="message"
                                            placeholder="Type Message ..." class="form-control"> <span
                                            class="input-group-append"> <button type="button" class="btn btn-primary">
                                                Send
                                            </button> </span> </div>
                                </form>
                            </div> <!-- /.card-footer-->
                        </div> --}}
                        <!-- /.direct-chat -->
                    </div> <!-- /.Start col --> <!-- Start col -->
                    {{-- <div class="col-lg-5 connectedSortable">
                        <div class="card text-white bg-primary bg-gradient border-primary mb-4">
                            <div class="card-header border-0">
                                <h3 class="card-title">Grafich Value</h3>
                                <div class="card-tools"> <button type="button" class="btn btn-primary btn-sm"
                                        data-lte-toggle="card-collapse"> <i data-lte-icon="expand"
                                            class="bi bi-plus-lg"></i> <i data-lte-icon="collapse"
                                            class="bi bi-dash-lg"></i> </button> </div>
                            </div>
                            <div class="card-body">
                                <div id="world-map" style="height: 220px"></div>
                            </div>
                            <div class="card-footer border-0"> <!--begin::Row-->
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div id="sparkline-1" class="text-dark"></div>
                                        <div class="text-white">Visitors</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div id="sparkline-2" class="text-dark"></div>
                                        <div class="text-white">Online</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div id="sparkline-3" class="text-dark"></div>
                                        <div class="text-white">Sales</div>
                                    </div>
                                </div> <!--end::Row-->
                            </div>
                        </div>
                    </div>  --}}
                    <!-- /.Start col -->
                </div> <!-- /.row (main row) -->
            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection



{{-- @push('scripts')
    <script>
        // Sales Chart Configuration
        const nilaiChartConfig = {
            series: [{
                name: "Digital Goods",
                data: [28, 48, 40, 19, 86, 27, 90]
            }, {
                name: "Electronics",
                data: [65, 59, 80, 81, 56, 55, 40]
            }],
            chart: {
                height: 300,
                type: "area",
                toolbar: {
                    show: false
                }
            },
            legend: {
                show: false
            },
            colors: ["#0d6efd", "#20c997"],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth"
            },
            xaxis: {
                type: "datetime",
                categories: [
                    "2023-01-01", "2023-02-01", "2023-03-01",
                    "2023-04-01", "2023-05-01", "2023-06-01",
                    "2023-07-01"
                ]
            },
            tooltip: {
                x: {
                    format: "MMMM yyyy"
                }
            }
        };

        // Initialize Charts
        document.addEventListener('DOMContentLoaded', function() {
            // Sales Chart
            if (document.querySelector("#revenue-chart")) {
                const salesChart = new ApexCharts(
                    document.querySelector("#revenue-chart"),
                    nilaiChartConfig
                );
                salesChart.render();
            }

            // World Map
            if (document.querySelector("#world-map")) {
                new jsVectorMap({
                    selector: "#world-map",
                    map: "world"
                });
            }

            // Sparkline Charts
            const sparklineConfig = {
                chart: {
                    type: "area",
                    height: 50,
                    sparkline: {
                        enabled: true
                    }
                },
                stroke: {
                    curve: "straight"
                },
                fill: {
                    opacity: 0.3
                },
                yaxis: {
                    min: 0
                },
                colors: ["#DCE6EC"]
            };

            const sparklineData = {
                "sparkline-1": [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
                "sparkline-2": [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
                "sparkline-3": [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21]
            };

            Object.entries(sparklineData).forEach(([id, data]) => {
                const element = document.querySelector(`#${id}`);
                if (element) {
                    const chart = new ApexCharts(element, {
                        ...sparklineConfig,
                        series: [{
                            data
                        }]
                    });
                    chart.render();
                }
            });
        });
    </script>
@endpush --}}


@push('scripts')
    <script>
        // Prepare data for the chart
        const chartData = @json($chartData);

        const nilaiChartConfig = {
            series: [{
                name: "Average Nilai",
                data: Object.values(chartData) // Get average nilai values
            }],
            chart: {
                height: 300,
                type: "area",
                toolbar: {
                    show: false
                }
            },
            legend: {
                show: false
            },
            colors: ["#0d6efd"], // Customize color as needed
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth"
            },
            xaxis: {
                categories: Object.keys(chartData), // Mapel IDs as categories (customize as needed)
            },
            tooltip: {
                x: {
                    format: "MMMM yyyy"
                }
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector("#revenue-chart")) {
                const salesChart = new ApexCharts(
                    document.querySelector("#revenue-chart"),
                    nilaiChartConfig
                );
                salesChart.render();
            }
        });
    </script>
@endpush
