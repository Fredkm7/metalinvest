@extends("$activeTemplate.layouts.$layout")
@section('content')
  
                    @include($activeTemplate.'partials.plan', ['plans' => $plans])
     
@endsection
