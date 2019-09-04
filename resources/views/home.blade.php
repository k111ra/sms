@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
    
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
    
                        <div class="panel-heading">
                            <h3 class="panel-title">Envoyer votre Message ici</h3>
                        </div>
                        <div class="panel-body">
                            <form id="myForm" method="POST" action="{{ route('sendSms') }}" role="form">
                                {{csrf_field()}}
                                <fieldset>
                                    <div class="form-group">
                                        N°
                                        <input class="form-control" placeholder="+225..." name="phone_number" type="number" autofocus>
                                        <br>

                                        liste
                                        <input class="form-control" placeholder="liste de contact" name="contact" type="number" autofocus>
                                        <br>
                                        <div class="form-group">
                                                <textarea name="message" class="form-control" id="message" required="required" placeholder="Votre Message " rows="8"></textarea>
                                            </div>
                                        
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button id="submitBtn" type="submit" class="btn btn-success btn-block">Envoyer</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
@endsection
