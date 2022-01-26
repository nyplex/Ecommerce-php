<?php


namespace App\Table;

use App\Model\Booking;
use PDO;

final class BookingTable extends Table {


    protected $table = "bookings";
    protected $class = Booking::class;


    /**
     * createNewBooking
     * this function creates a new booking in the DB
     * 
     * @param  mixed $user
     * @return void
     */
    public function createNewBooking(Booking $booking): void 
    {
        $id = $this->create([
            'f_name' => $booking->getF_name(),
            'l_name' => $booking->getL_name(),
            'email' => $booking->getEmail(),
            'tel' => $booking->getTel(),
            'time' => $booking->getTime(),
            'size' => $booking->getSize(),
            'date' => $booking->getDate(),
        ]);
        $booking->setID($id);
    }

}