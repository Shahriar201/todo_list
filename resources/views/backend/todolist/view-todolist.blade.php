@extends('backend.layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage TodoList</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Todolist</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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
                                        <label for="date">Date</label>
                                            <input type="date" name="date" value="{{ @$editData->date }}" class="form-control form-control-sm">
                                            
                                            <font style="color: red">
                                            {{ ($errors->has('date')) ? ($errors->first('date')) : '' }}
                                            </font>
                                </div>

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

                                    <div class="form-group col-md-6">
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
                            <form action="{{ route('users.search') }}" method="">
                                @csrf

                                <input type="date" name="search" placeholder="Key word">
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
                                        <td>{{ date('d-m-Y h:i:s', strtotime($todolist->date)) }}</td>
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
 
</div>
<!-- /.content-wrapper -->

{{-- Form Validation --}}
<script>
    $(function () {

      $('#myForm').validate({
        rules: {
          date: {
            required: true,
          },
          name: {
            required: true,
          },
          department: {
            required: true,
          },
          email: {
            required: true,
          },
        },
        // messages: {
        //   name: {
        //     required: "Please enter permission"
        //   },
    
        //   //terms: "Please accept our terms"
        // },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
    </script>

@endsection
