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
                        <li class="breadcrumb-item active">User</li>
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
                            <h3>User List
                                
                                {{-- Set role for the user --}}
                                {{-- @role('writer') --}}
                                    <a class="btn btn-success float-right btn-sm" href="{{ route('users.add') }}">
                                        <i class="fa fa-plus-circle"></i>Add User</a>
                                {{-- @endrole --}}

                            </h3>

                            {{-- Search option --}}
                            <form action="{{ route('users.search') }}" method="">
                                @csrf

                                <input type="date" name="search" placeholder="Key word">
                                <input type="submit" value="Search">
                            </form>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th>SL.</th>
                                    <th>Date</th>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    
                                    {{-- @hasanyrole('admin|editor') --}}
                                        <th>Action</th>
                                    {{-- @endhasanyrole() --}}

                                </tr>

                                @foreach ($allData as $key => $user)
                                    <tr class="{{ $user->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ date('d-m-Y', strtotime($user->date)) }}</td>
                                        <td>{{ $user->user_type }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            
                                            {{-- @role('editor') --}}

                                                <a title="Edit" id="edit" class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}"> <i class="fa fa-edit"></i>
                                                </a>             

                                            {{-- @endrole() --}}

                                            {{-- @role('admin') --}}
                                                <a title="Delete" id="delete" class="btn btn-danger btn-sm" href="{{ route('users.delete') }}" data-token="{{ csrf_token() }}" data-id="{{ $user->id }}"> <i class="fa fa-trash"></i>
                                                </a>
                                            {{-- @endrole --}}
                                            
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
