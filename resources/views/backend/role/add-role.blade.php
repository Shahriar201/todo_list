@extends('backend.layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage User</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Roles</li>
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
                <section class="col-md-12">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3>
                                @if (isset($editData))
                                    Edit Role
                                
                                @else
                                    Add Role
                                    
                                @endif

                                <a class="btn btn-success float-right btn-sm" href="{{ route('roles.view') }}">
                                    <i class="fa fa-list"></i>Role list</a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        {{-- User add form --}}
                        <form method="post" action="{{ (@$editData) ? route('roles.update', $editData->id) : route('roles.store') }}" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <div class="form-row">
                                
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ @$editData->name }}">
                                    
                                    <font style="color:red">
                                      {{($errors->has('name')) ? ($errors->first('name')) : ''}}
                                  </font>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="permission">Permissions</label>
                                    {{-- <input type="text" name="permission" class="form-control form-control-sm" value=""> --}}
                                    <select name="permission[]" id="permission" class="form-control select2" multiple>
                                        <option value="">Select Permissions</option>
                                        @foreach ($permissions as $permission)
                                            <option  value="{{ $permission->name }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                    <font style="color:red">
                                      {{($errors->has('name')) ? ($errors->first('name')) : ''}}
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

                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Page specific script -->
{{-- @dd($editData->toArray()); --}}

@endsection

@push('script')

<script> 
        $( document ).ready(function() {
            var tem = [<?php echo $temp ?>];
            $('#permission').val(tem).trigger('change');
});
        
       
</script>

<script>
    $(function () {
       
      $('#myForm').validate({
        rules: {
          name: {
            required: true,
          },
          permission: {
              required: true,
          }
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

    //   console.log('{{ @$editData->id }}');
    });

    </script>
@endpush
