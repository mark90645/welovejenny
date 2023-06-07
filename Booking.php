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
        $haveplan = $this->dbh->prepare('SELECT * FROM  plan_choose  WHERE member_account = "' . $_COOKIE["member_account"] . '"');
        $haveplan->execute();
        if ($haveplan->rowCount() === 0) {
            echo "<script>alert('您需要先選擇方案!');</script>";
        } else {
            $plan_first = $this->dbh->prepare('SELECT * FROM  plan_choose  WHERE plan_id = "達人方案" AND member_account = "' . $_COOKIE["member_account"] . '"');
            $plan_second = $this->dbh->prepare('SELECT * FROM  plan_choose  WHERE plan_id = "進階方案" AND member_account = "' . $_COOKIE["member_account"] . '"');
            $plan_third = $this->dbh->prepare('SELECT * FROM  plan_choose  WHERE plan_id = "新手方案" AND member_account = "' . $_COOKIE["member_account"] . '"');
            $statement = $this->dbh->prepare(
                'INSERT INTO ' . $this->bookingsTableName . ' (booking_date, member_account, class_type) VALUES (:bookingDate, :username, :class)'
            );
            if ($plan_first->rowCount() === 1)
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
            else if ($plan_second->rowCount() === 1)
            {
                if ($this->class = 'bike' || 'yoga')
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
            else if ($plan_third->rowCount() === 1)
            {
                if ($this->class = 'yoga')
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
                else if ($this->class = 'bike')
                {
                    echo "<script>alert('您必須有進階方案或達人方案才能預約此課程');</script>";
                }
                else if ($this->class = 'aerobic')
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
}