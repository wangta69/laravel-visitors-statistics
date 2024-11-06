<?php

namespace Pondol\VisitorsStatistics\Tests\Feature;

use Pondol\VisitorsStatistics\Http\Middleware\RecordVisits;
use Pondol\VisitorsStatistics\Models\VisitorsStatistic;
use Pondol\VisitorsStatistics\Models\Visitor;
use Pondol\VisitorsStatistics\Tests\TestCase;
use Pondol\VisitorsStatistics\Tracker;
use Illuminate\Foundation\Auth\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class TrackerTest extends TestCase

{
  // use RefreshDatabase; 모든 데이타 베이스가 날아감으로 이것으로 테스트 할땐 반드시 test db에서 만 처리

  /**
   * Route URL to register for testing purposes
   *
   * @var string
   */
  protected $routeUrl = '/visitors-statistics-test';

  /**
   * @inheritDoc
   */
  public function setUp(): void
  {
   
    parent::setUp();

    Route::get($this->routeUrl, function () {
      return 'Laravel Visitors Statistics test.';
    });

  }

  /**
   * Test if visit is being tracked.
   */
  public function testVisitorTracking()
  {
    // Make request

    $request = Request::create($this->routeUrl, 'GET');
    
    $tracker = $this->app->make(Tracker::class);
    $middleware = new RecordVisits($tracker);
    $middleware->handle($request, function () {
    });

    // Check if visit is tracked
    $this->assertEquals(1, Statistic::getTotalVisitors());

    // Check if visitor information is tracked
    $visitor = Visitor::first();

    $this->assertNotNull($visitor->ip);
    $this->assertEquals('Unknown', $visitor->continent);
    $this->assertEquals('Unknown', $visitor->country);
    $this->assertEquals('Unknown', $visitor->city);


  }


  /**
   * Test tracking of authenticated users.
   */

  public function testDontTrackAuthenticatedUser()
  {
    // Check if user is not authenticated and do authentication
    $this->assertFalse(auth()->check());
    Auth::login(new User());
    $this->assertTrue(auth()->check());

    // Set tracking of authenticated users to false
    config(['pondol-visitor.track_authenticated_users' => false]);

    // Make request
    $request = Request::create($this->routeUrl, 'GET');
    $tracker = $this->app->make(Tracker::class);
    $middleware = new RecordVisits($tracker);
    $middleware->handle($request, function () {
    });

    // Check if visit is not tracked
    $this->assertEquals(0, Statistic::getTotalVisitors());
  }

}
