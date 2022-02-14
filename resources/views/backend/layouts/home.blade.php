@extends('backend.layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                {{-- <section class="col-lg-7 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i> Sales
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </section> --}}

                <!--Add Todo List Section--!>
                    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                
                {{-- Add & Update Section --}}
                <section class="col-md-6">
                    
                    <div class="card">
                        <div class="card-header">
                            <h3>
                                @if (isset($editData))
                                    Edit Todolist
                                
                                @else
                                    Add Todolist
                                    
                                @endif

                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            {{-- User add form --}}
                            <form method="post" action="{{ (@$editData) ? route('todolists.update', $editData->id) : route('todolists.store') }}"   id="myForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{ @$editData->name }}" class="form-control form-control-sm">
                                        
                                        <font style="color:red">
                                        {{($errors->has('name')) ? ($errors->first('name')) : ''}}
                                    </font>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="department">Department</label>
                                        {{-- <input type="text" name="department" class="form-control form-control-sm"> --}}
                                        <select name="department" id="department" class="form-control form-control-sm">
                                            <option value="">Select Department</option>
                                            <option value="HR" {{ @$editData->department == 'HR' ? 'selected' : '' }}>HR</option>
                                            <option value="Engineering" {{ @$editData->department == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                                        </select>

                                        <font style="color:red">
                                        {{($errors->has('name')) ? ($errors->first('name')) : ''}}
                                    </font>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" value="{{ @$editData->email }}" class="form-control form-control-sm">
                                        
                                        <font style="color:red">
                                            {{ ($errors->has('email')) ? ($errors->first('email')) : '' }}
                                        </font>
                                    </div>

                                    <div class="form-group col-md-6" style="padding-top: 30px;">
                                        <input type="submit" value="{{ (@$editData) ? 'Update' : 'Submit' }}" class="btn btn-primary btn-sm">
                                    </div>
                                </div>

                            </form>


                        </div>
                        <!-- /.card-body -->
                    </div>

                </section>

                {{-- View section --}}
                <section class="col-md-6">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3>Todolist</h3>

                            {{-- Search option --}}
                            <form action="{{ route('todolists.search') }}" method="">
                                @csrf

                                <input type="text" id="date" class="date" name="search" placeholder="01/01/2022">
                                <input type="submit" value="Search">
                            </form>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th>SL.</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Email</th>
                                    
                                    {{-- @hasanyrole('admin|editor') --}}
                                        <th>Action</th>
                                    {{-- @endhasanyrole() --}}

                                </tr>

                                @foreach ($allData as $key => $todolist)
                                    <tr class="{{ $todolist->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ date('d-m-Y h:i:s', strtotime($todolist->created_at)) }}</td>
                                        <td>{{ $todolist->name }}</td>
                                        <td>{{ $todolist->department }}</td>
                                        <td>{{ $todolist->email }}</td>
                                        <td>
                                            
                                            {{-- @role('editor') --}}

                                                <a title="Edit" id="edit" class="btn btn-primary btn-sm" href="{{ route('todolists.edit', $todolist->id) }}"> <i class="fa fa-edit"></i>
                                                </a>             

                                            {{-- @endrole() --}}

                                            @can('delete')
                                                <a title="Delete" id="delete" class="btn btn-danger btn-sm" href="{{ route('todolists.delete') }}" data-token="{{ csrf_token() }}" data-id="{{ $todolist->id }}"> <i class="fa fa-trash"></i>
                                                </a>
                                            @endcan
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            {{-- {{ $allData->link }} --}}

                        </div>
                        <!-- /.card-body -->
                    </div>

                </section>

                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!--End Todo List Section--!>

                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
