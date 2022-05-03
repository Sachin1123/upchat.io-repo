@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Company</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a  class="btn btn-primary" href="{{ route('company.index') }}">View Company</a></li> 
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{isset($company) ? 'Update # '.$company->id : 'Add New' }} </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form class="form-horizontal" id="user-add-edit" action="{{isset($company) ? route('company.update',$company->id) : route('company.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              {{ isset($company) ? method_field('PUT'):'' }}
                <div class="card-body">
                <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Apex Company Name</label>
                        <div class="col-sm-10">
                        <input class="form-control" name="apex_company"  placeholder="Enter your apex company name" type="text" value="{{isset($company) ? $company->apex_company : '' }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Apex Username</label>
                        <div class="col-sm-10">
                        <input class="form-control" name="apex_username"  placeholder="Enter your apex username" type="text" value="{{isset($company) ? $company->apex_username : '' }}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Apex Password</label>
                        <div class="col-sm-10">
                        <input class="form-control" name="apex_password"  placeholder="Enter your password" type="text" value="{{isset($company) ? $company->apex_password : '' }}" >
                        </div>
                      </div>
                      <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                    <select name="status"  class="form-control">
                                   
                  <option value="Active" {{ (isset($company) && $company->status == 'Active') ? 'selected' : '' }}>Active</option>
                  <option value="Inactive"{{ (isset($company) && $company->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>

                                      
                                      
                    </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">{{isset($company) ? 'Update' : 'Save' }}</button>
             
                </div>
                <!-- /.card-footer -->
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

 
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')

{!! JsValidator::formRequest('App\Http\Requests\Admin\Company\CompanyRequest','#user-add-edit') !!}


@endsection
