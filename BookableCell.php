<?php

class BookableCell
{
    /**
     * @var Booking
     */
    private $booking;
 
    private $currentURL;
    
    private $username;
    
    private $class;
    /**
     * BookableCell constructor.
     * @param $booking
     * @param $username
     * @param $class
     */
    public function __construct(Booking $booking, $username, $class)
    {
        $this->booking = $booking;
        $this->currentURL = htmlentities($_SERVER['REQUEST_URI']);
        $this->username = $username;
        $this->class = $class;
    }
 
    public function update(Calendar $cal, $class)
    {
        $date = $cal->getCurrentDate();

        if ($this->isDateBooked($date, $class)) {
            // 如果已經被使用者預訂，就顯示已預訂狀態
            return $cal->cellContent = $this->bookedCell($date, $class);
        } else if ($this->isDateFull($date, $class)) {
            // 如果已經額滿，就顯示已額滿狀態
            return $cal->cellContent = $this->closeCell($date, $class);
        } else {
            // 如果還沒被預訂且還沒額滿，就顯示可預訂狀態
            return $cal->cellContent = $this->openCell($date, $class);
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
 
    private function openCell($date, $class)
    {
        return '<div class="open">' . '<p class="date">' . substr($date, -2) . '</p>' . $this->bookingForm($date, $class) . $this->getNumBookings($date, $class) . '/30</div>';    
    }
 
    private function bookedCell($date, $class)
    {
        return '<div class="booked">' . '<p class="date">' . substr($date, -2) . '</p>' . $this->deleteForm($this->bookingId($date, $class))  . $this->getNumBookings($date, $class) . '/30</div>';
    }
    
    private function closeCell($date, $class)
    {
        $username = $_COOKIE["member_account"];
            if ($this->isDateBookedByUser($date, $username, $class)) {
            // 如果現在使用者已經預訂該日期，就顯示已預訂狀態
            return '<div class="booked">' . '<p class="date">' . substr($date, -2) . '</p>' . $this->deleteForm($this->bookingId($date, $class))  . $this->getNumBookings($date, $class) . '/30</div>';
        } else {
            // 如果現在使用者還沒預訂該日期，就顯示已額滿狀態
            return '<div class="close">已額滿</div>';
        }
    }
 

    private function isDateBooked($date, $class)
    {
        return in_array($date, $this->bookedDates($class)) && $class == $this->class;
    }
 
    private function bookedDates($class)
    {
        $records = $this->booking->index();
        $bookedDates = [];
        foreach ($records as $record) {
            if ($record['member_account'] === $this->username && $record['class_type'] == $class) {
                $bookedDates[] = $record['booking_date'];
            }
        }
        return $bookedDates;
    }
 
    private function bookingId($date, $class)
    {
        $booking = array_filter($this->booking->index(), function ($record) use ($date, $class) {
            return $record['booking_date'] == $date && $record['member_account'] === $this->username && $record['class_type'] == $class;
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
            '<form onsubmit="return confirm(\'確定取消預約?\');" method="post" action="' . $this->currentURL . '">' .
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

    private function getNumBookings($date, $class)
    {
        $count = 0;
        foreach ($this->booking->index() as $record) {
            if ($record['booking_date'] == $date && $record['class_type'] == $class) {
                $count++;
            }
        }
        return $count;
    }
    
    private function isDateBookedByUser($date, $user_id, $class) {
        // 假設 $bookings 是一個包含所有預訂的陣列
        foreach ($this->booking->index() as $booking) {
          if ($booking['booking_date'] == $date && $booking['member_account'] == $user_id && $booking['class_type'] == $class) {
            return true;
          }
        }
        return false;
      }
      
    private function isDateFull($date, $class) {
        // 假設 $bookings 是一個包含所有預訂的陣列
        $count = 0;
        foreach ($this->booking->index() as $booking) {
          if ($booking['booking_date'] == $date && $booking['class_type'] == $class) {
            $count++;
          }
        }
        return $count >= 30; // 假設最多只能預訂 30 個人
      }
}



