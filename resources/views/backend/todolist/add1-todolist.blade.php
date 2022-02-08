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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-md-6">
                    
                    <div class="card">
                        <div class="card-header">
                            <h3>
                                @if (isset($editData))
                                    Edit Todolist
                                
                                @else
                                    Add Todolist
                                    
                                @endif

                                <a class="btn btn-success float-right btn-sm" href="{{ route('todolists.view') }}">
                                    <i class="fa fa-list"></i>Todolist</a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        {{-- User add form --}}
                        <form method="post" action="{{ (@$editData) ? route('todolists.update', $editData->id) : route('todolists.store') }}" id="myForm">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="date">Date</label>
                                        <input type="date" name="date" class="form-control form-control-sm">
                                        
                                        <font style="color: red">
                                          {{ ($errors->has('date')) ? ($errors->first('date')) : '' }}
                                        </font>
                               </div>

                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control form-control-sm">
                                    
                                    <font style="color:red">
                                      {{($errors->has('name')) ? ($errors->first('name')) : ''}}
                                  </font>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="department">Department</label>
                                    <input type="text" name="department" class="form-control form-control-sm">
                                    
                                    <font style="color:red">
                                      {{($errors->has('name')) ? ($errors->first('name')) : ''}}
                                  </font>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control form-control-sm">
                                    
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

                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

{{-- Form validation --}}
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
