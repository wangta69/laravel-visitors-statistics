@section('title', 'Dashboard')
<x-pondol-common::app-simple-sidebar navigation="visitors::navigation" :path="['대쉬보드']">
  <div class="row pt-1">
    오늘 방문자수 : {{ number_format($today['all']) }}명 <br>
    오늘 방문자수(unique) : {{ number_format($today['unique']) }}명 <br>
    
    현재 접속자수: {{ number_format($today['online']) }}명
  </div>
  <div class="row pt-5">
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <span>일별 방문자수</span>
        </div><!-- .card-header -->
        <div class="card-body">
          <canvas id="dailyChart" width="400" height="400"></canvas>
        </div><!-- .card-body -->
      </div><!-- .card -->
    </div>

    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <span>국가별</span>
        </div><!-- .card-header -->
        <div class="card-body">
          <canvas id="countryChart" width="400" height="400"></canvas>
        </div><!-- .card-body -->
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
          <canvas id="deviceChart" width="400" height="400"></canvas>
        </div><!-- .card-body -->
      </div><!-- .card -->
    </div>

    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <span>Browser</span>
        </div><!-- .card-header -->
        <div class="card-body">
          <canvas id="browserChart" width="400" height="400"></canvas>
        </div><!-- .card-body -->

      </div><!-- .card -->
    </div>
  </div><!-- .row -->

@section('scripts')
@parent
<x-chart::chartjs :chart="$visitors"/>
<x-chart::chartjs :chart="$countries"/>
<x-chart::chartjs :chart="$devices"/>
<x-chart::chartjs :chart="$browsers"/>

<script>
var ctx = document.getElementById('testChart').getContext('2d');
var options = {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Chart.js Bar Chart'
      }
    }
  };
var config = {
  type: 'bar',
  data: {
    datasets: [{
      data: [20, 10],
    }],
    labels: ['a', 'b']
  },
  options: options
};
new Chart(ctx, config);
</script>
@endsection
</x-visitors::app>

