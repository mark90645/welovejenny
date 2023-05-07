<?php

class BookableCell
{
    /**
     * @var Booking
     */
    private $booking;
 
    private $currentURL;
    
    private $username;
 
    /**
     * BookableCell constructor.
     * @param $booking
     * @param $username
     */
    public function __construct(Booking $booking, $username)
    {
        $this->booking = $booking;
        $this->currentURL = htmlentities($_SERVER['REQUEST_URI']);
        $this->username = $username;
    }
 
    public function update(Calendar $cal)
    {
        $date = $cal->getCurrentDate();

        if ($this->isDateBooked($date)) {
            // 如果已經被使用者預訂，就顯示已預訂狀態
            return $cal->cellContent = $this->bookedCell($date);
        } else if ($this->isDateFull($date)) {
            // 如果已經額滿，就顯示已額滿狀態
            return $cal->cellContent = $this->closeCell($date);
        } else {
            // 如果還沒被預訂且還沒額滿，就顯示可預訂狀態
            return $cal->cellContent = $this->openCell($date);
        }
    }

    public function routeActions()
    {
        if (isset($_POST['delete'])) {
            $this->deleteBooking($_POST['id']);
        }
 
        if (isset($_POST['add'])) {
            $this->addBooking($_POST['date']);
        }
    }
 
    private function openCell($date)
    {
        return '<div class="open">' . $this->bookingForm($date) . $this->getNumBookings($date) . '/30</div>';
    }
 
    private function bookedCell($date)
    {
        return '<div class="booked">' . $this->deleteForm($this->bookingId($date))  . $this->getNumBookings($date) . '/30</div>';
    }
    
    private function closeCell($date)
    {
        $username = $_COOKIE["member_account"];
            if ($this->isDateBookedByUser($date, $username)) {
            // 如果現在使用者已經預訂該日期，就顯示已預訂狀態
            return '<div class="booked">' . $this->deleteForm($this->bookingId($date))  . $this->getNumBookings($date) . '/30</div>';
        } else {
            // 如果現在使用者還沒預訂該日期，就顯示已額滿狀態
            return '<div class="close">已額滿</div>';
        }
    }
 

    private function isDateBooked($date)
    {
        return in_array($date, $this->bookedDates());
    }
 
    private function bookedDates()
    {
        $records = $this->booking->index();
        $bookedDates = [];
        foreach ($records as $record) {
            if ($record['member_account'] === $this->username) {
                $bookedDates[] = $record['booking_date'];
            }
        }
        return $bookedDates;
    }
 
    private function bookingId($date)
    {
        $booking = array_filter($this->booking->index(), function ($record) use ($date) {
            return $record['booking_date'] == $date && $record['member_account'] === $this->username;
        });
 
        $result = array_shift($booking);
 
        return $result['id'];
    }
 
    private function deleteBooking($id)
    {
        $this->booking->delete($id);
    }
 
    private function addBooking($date)
    {
        $date = new DateTimeImmutable($date);
        $this->booking->add($date, $this->username);
    }
 
    private function bookingForm($date)
    {
        return
            '<form  method="post" action="' . $this->currentURL . '">' .
            '<input type="hidden" name="add" />' .
            '<input type="hidden" name="date" value="' . $date . '" />' .
            '<input class="submit" type="submit" value="Book" />' .
            '</form>';
    }
 
    private function deleteForm($id)
    {
        return
            '<form onsubmit="return confirm(\'Are you sure to cancel?\');" method="post" action="' . $this->currentURL . '">' .
            '<input type="hidden" name="delete" />' .
            '<input type="hidden" name="id" value="' . $id . '" />' .
            '<input class="submit" type="submit" value="Delete" />' .
            '</form>';
    }

    private function closeForm($id)
    {
        return
            "<div class='full_text'></div>";
    }

    private function getNumBookings($date)
    {
        $count = 0;
        foreach ($this->booking->index() as $record) {
            if ($record['booking_date'] == $date) {
                $count++;
            }
        }
        return $count;
    }
    
    private function isDateBookedByUser($date, $user_id) {
        // 假設 $bookings 是一個包含所有預訂的陣列
        foreach ($this->booking->index() as $booking) {
          if ($booking['booking_date'] == $date && $booking['member_account'] == $user_id) {
            return true;
          }
        }
        return false;
      }
      
    private function isDateFull($date) {
        // 假設 $bookings 是一個包含所有預訂的陣列
        $count = 0;
        foreach ($this->booking->index() as $booking) {
          if ($booking['booking_date'] == $date) {
            $count++;
          }
        }
        return $count >= 30; // 假設最多只能預訂 30 個人
      }
}



