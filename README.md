# 방문자 통계 For Laravel

## Installation
```
composer require wangta69/laravel-visitors-statistics
php artisan pondol:install-visitors
```

## Update Geo-ip 
> 현재 제공하는 방문자 통계 프로그램은 ip를 이용하여 지역정보도 출력하게 되어 있습니다. <br>
>  초기 install 시 기본적인 GeoLite2-City.mmdb 파일이 제공되나 이후 지속적인 업데이트를 위해서는 MaxMind의 license key 가 필요하다. <br>

[https://dev.maxmind.com/geoip/geolite2-free-geolocation-data/](https://dev.maxmind.com/geoip/geolite2-free-geolocation-data/)

> 위사이트에서 회원 가입후 USER_ID 및 LICENSE_KEY 를 획득한 후 .env 파일에 아래와 같이 추가한다.
```
MAXMIND_USER_ID=0000000
MAXMIND_LICENSE_KEY=nTNJco_xxxxxxxxx........_mmk
```
> 이후에는 한달에 한번 자동으로 업데이트 되나 만약 수동으로 업데이트 하기를 원하면  아래와 같이 artisan 명령을 입력하기를 바랍니다.
```
php artisan pondol:maxmind-update
```

## Admin Page
```
https://yourdomain/visitos/admin
```
## API
```
https://your-domain/visitors/statistics/2024/11
```
