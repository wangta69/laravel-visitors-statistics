{{-- 
@section('title', '환경 설정')
<x-dynamic-component 
  :component="config('pondol-visitor.component.admin.layout')" 
  :path="['방문자통계', '환경 설정']"> 

<div class="p-3 mb-4 bg-light rounded-3">
  <h2 class="fw-bold">환경 설정</h2>

  <div class="card">
    <div class="card-body">
      <div>방문자 통계와 관련한 로그 설정</div>
    </div><!-- .card-body -->
  </div><!-- .card -->
</div>

<div class="card">
  <form name="company-form">
    @csrf
    @method('PUT')
    <div class="card-body">
      <div class="input-group">
        <label class='col-sm-2 col-form-label'>쇼핑몰명</label>
        <span>쇼핑몰명은 .env 파일의 APP_NAME 에서 설정 하시기 바랍니다.</span>
      </div>
      <div class="input-group mt-1">
        <label class='col-sm-2 col-form-label'>상호</label>
        <input name="name" type="text" class="form-control" value="{{$config->name}}">
      </div>
      <div class="input-group mt-1">
        <label class='col-sm-2 col-form-label'>사업자등록번호</label>
        <input name="businessNumber" type="text" class="form-control" value="{{$config->name}}">
      </div>
      <div class="input-group mt-1">
        <label class='col-sm-2 col-form-label'>통신판매업신고번호</label>
        <input name="mailOrderSalesRegistrationNumber" type="text" class="form-control" value="{{$config->name}}">
      </div>
      <div class="input-group mt-1">
        <label class='col-sm-2 col-form-label'>사업장주소</label>
        <input name="address" type="text" class="form-control" value="{{$config->name}}">
      </div>
      <div class="input-group mt-1">
        <label class='col-sm-2 col-form-label'>대표자명</label>
        <input name="representative" type="text" class="form-control" value="{{$config->name}}">
      </div>
      <div class="input-group mt-1">
        <label class='col-sm-2 col-form-label'>연락처</label>
        <input name="tel1" type="text" class="form-control" value="{{$config->name}}">
      </div>
		
      <div class="input-group mt-1">
        <label class='col-sm-2 col-form-label'>팩스</label>
        <input name="fax1" type="text" class="form-control" value="{{$config->name}}">
      </div>
			<div class="input-group mt-1">
        <label class='col-sm-2 col-form-label'>copyright</label>
        <input name="copyright" type="text" class="form-control" value="{{$config->name}}">
      </div>
	
    </div> <!-- .card-body -->

    <div class="card-footer text-end">
      <!-- <button type="submit"class="btn btn-primary">적용</button> -->
      <button type="button"class="btn btn-primary act-update-company">적용</button>
    </div> <!-- .card-footer -->
  </form>
</div><!-- .card -->

@section('styles')
@parent
@endsection

@section('scripts')
@parent
<script>
$(function(){
  $(".act-update-company").on('click', function(){
    ROUTE.ajaxroute('put', 
    {route: 'market.admin.config.company', data: $("form[name='company-form']").serializeObject()}, 
    function(resp) {
      if(resp.error) {
        showToaster({title: '알림', message: resp.error});
      } else {
        showToaster({title: '알림', message: '처리되었습니다.', alert: false});
      }
    })
  })
})
</script>
@endsection
</x-dynamic-component>
--}}