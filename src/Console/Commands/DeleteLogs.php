<?php

namespace Pondol\VisitorsStatistics\Console\Commands;

use Illuminate\Console\Command;

use Exception;
use PharData;
use File;

class DeleteLogs extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'pondol:-update {--scheduled}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Update MaxMind GeoLite2 database that is used for determining user location.';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
      parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @throws Exception
   *
   * @return mixed
   */
  public function handle()
  {
    $this->updateCity();
    // $this->updateASN();
    $this->updateCountry();

  }

  private function updateCity() {
    $Permalinks = config('visitorstatistics.permalink_City');
    $info = $this->getdownloadUrl($Permalinks);

    // get mmdb database(tar.gz)
    copy($info['redirect_url'], storage_path('app/public/GeoIP').'/GeoLite2-City.tar.gz');
    $this->extract('GeoLite2-City');
  }

  private function updateASN() {
    $Permalinks = config('visitorstatistics.permalink_ASN');
    $info = $this->getdownloadUrl($Permalinks);

    // get mmdb database(tar.gz)
    copy($info['redirect_url'], storage_path('app/public/GeoIP').'/GeoLite2-ASN.tar.gz');
    $this->extract('GeoLite2-ASN');
  }

  private function updateCountry() {
    $Permalinks = config('visitorstatistics.permalink_Country');
    $info = $this->getdownloadUrl($Permalinks);

    // get mmdb database(tar.gz)
    copy($info['redirect_url'], storage_path('app/public/GeoIP').'/GeoLite2-Country.tar.gz');
    $this->extract('GeoLite2-Country');
  }

  /**
   * get real download url using permalink.
   */
  private function getdownloadUrl($Permalinks) {
    $user_id = config('visitorstatistics.maxmind_user_id');
    $licensekey = config('visitorstatistics.maxmind_license_key');
    
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Permalinks);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $user_id.':'.$licensekey);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    return $info;

  }

  private function extract($dest) {
    $storage_path = storage_path('app/public/GeoIP');
    $zipPath = $storage_path.'/'.$dest.'.tar.gz';

    try {
      $phar = new PharData($zipPath);

      // move to first directory 
      if ($phar->current()->isDir()) {
        $subdir = $phar->current()->getFilename(); // get first directory name
        $path =  $subdir.'/'.$dest.'.mmdb';
        $phar->extractTo($storage_path, $path, true);  // extract only file 

        // move GeoLite2-City.mmdb from extracted folder to GeoIP
        File::move($storage_path.'/'.$path, $storage_path.'/'.$dest.'.mmdb');

        // delete extracted folder
        File::deleteDirectory($storage_path.'/'.$subdir);
      }
    } catch (Exception $e) {
        // handle errors
        // print_r($e);
    }
  }
}
