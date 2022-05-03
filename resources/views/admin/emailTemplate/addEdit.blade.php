@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Email Template</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a  class="btn btn-primary" href="{{ route('email-templates.index') }}">View Email Template</a></li>
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
                <h3 class="card-title">{{isset($emailTemplate) ? 'Update # '.$emailTemplate->id : 'Add New' }} </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form class="form-horizontal" id="user-add-edit" action="{{isset($emailTemplate) ? route('email-templates.update',$emailTemplate->id) : route('email-templates.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              {{ isset($emailTemplate) ? method_field('PUT'):'' }}
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="title"  placeholder="Enter your title" type="text" value="{{isset($emailTemplate) ? $emailTemplate->title : '' }}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="subject"  placeholder="Enter your subject" type="text" value="{{isset($emailTemplate) ? $emailTemplate->subject : '' }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email (CC)</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="cc_email"  placeholder="Enter your email" type="email" value="{{isset($emailTemplate) ? $emailTemplate->cc_email : '' }}">
                    </div>
                  </div>  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Body Text</label>
                    <div class="col-sm-10">
                    <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{isset($emailTemplate) ? $emailTemplate->body : '' }}</textarea>

                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">{{isset($emailTemplate) ? 'Update' : 'Save' }}</button>

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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function () {

   $('#body').summernote({
    toolbar: [
  	['font', ['bold', 'italic', 'underline', 'clear']],
	['insert', ['link','image', 'doc', 'video']],
	['misc', ['codeview']],
    ],
      height: 200
   });
  });
</script>
{!! JsValidator::formRequest('App\Http\Requests\Admin\Email\StoreEmailRequest','#user-add-edit') !!}


@endsection
