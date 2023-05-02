<html>
    <head>
        <title>後臺管理</title>
    </head>
    <body>
        <button onclick="location.href='backend.php'">回首頁</button>
        <?php
            session_start();
            if (!isset($_SESSION['reloaded'])) {
                $_SESSION['reloaded'] = time();
            }
            else if ($_SESSION['reloaded'] && $_SESSION['reloaded'] == time()) { ?> 
                <script> 
                location.reload(); 
                </script> <?php 
                unset($_SESSION['reloaded']);
            }
            
            $sql=mysqli_connect("140.113.139.50:3307","share","ihaveabigdick","gym");

            $table=[];
            $column=[];
            $row=[];
            $result_t=mysqli_query($sql,"SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='brothers'");
            
            while ($a = mysqli_fetch_row($result_t)) { 
                array_push($table,strtoupper($a[0]));
            }

            foreach($table as $r){
                $result_c=mysqli_query($sql,"SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$r."' ORDER BY ORDINAL_POSITION");
                while ($a = mysqli_fetch_row($result_c)) { 
                    $column[][$r]=$a[0];
                }
            }
            $col_num=[];
            foreach($table as $r){
                $col_num[$r]=0;
            }
            for($i=0;$i<sizeof($column);$i++){
                for($j=0;$j<sizeof($table);$j++){
                    if(!empty($column[$i][$table[$j]]))
                        $col_num[$table[$j]]++;
                }
            }
            for($i=0;$i<sizeof($table);$i++){
                if($table[$i]=='seat')
                    $result_r=mysqli_query($sql,"SELECT * FROM $table[$i] ORDER BY `Field`,`Sequence`");
                elseif($table[$i]=='member')
                    $result_r=mysqli_query($sql,"SELECT * FROM $table[$i] ORDER BY VIP");
                else
                    $result_r=mysqli_query($sql,"SELECT * FROM $table[$i]");
                while ($a = mysqli_fetch_row($result_r)) { 
                    $row[$i][]=$a;
                }
            }

            for($i=0;$i<sizeof($table);$i++){?>
                <table border="solid" align="center">
                    <caption ><font size="6"><?php echo$table[$i]; ?></caption><tr><?php
                    for($j=0;$j<sizeof($column);$j++){
                        if(!empty($column[$j][$table[$i]])){?>
                            <th><?php echo $column[$j][$table[$i]]; ?></th><?php
                        }
                    }?></tr><?php
                    
                    if(array_key_exists($i,$row)){
                        for($j=0;$j<sizeof($row[$i]);$j++){?><tr><?php
                            for($k=0;$k<$col_num[$table[$i]];$k++){?>
                                <td><?php echo $row[$i][$j][$k]; ?></td><?php
                            }?></tr><?php
                        }
                    }
                    else
                        continue;
                    ?>
                </table><br><?php
            }
        ?>
    </body>
</html>
<style>
    button{
        cursor:pointer;
    }
</style>