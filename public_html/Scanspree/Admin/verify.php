<?php
session_start();
include("connection.php");

if(isset($_GET['email']) && isset($_GET['v_code']))
{
    $sqlq = "SELECT * FROM  `admin_login` WHERE `email`='$_GET[email]' AND `ver_code`='$_GET[v_code]'";
    $resultrun=$conn->query($sqlq);
    if ($resultrun == TRUE)
    {
       if($resultrun->num_rows ==1)
       {
        $row = $resultrun->fetch_assoc();
        if($row['is_verified'] == 0)
        {
          $update = "UPDATE  `admin_login` SET `is_verified`= '1' WHERE `email`='$row[email]'";
          $upresult=$conn->query($update);
          if($upresult == TRUE)
          {
            echo "<script>
            alert('Email verification successful');
            </script>";
            
            $_SESSION['logged_in'] = TRUE;
            $_SESSION['username'] = $row['email'];
            header("location: dash.php");
          }
          else
          {
            echo "<script>
            alert('cannot run query');
            window.location.href='reg.php';
            </script>";
          }
        }
        else
        {
            echo "<script>
            alert('Email already verified');
            window.location.href='homepg.php';
            </script>";
        }
       }
    }
    else
    {
    echo "<script>
    alert('Cannot run query');
    window.location.href='reg.php';
    </script>" 
    ;
    }
}


?>