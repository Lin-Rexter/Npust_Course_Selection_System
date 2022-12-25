<?php
    // 資料庫操作功能模組
    class Mysql{
        function __construct($link){
            $this -> link = $link; // 資料庫連線模組
            // 一般資料型態名稱所對應的bind_param函數的型態名稱
            $this -> type_dict = array(
                'NULL' => 's',
                'string' => 's',
                'int' => 'i',
                'float' => 'd',
                'BLOB' => 'b'
            );
        }

        // $sql: sql命令

        // 查詢資料
        function select(array $sql = null){
            if(count($sql) < 3){
                $this -> select = "SELECT {$sql[0]} FROM {$sql[1]}";
            }else{
                $this -> select = "SELECT {$sql[0]} FROM {$sql[1]} {$sql[2]}"; // $sql[2]: WHERE、ORDER BY...
            }

            // 檢查資料表是否存在
            $check_table = $this -> link->query("SHOW TABLES LIKE '$sql[1]'");

            if($check_table && $check_table->num_rows > 0){
                // 檢查資料表裡是否存在資料
                $check_row = $this -> link->query($this -> select)->num_rows;

                if($check_row > 0){
                    // 使用prepare預備執行，較安全、可防止SQL注入
                    $this -> result = $this -> link->prepare($this -> select);
                    //$this -> result->bind_param();
                    $this -> result->execute(); // 執行
                    $this -> result = $this -> result->get_result(); // 取得結果
                    //$this -> result = $this -> link->query($this -> select);
                    return [true, $this -> result];
                }else{
                    return [false, "資料表內無資料存在!"];
                }
            }else{
                return [false, "資料表不存在!"];
            }
        }

        // 新增資料(可一次新增多筆)
        function insert(array $sql){
            try{
                for($index=0; $index<count($sql); $index++){
                    $Sql = $sql[$index]; // 每一個要執行的插入語句
                    $values = "";
                    $types = "";

                    // str_repeat函數: 第一個欄位為要增加的字串，第二個欄位為要增加的總數量
                    $values = str_repeat('?, ', count($Sql[1])-1).'?'; // 根據欄位值數量增加對應的問號，問號為於bind_param函數的綁定值
                    for($i=0; $i<count($Sql[1]); $i++){ 
                        $types.=$this -> type_dict[gettype($Sql[1][$i])]; // 儲存欄位值各自的類型名稱，並通過$this -> type_dict轉換類型名稱
                    }
                    if(count($Sql) < 3){
                        $this -> select = "INSERT INTO {$Sql[0]} VALUES ($values)";
                    }else{
                        $this -> select = "INSERT INTO {$Sql[0]} VALUES ($values) {$Sql[2]}";
                    }
                    /*
                    print_r($sql);
                    print_r($values);
                    print_r($values_name);
                    print_r($types);
                    print_r($this -> select);
                    */
                    // 使用prepare預備執行，較安全、可防止SQL注入
                    $this -> result = $this -> link->prepare($this -> select);
                    // bind_param函數第一個欄位為類型，第二個參數為要綁定問號的參數
                    $this -> result->bind_param($types, ...$Sql[1]);
                    // 執行
                    $this -> result->execute();
                }
            }catch(Exception $e){
                echo $e->getMessage();
                die();
            }
        }

        // 更新資料
        function update(array $sql){
            try{
                for($index=0; $index<count($sql); $index++){
                    $Sql = $sql[$index]; // 每一個要執行的插入語句
                    
                    $keys = $Sql[1]; // 取得資料表所有的欄位名稱，用於問號的數量
                    $values = ""; // 各欄位名稱搭配問號
                    $types = ""; // 各欄位屬性的資料類型

                    // 根據欄位值數量增加對應的問號，問號為bind_param函數的綁定值
                    $dot = 0;
                    foreach($keys as $key){
						$dot+=1;
						$values.="$key=?";
						if($dot < count($Sql[1])){
							$values.=', ';
						}
                    }

                    // 儲存欄位值各自的類型名稱，並通過設定的$this -> type_dict轉換類型名稱
                    for($i=0; $i<count($Sql[2]); $i++){ 
                        $types.=$this -> type_dict[gettype($Sql[2][$i])];
                    }

                    if(count($Sql) < 3){
                        $this -> select = "UPDATE {$Sql[0]} SET $values";
                    }else{
                        $this -> select = "UPDATE {$Sql[0]} SET $values {$Sql[3]}";
                    }

                    /*
                    print_r($sql);
                    print_r($values);
                    print_r($values_name);
                    print_r($types);
                    print_r($this -> select);
                    */

                    $this -> result = $this -> link->prepare($this -> select);
                    $this -> result->bind_param($types, ...$Sql[2]);
                    $this -> result->execute();
                }
            }catch(Exception $e){
                echo $e->getMessage();
                die();
            }
        }

        // 刪除資料
        function delete(array $sql){
            for($index=0; $index<count($sql); $index++){
                $Sql = $sql[$index]; // 每一個要執行的插入語句

                $this -> select = "DELETE FROM {$Sql[0]} {$Sql[1]}";

                $this -> result = $this -> link->prepare($this -> select);
                //$this -> result->bind_param();
                $this -> result->execute();
            }
        }

        // 當某一函數執行完時觸發
        function __destruct(){
            //mysqli_free_result($this-> result); // POP面向過程用
            if(isset($this -> result)){
                $this -> result->free_result(); // 釋放內存
            }
            $this -> link->close(); // 關閉連線

            // POD關閉方式(2種)
            //$this -> link = null;
            //$this -> link -> close();
        }
    }
