<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BookingRepository;
use Illuminate\Http\Request;
use Flash;

class BookingController extends AppBaseController
{
    /** @var BookingRepository $bookingRepository*/
    private $bookingRepository;

    public function __construct(BookingRepository $bookingRepo)
    {
        $this->bookingRepository = $bookingRepo;
    }

    /**
     * Display a listing of the Booking.
     */
    public function index(Request $request)
    {
        $bookings = $this->bookingRepository->paginate(10);

        return view('bookings.index')
            ->with('bookings', $bookings);
    }

    /**
     * Show the form for creating a new Booking.
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * Store a newly created Booking in storage.
     */
    public function store(CreateBookingRequest $request)
    {
        $input = $request->all();

        $booking = $this->bookingRepository->create($input);

        Flash::success('Booking saved successfully.');

        return redirect(route('bookings.index'));
    }

    /**
     * Display the specified Booking.
     */
    public function show($id)
    {
        $booking = $this->bookingRepository->find($id);

        if (empty($booking)) {
            Flash::error('Booking not found');

            return redirect(route('bookings.index'));
        }

        return view('bookings.show')->with('booking', $booking);
    }

    /**
     * Show the form for editing the specified Booking.
     */
    public function edit($id)
    {
        $booking = $this->bookingRepository->find($id);

        if (empty($booking)) {
            Flash::error('Booking not found');

            return redirect(route('bookings.index'));
        }

        return view('bookings.edit')->with('booking', $booking);
    }

    /**
     * Update the specified Booking in storage.
     */
    public function update($id, UpdateBookingRequest $request)
    {
        $booking = $this->bookingRepository->find($id);

        if (empty($booking)) {
            Flash::error('Booking not found');

            return redirect(route('bookings.index'));
        }

        $booking = $this->bookingRepository->update($request->all(), $id);

        Flash::success('Booking updated successfully.');

        return redirect(route('bookings.index'));
    }

    /**
     * Remove the specified Booking from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $booking = $this->bookingRepository->find($id);

        if (empty($booking)) {
            Flash::error('Booking not found');

            return redirect(route('bookings.index'));
        }

        $this->bookingRepository->delete($id);

        Flash::success('Booking deleted successfully.');

        return redirect(route('bookings.index'));
    }
}
