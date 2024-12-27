@php
$path = isset($path) ? $path : [];
@endphp
<x-pondol-common::app>
  <div class="wrapper">

    <x-dynamic-component :component="config('pondol-visitor.component.admin.lnb')" />
    <div class="container">
      @if(count($path))
      <x-pondol-common::partials.main-top-navigation :path="$path"/>
      @endif
      <div style="padding-bottom:70px;">
      {{ $slot }}
      </div>
      <x-pondol-common::partials.footer />
    </div><!--. container -->
  </div>

  <x-pondol-common::partials.toaster />

@section('styles')
@parent
<link rel="stylesheet" href="/pondol/app.css">
<style>
  #footer {border-top: 1px solid #ced4da;}
</style>
@endsection

@section('scripts')
@parent
<script src="/pondol/common.js"></script>
<script src="/pondol/common-admin.js"></script>
@endsection
</x-pondol-common::app>