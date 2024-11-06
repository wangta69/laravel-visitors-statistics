<x-visitors::app>
  <div class="row pt-5">
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <span>일별 방문자수</span>
        </div><!-- .card-header -->
        <div class="card-body">
        <canvas id="dailyChart" width="400" height="400"></canvas>
        </div><!-- .card-body -->
        <div class="card-footer text-end">
          <a href="{{ route('market.admin.users') }}" class="btn btn-primary btn-sm">더 보기</a>
        </div><!-- .card-footer -->
      </div><!-- .card -->
    </div>

    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <span>국가별</span>
        </div><!-- .card-header -->
        <div class="card-body">
        <canvas id="dailyChart" width="400" height="400"></canvas>
        </div><!-- .card-body -->
        <div class="card-footer text-end">
          <a href="{{ route('market.admin.users') }}" class="btn btn-primary btn-sm">더 보기</a>
        </div><!-- .card-footer -->
      </div><!-- .card -->
    </div>
  </div><!-- .row -->
  <hr>
  <div class="row pt-5">
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <span>Device </span>
        </div><!-- .card-header -->
        <div class="card-body">
        <canvas id="dailyChart" width="400" height="400"></canvas>
        </div><!-- .card-body -->
        <div class="card-footer text-end">
          <a href="{{ route('market.admin.users') }}" class="btn btn-primary btn-sm">더 보기</a>
        </div><!-- .card-footer -->
      </div><!-- .card -->
    </div>

    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <span>Browser</span>
        </div><!-- .card-header -->
        <div class="card-body">
        <canvas id="dailyChart" width="400" height="400"></canvas>
        </div><!-- .card-body -->
        <div class="card-footer text-end">
          <a href="{{ route('market.admin.users') }}" class="btn btn-primary btn-sm">더 보기</a>
        </div><!-- .card-footer -->
      </div><!-- .card -->
    </div>
  </div><!-- .row -->

@section('scripts')
@parent


<x-chart::chartjs :chart="$chart"/>
@endsection
</x-visitors::app>

