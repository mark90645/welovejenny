<?php
 
class Booking
{
 
    private $dbh;
 
    private $bookingsTableName = 'bookings';

    private $class;
 
    /**
     * Booking constructor.
     * @param string $database
     * @param string $host
     * @param string $databaseUsername
     * @param string $databaseUserPassword
     * @param string $class
     */
    public function __construct($database, $host, $databaseUsername, $databaseUserPassword, $class)
    {
        try {
 
            $this->dbh =
                new PDO(sprintf('mysql:host=%s;dbname=%s', $host, $database),
                    $databaseUsername,
                    $databaseUserPassword
                );
 
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $this->class = $class;
    }

    public function index()
    {
        $statement = $this->dbh->query('SELECT * FROM ' . $this->bookingsTableName);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add(DateTimeImmutable $bookingDate)
    {
        $plan = $this->dbh->query('SELECT * FROM plan_choose WHERE member_account = "' . $_COOKIE["member_account"] . '"');
        $result = $plan->fetch();
        if ($plan->rowCount() === 0) {
            echo "<script>alert('您需要先選擇方案!');</script>";
        } else {
            $statement = $this->dbh->prepare(
                'INSERT INTO ' . $this->bookingsTableName . ' (booking_date, member_account, class_type) VALUES (:bookingDate, :username, :class)'
            );
            if ($result['plan_id'] == "達人方案")
            {
                if (false === $statement) {
                    throw new Exception('Invalid prepare statement');
                }
                if (false === $statement->execute([
                    ':bookingDate' => $bookingDate->format('Y-m-d'),
                    ':username' => $_COOKIE["member_account"],
                    ':class' => $this->class
                ])) {
                    throw new Exception(implode(' ', $statement->errorInfo()));
                }
            }
            else if ($result['plan_id'] == "進階方案")
            {
                if ($this->class == 'bike' || $this->class == 'yoga')
                {
                    if (false === $statement) {
                        throw new Exception('Invalid prepare statement');
                    }
                    if (false === $statement->execute([
                        ':bookingDate' => $bookingDate->format('Y-m-d'),
                        ':username' => $_COOKIE["member_account"],
                        ':class' => $this->class
                    ])) {
                        throw new Exception(implode(' ', $statement->errorInfo()));
                    }
                }
                else
                {
                    echo "<script>alert('您必須有達人方案才能預約此課程');</script>";
                }
            }
            else if ($result['plan_id'] == "新手方案")
            {
                if ($this->class == 'yoga')
                {
                    if (false === $statement) {
                        throw new Exception('Invalid prepare statement');
                    }
                    if (false === $statement->execute([
                        ':bookingDate' => $bookingDate->format('Y-m-d'),
                        ':username' => $_COOKIE["member_account"],
                        ':class' => $this->class
                    ])) {
                        throw new Exception(implode(' ', $statement->errorInfo()));
                    }
                }
                else if ($this->class == 'bike')
                {
                    echo "<script>alert('您必須有進階方案或達人方案才能預約此課程');</script>";
                }
                else if ($this->class == 'aerobic')
                {
                    {
                        echo "<script>alert('您必須有達人方案才能預約此課程');</script>";
                    }
                }
            }
        }
    }

    public function delete($id)
    {
        $statement = $this->dbh->prepare(
            'DELETE from ' . $this->bookingsTableName . ' WHERE id = :id'
        );
        if (false === $statement) {
            throw new Exception('Invalid prepare statement');
        }
        if (false === $statement->execute([':id' => $id])) {
            throw new Exception(implode(' ', $statement->errorInfo()));
        }
    }
    
    public function findByDate(string $date): ?array
    {
        $statement = $this->dbh->prepare("SELECT * FROM bookings WHERE booking_date = ?");
        $statement->execute([$date]);

        return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findById(int $id): ?array
    {
        $statement = $this->dbh->prepare("SELECT * FROM bookings WHERE id = ?");
        $statement->execute([$id]);

        return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function countBookingDaysByUsername($username)
    {
        $stmt = $this->dbh->prepare("SELECT COUNT(*) AS days FROM bookings WHERE member_account = ?");
        $stmt->execute([$username]);

        $result = $stmt->fetch();

        return $result['days'];
    }

    public function autoDelete()
    {
        $currentDate = date('Y-m-d');

        $query = $this->dbh->prepare('SELECT id FROM bookings WHERE booking_date < :currentDate');
        $query->execute([':currentDate' => $currentDate]);
        $expiredBookings = $query->fetchAll(PDO::FETCH_COLUMN);

        if (!empty($expiredBookings)) {
            $placeholders = rtrim(str_repeat('?,', count($expiredBookings)), ',');
            $deleteQuery = $this->dbh->prepare("DELETE FROM bookings WHERE id IN ($placeholders)");
            $deleteQuery->execute($expiredBookings);
        }
    }
}