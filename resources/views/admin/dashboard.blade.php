@extends('layouts.admin')

@section('content')
              <!-- Page Heading -->
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{__('message.Dashboard')}}</h1>
              </div>

              <!-- Content Row -->
              <div class="row">

              <div class="container-fluid py-4">
                <div class="row">
                  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                      <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                          <i class="material-icons opacity-10">face</i>
                        </div>
                        <div class="text-end pt-1">
                          <p class="text-sm mb-0 text-capitalize">{{__('message.users')}}</p>
                          <h4 class="mb-0">{{ $admin }}</h4>
                        </div>
                      </div>
                      <hr class="dark horizontal my-0">
                      <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{ $admin }} </span>{{__('message.last month') }} </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                      <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                          <i class="material-icons opacity-10">group</i>
                        </div>
                        <div class="text-end pt-1">
                          <p class="text-sm mb-0 text-capitalize">{{__('message.FORMADOR') }}</p>
                          <h4 class="mb-0">{{$formadores}}</h4>
                        </div>
                      </div>
                      <hr class="dark horizontal my-0">
                      <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span> {{__('message.last month') }}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                      <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                          <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                          <p class="text-sm mb-0 text-capitalize">{{__('message.OPERADOR') }}</p>
                          <h4 class="mb-0">{{$operador}}</h4>
                        </div>
                      </div>
                      <hr class="dark horizontal my-0">
                      <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"></span>{{__('message.last month') }}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6">
                    <div class="card">
                      <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                          <i class="material-icons opacity-10">school</i>
                        </div>
                        <div class="text-end pt-1">
                          <p class="text-sm mb-0 text-capitalize">{{__('message.ACTIVE CURSO') }}</p>
                          <h4 class="mb-0">{{$activo_Curso}}</h4>
                        </div>
                      </div>
                      <hr class="dark horizontal my-0">
                      <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"> </span>{{__('message.last month') }}</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  {{--<div class="col-lg-4 col-md-6 mt-4 mb-4">--}}
                    {{--<div class="card z-index-2 ">--}}
                      {{--<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">--}}
                        {{--<div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">--}}
                          {{--<div class="chart">--}}
                            {{--<canvas id="chart-bars" class="chart-canvas" height="170"></canvas>--}}
                          {{--</div>--}}
                        {{--</div>--}}
                      {{--</div>--}}
                      {{--<div class="card-body">--}}
                        {{--<h6 class="mb-0 ">Website Views</h6>--}}
                        {{--<p class="text-sm ">Last Campaign Performance</p>--}}
                        {{--<hr class="dark horizontal">--}}
                        {{--<div class="d-flex ">--}}
                          {{--<i class="material-icons text-sm my-auto me-1">schedule</i>--}}
                          {{--<p class="mb-0 text-sm"> campaign sent 2 days ago </p>--}}
                        {{--</div>--}}
                      {{--</div>--}}
                    {{--</div>--}}
                  {{--</div>--}}
                  {{--<div class="col-lg-4 col-md-6 mt-4 mb-4">--}}
                    {{--<div class="card z-index-2  ">--}}
                      {{--<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">--}}
                        {{--<div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">--}}
                          {{--<div class="chart">--}}
                            {{--<canvas id="chart-line" class="chart-canvas" height="170"></canvas>--}}
                          {{--</div>--}}
                        {{--</div>--}}
                      {{--</div>--}}
                      {{--<div class="card-body">--}}
                        {{--<h6 class="mb-0 "> Daily Sales </h6>--}}
                        {{--<p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today sales. </p>--}}
                        {{--<hr class="dark horizontal">--}}
                        {{--<div class="d-flex ">--}}
                          {{--<i class="material-icons text-sm my-auto me-1">schedule</i>--}}
                          {{--<p class="mb-0 text-sm"> updated 4 min ago </p>--}}
                        {{--</div>--}}
                      {{--</div>--}}
                    {{--</div>--}}
                  {{--</div>--}}
                  {{--<div class="col-lg-4 mt-4 mb-3">--}}
                    {{--<div class="card z-index-2 ">--}}
                      {{--<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">--}}
                        {{--<div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">--}}
                          {{--<div class="chart">--}}
                            {{--<canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>--}}
                          {{--</div>--}}
                        {{--</div>--}}
                      {{--</div>--}}
                      {{--<div class="card-body">--}}
                        {{--<h6 class="mb-0 ">Completed Tasks</h6>--}}
                        {{--<p class="text-sm ">Last Campaign Performance</p>--}}
                        {{--<hr class="dark horizontal">--}}
                        {{--<div class="d-flex ">--}}
                          {{--<i class="material-icons text-sm my-auto me-1">schedule</i>--}}
                          {{--<p class="mb-0 text-sm">just updated</p>--}}
                        {{--</div>--}}
                      {{--</div>--}}
                    {{--</div>--}}
                  {{--</div>--}}
                </div>
                <div class="row mb-4">
                  <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                    <div class="card">
                      <div class="card-header pb-0">
                        <div class="row">
                          <div class="col-lg-6 col-7">
                            <h6>{{__('message.Ultimos Cursos') }}</h6>
                            <p class="text-sm mb-0">
                              <i class="fa fa-check text-info" aria-hidden="true"></i>
                              <span class="font-weight-bold ms-1"></span> {{__('message.this month') }}
                            </p>
                          </div>
                          <div class="col-lg-6 col-5 my-auto text-end">
                            <div class="dropdown float-lg-end pe-4">
                              <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-secondary"></i>
                              </a>
                              <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                          <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('message.Curso') }}</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('message.Codigo') }}</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('message.Provincia') }}</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('message.Direccion') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($last_curso as $cursos)
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-1">

                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $cursos->curso }}</h6>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <h6 class="mb-0 text-sm">{{ $cursos->codigo }}</h6>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <h6 class="mb-0 text-sm">{{ $cursos->provincia }}</h6>
                              </td>
                              <td class="align-middle">
                                <h6 class="mb-0 text-sm">{{ $cursos->direccion }}</h6>
                              </td>
                            </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                      <div class="card-header pb-0">
                        <h6> {{__('message.Entidades Formadoras') }}</h6>
                        <p class="text-sm">
                          <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                          <span class="font-weight-bold"></span>{{__('message.this month') }}
                        </p>
                      </div>

                      <div class="card-body p-3">
                        <div class="timeline timeline-one-side">
                          @foreach($entidad as $entidad)
                          <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <img src="{{asset('storage/' . $entidad->logo)}}" width="50px"/>
                  </span>
                            <div class="timeline-content">
                              <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $entidad->nombre }}</h6>
                              <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{$entidad->cif}}</p>
                            </div>
                          </div>
                          @endforeach

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
@endsection
