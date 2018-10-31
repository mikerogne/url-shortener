@extends('layout')

@section('content')
  <div class="col-xl-9 mx-auto">
    <h1 class="mb-5">Build a landing page for your business or project and generate more leads!</h1>
  </div>
  <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
    <form action="{{ route('urls.store') }}" method="post">
        {{ csrf_field() }}
      <div class="form-row">
        <div class="col-12 col-md-9 mb-2 mb-md-0">
          @if ($errors->any())
              <div class="bg-red-dark text-white p-3 mb-3 rounded">
                  <ul class="list-reset">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif


              <input
                  type="text"
                  name="url"
                  
                  placeholder="http://your-url-here.com"
                  class="form-control form-control-lg"
              >
        </div>
        <div class="col-12 col-md-3">
          <button type="submit" class="btn btn-block btn-lg btn-primary">Shorten URL</button>
        </div>
      </div>
    </form>
  </div>



            </form>
  @endsection
