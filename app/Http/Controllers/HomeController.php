<?php namespace App\Http\Controllers;

use DB;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$last_booked = DB::select(DB::raw('SELECT v.brand, v.model, b.*, b.duration * v.price_per_hour AS booking_price, d1.departure_address, d2.destination_address
FROM bookings b, destinations d1, destinations d2, vehicles v
WHERE b.id = d1.booking_id
AND b.id = d2.booking_id
AND d1.departure_time = (
SELECT min( departure_time )
FROM destinations
WHERE b.id = booking_id )
AND d2.departure_time = (
SELECT max( departure_time )
FROM destinations
WHERE b.id = booking_id )
AND b.vehicle = v.id
GROUP BY b.id order by b.created_at desc limit 10'));

		$upcomings_bookings = DB::select(DB::raw('SELECT v.brand, v.model, b.*, b.duration * v.price_per_hour AS booking_price, d1.departure_address, d2.destination_address
FROM bookings b, destinations d1, destinations d2, vehicles v
WHERE b.id = d1.booking_id
AND b.id = d2.booking_id
AND d1.departure_time = (
SELECT min( departure_time )
FROM destinations
WHERE b.id = booking_id )
AND d2.departure_time = (
SELECT max( departure_time )
FROM destinations
WHERE b.id = booking_id )
AND b.vehicle = v.id
AND b.date>="'.date('Y-m-d').'" AND b.date<="'.date('Y-m-d',strtotime(date('Y-m-d'))+60*60*24*30).'"
GROUP BY b.id order by b.created_at desc limit 10'));


		// load the view and pass the nerds
		//return view('booking.index')
		//	->with('booking', $booking);

		return view('admin_home')
			->with('last_booked', $last_booked)
			->with('upcomings_bookings', $upcomings_bookings);
	}

}
