<!doctype html>
<html lang="en" data-bs-theme="light">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="pagina" content="">
    <title>Correo | Web</title>
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


  </head>
  <body>

  <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-sm-12 col-12 m-auto">
                <form action="{{route('')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card shadow">

                        @if(Session::has("success"))
                            <div class="alert alert-success alert-dismissible"><button type="button" class="close">&times;</button>{{Session::get('success')}}</div>
                        @elseif(Session::has("failed"))
                            <div class="alert alert-danger alert-dismissible"><button type="button" class="close">&times;</button>{{Session::get('failed')}}</div>
                        @endif

                        <div class="card-header">
                            <h4 class="card-title">Send Email Using PHPMailer</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="emailRecipient">Email To </label>
                                <input type="email" name="emailRecipient" id="emailRecipient" class="form-control" placeholder="Mail To">
                            </div>

                            <div class="form-group">
                                <label for="emailCc">CC </label>
                                <input type="email" name="emailCc" id="emailCc" class="form-control" placeholder="Mail CC">
                            </div>

                            <div class="form-group">
                                <label for="emailBcc">BCC </label>
                                <input type="email" name="emailBcc" id="emailBcc" class="form-control" placeholder="Mail BCC">
                            </div>

                            <div class="form-group">
                                <label for="emailSubject">Subject </label>
                                <input type="text" name="emailSubject" id="emailSubject" class="form-control" placeholder="Mail Subject">
                            </div>

                            <div class="form-group">
                                <label for="emailBody">Message </label>
                                <textarea name="emailBody" id="emailBody" class="form-control" placeholder="Mail Body"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="emailAttachments">Attachment(s) </label>
                                <input type="file" name="emailAttachments[]" multiple="multiple" id="emailAttachments" class="form-control">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Send Email </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>



<script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
  </body>



</html>
