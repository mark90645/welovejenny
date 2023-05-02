<!DOCTYPE html>
<html>  
    <div style="width:900px;margin:0 auto;color:purple"> 
    <h1 style="text-align:center;color:black;">最新資料表狀況</h1>
    <div class="a">  
        <?php
            define('DB_SERVER', 'localhost');
            define('DB_USERNAME', 'share');
            define('DB_PASSWORD', 'ihaveabigdick');
            define('DB_NAME', 'gym');
            $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='gym'";
            $result_2 = mysqli_query($link, $sql);

            if (mysqli_num_rows($result_2) > 0) {
                while($row = mysqli_fetch_assoc($result_2)) {
                    // 顯示table名稱
                    echo "<h3>" . $row['TABLE_NAME'] . "</h3>";

                    // 取得table的所有資料
                    $sql = "SELECT * FROM " . $row['TABLE_NAME'];
                    $result_4 = mysqli_query($link, $sql);

                    // 顯示table的所有資料
                    echo "<table>";
                    echo "<tr>";
                    while ($column = mysqli_fetch_field($result_4)) {
                        echo "<th>" . $column->name . "</th>";
                    }
                    echo "</tr>";

                    while ($data = mysqli_fetch_assoc($result_4)) {
                        echo "<tr>";
                        foreach ($data as $value) {
                            echo "<td>" . $value . "</td>";
                        }
                        echo "</tr>";
                    }

                    echo "</table>";
                }
            } else {
                echo "沒有結果";
            }

            mysqli_close($link);
        ?>
        </div>
    </div>
</html>
<style>
.a{
    text-align:center;
}
.a table {
    border-collapse: collapse;
    margin: 0 auto;
    color:purple;
}

.a th, .a td {
    border: 1px solid black;
    padding: 5px;
    color:purple;
}
</style>