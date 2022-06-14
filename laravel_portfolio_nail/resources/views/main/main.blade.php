@extends('layouts.app')

@section('title')
{{ __('main.title') }}
@endsection

@section('javascript')
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=p9tknai70y"></script>
@endsection

@section('content')

<div class="container">
    <div class="form-group row justify-content-center" >
        <div class="col-md-8">
            <div class="card">
                <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px"> {{ __('main.title') }}</div>
                <div class="card-body">
                    <div class="row">
                        <label for="name" class="col-md-12 col-form-label text-center">
                          <span>{!! __('main.info_msg') !!}</span>
                        </label>
                    </div>

                    <div class="row">
                        <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('main.info_tel_msg') }}</label>
                    </div>

                    <div class="row">
                        <label for="password" class="col-md-12 col-form-label text-md-right">
                          <span>{!! __('main.info_time_msg') !!}</span>
                    </label>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row justify-content-center" >
      <div class="col-md-8">
          <div class="card">
              <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px"> {{ __('main.access_title') }}</div>
              <div class="card-body">
                  <div class="row">
                      <label class="col-md-12 col-form-label text-center">
                        <span>{!! __('main.access_msg') !!}</span>
                      </label>
                  </div>

                  <div class="row">
                      <label class="col-md-12 col-form-label text-md-left">{{ __('main.access_adress') }}</label>
                  </div>

                  <div class="row">
                    <label class="col-md-12 col-form-label text-md-left">
                      <span>{!! __('main.access_bus_title') !!}</span>
                    </label>
                  </div>

                  <div class="row">
                    <div id="map" style="width:100%;height:400px;"></div>
                    <script>
                      var HOME_PATH = window.HOME_PATH || '.';

                      var cityhall = new naver.maps.LatLng(37.5509895, 126.9908991),
                          map = new naver.maps.Map('map', {
                              center: cityhall.destinationPoint(0, 500),
                              zoom: 15
                          }),
                          marker = new naver.maps.Marker({
                              map: map,
                              position: cityhall
                          });

                      var contentString = [
                              '<div class="iw_inner">',
                              '   <b>NAIL SHOP</b>',
                              '   <p>한국 예쁘구 네일동 네일문화센터 내<br />',
                              '       | 네일아트, 네일샵<br />',
                              '       <a href="https://map.naver.com/v5/entry/address/14136583.485214692,4516187.524498787,%EC%84%9C%EC%9A%B8%ED%8A%B9%EB%B3%84%EC%8B%9C%20%EC%A4%91%EA%B5%AC%20%EC%98%88%EC%9E%A5%EB%8F%99%20%EC%82%B05-6,jibun?c=14135983.8739095,4516603.3741957,15,0,0,0,dh" target="_blank">네이버 지도로 보기</a>',
                              '   </p>',
                              '</div>'
                          ].join('');

                      var infowindow = new naver.maps.InfoWindow({
                          content: contentString
                      });

                      naver.maps.Event.addListener(marker, "click", function(e) {
                          if (infowindow.getMap()) {
                              infowindow.close();
                          } else {
                              infowindow.open(map, marker);
                          }
                      });

                      infowindow.open(map, marker);
                    </script>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
