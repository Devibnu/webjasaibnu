@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page', 'Dashboard')

@section('content')
    <div class="row">
        @foreach ($stats as $stat)
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ $stat['label'] }}</p>
                                    <h5 class="font-weight-bolder mb-0">{{ $stat['value'] }}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-{{ $stat['tone'] }} shadow text-center border-radius-md">
                                    <i class="{{ $stat['icon'] }} text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>CMS Readiness</h6>
                    <p class="text-sm mb-0">Current public content sources in this Laravel 13 project.</p>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Area</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Source</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contentAreas as $area)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div>
                                                    <div class="icon icon-shape icon-sm bg-gradient-info shadow text-center border-radius-md me-3">
                                                        <i class="ni ni-app text-white opacity-10"></i>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $area['name'] }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td><p class="text-sm font-weight-bold mb-0">{{ $area['source'] }}</p></td>
                                        <td><span class="badge badge-sm bg-gradient-secondary">{{ $area['status'] }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Admin Foundation</h6>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step"><i class="ni ni-check-bold text-info text-gradient"></i></span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Soft UI assets isolated</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">public/assets/admin</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step"><i class="ni ni-check-bold text-info text-gradient"></i></span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Startup2 public site untouched</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">separate public/frontend layout</p>
                            </div>
                        </div>
                        <div class="timeline-block">
                            <span class="timeline-step"><i class="ni ni-settings text-secondary"></i></span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">CMS modules next</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">models, migrations, CRUD screens</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
