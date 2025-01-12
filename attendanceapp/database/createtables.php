<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path."/attendanceapp/database/database.php";
function clearTable($dbo,$tabName)
{
    $c = "delete from :tabName";
    $s = $dbo->conn->prepare($c);
    try{
        $s->execute([":tabName"=>$tabName]);
    }
    catch(PDOException $e){
       
    }
}
$dbo = new Database();
$c = "create table student_details
(
id int auto_increment primary key,
roll_no varchar(20) unique,
name varchar(50)
)";
$s = $dbo->conn->prepare($c);
try{
    $s->execute();
    echo "<br> student_detailsTable created successfully";
}

catch(PDOException $e){
    echo "<br>student_details Table not created";
}

$c = "create table course_details
(
id int auto_increment primary key,
code varchar(20) unique,
title varchar(50),
credit int
)";
$s = $dbo->conn->prepare($c);
try{
    $s->execute();
    echo "<br> course_details Table created successfully";
}

catch(PDOException $e){
    echo "<br> course_details Table not created";
}

$c = "create table faculty_details
(
id int auto_increment primary key,
user_name varchar(20) unique,
name varchar(100),
password varchar(50)
)";
$s = $dbo->conn->prepare($c);
try{
    $s->execute();
    echo "<br> faculty_details Table created successfully";
}

catch(PDOException $e){
    echo "<br> faculty_details Table not created";
}

$c = "create table session_details
(
id int auto_increment primary key,
year int,
term varchar(50),
unique(year, term)
)";
$s = $dbo->conn->prepare($c);
try{
    $s->execute();
    echo "<br> session_details Table created successfully";
}

catch(PDOException $e){
    echo "<br> session_details Table not created";
}

$c = "create table course_registration
(
student_id int,
course_id int,
session_id int,
primary key (student_id, course_id, session_id)
)";
$s = $dbo->conn->prepare($c);
try{
    $s->execute();
    echo "<br> course_registration Table created successfully";
}

catch(PDOException $e){
    echo "<br> course_registration Table not created";
}

$c = "create table course_allotment
(
faculty_id int,
course_id int,
session_id int,
primary key (faculty_id, course_id, session_id)
)";
$s = $dbo->conn->prepare($c);
try{
    $s->execute();
    echo "<br> course_allotment Table created successfully";
}

catch(PDOException $e){
    echo "<br> course_allotment Table not created";
}

$c = "create table attendance_details 
(
faculty_id int,
course_id int,
session_id int,
student_id int,
on_date date,
status varchar(10),
primary key (faculty_id, course_id, session_id, student_id, on_date)
)";
$s = $dbo->conn->prepare($c);
try{
    $s->execute();
    echo "<br> attendance_details Table created successfully";
}

catch(PDOException $e){
    echo "<br> attendance_details Table not created";
}

$c = "insert into student_details 
(roll_no,name)
values
     ('TU001', 'Ram Sharma'),
    ('TU002', 'Sita Adhikari'),
    ('TU003', 'Govinda Thapa'),
    ('TU004', 'Krishna Gautam'),
    ('TU005', 'Anita Khatri'),
    ('TU006', 'Suresh Tamang'),
    ('TU007', 'Maya Pun'),
    ('TU008', 'Durga Kshetri'),
    ('TU009', 'Bhim Paudel'),
    ('TU010', 'Rita Adhikari')";
    $s = $dbo->conn->prepare($c);
    try{
        $s->execute();
    }
    
    catch(PDOException $e){
        echo "<br> duplicate entry";
    }

    $c = "insert into faculty_details 
    (id,user_name,password,name)
    values
    (1, 'ram', 'ram123', 'Ram Sharma'),
    (2,'sita', 'sita123', 'Sita Adhikari'),
    (3, 'govinda', 'govinda123', 'Govinda Thapa'),
    (4, 'krishna', 'krishna123', 'Krishna Gautam')";
        $s = $dbo->conn->prepare($c);
        try{
            $s->execute();
        }
        
        catch(PDOException $e){
            echo "<br> duplicate entry";
        }

        $c = "insert into session_details 
        (year,term)
        values
        (2024,'spring semester'),
        (2025,'fall semester')";
            $s = $dbo->conn->prepare($c);
            try{
                $s->execute();
            }
            
            catch(PDOException $e){
                echo "<br> duplicate entry";
            }

            $c = "insert into course_details 
            (title,code,credit)
            values
            ('DBMS', 'DBMS01',2),
            ('SE', 'SE02',3),
            ('OS', 'OS03',2),
            ('SL', 'SL04',3),
            ('NM', 'NM05',3)";
                $s = $dbo->conn->prepare($c);
                try{
                    $s->execute();
                }
                
                catch(PDOException $e){
                    echo "<br> duplicate entry";
                }

    //if any record already exists in table delete them
    clearTable($dbo,"course_registration");
    $c= "insert into course_registration
    (student_id, course_id, session_id)
    values
    (:sid,:cid,:sessid)";
    $s = $dbo->conn->prepare($c);
    //iterate over all students in the database
    //for each student choose at max 3 random course from 1 to 5
    for ($i=1;$i<=10;$i++){
        for ($j=1;$j<=3;$j++){
            $cid=rand(1,5);
            //insert the selected course into course_registration table for
            //session 1 ans student_id $1
            try{
                $s->execute([':sid'=>$i,':cid'=>$cid,':sessid'=>1]);
            }
            catch(PDOException $e){
                // echo "<br> duplicate entry";
    
        }

        //repeat for session 2
        $cid=rand(1,5);
            //insert the selected course into course_registration table for
            //session 1 ans student_id $i
            try{
                $s->execute([':sid'=>$i,':cid'=>$cid,':sessid'=>2]);
            }
            catch(PDOException $e){
        }
    }
}

    //if any record already exists in table delete them
    clearTable($dbo,"course_allotment");
    $c= "insert into course_allotment
    (faculty_id, course_id, session_id)
    values
    (:fid,:cid,:sessid)";
    $s = $dbo->conn->prepare($c);
    //iterate over all teachers 4
    //for each student choose at max 2 random course from 1 to 5
    for ($i=1;$i<=4;$i++){
        for ($j=1;$j<=2;$j++){
            $cid=rand(1,5);
            //insert the selected course into course_allotment table for
            //session 1 ans faculty_id $i
            try{
                $s->execute([':fid'=>$i,':cid'=>$cid,':sessid'=>1]);
            }
            catch(PDOException $e){
    
        }

        //repeat for session 2
        $cid=rand(1,5);
            //insert the selected course into course_allotment table for
            //session 1 ans student_id $1
            try{
                $s->execute([':fid'=>$i,':cid'=>$cid,':sessid'=>2]);
            }
            catch(PDOException $e){
        }
    }
    }

//1:21:17
?>

