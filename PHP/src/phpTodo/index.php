<?php session_start();

if(!isset($_SESSION["incomplete"])){
    $_SESSION["incomplete"]=array();
    $_SESSION["inc"]=0;

}
if(!isset($_SESSION["complete"])){
    $_SESSION["complete"]=array();
    $_SESSION["comp"]=0;

}
if(isset($_GET["name2"])){
if(isset($_POST["task"])&& !empty($_POST['task'])){
   
    
     
        $task=$_POST["task"];
        $_SESSION["comp"]+=1;
        $index=$_SESSION["comp"];
        $_SESSION["complete"][$index]=$task;

    }
}
    
else if(isset($_GET["name1"])){
    if(isset($_POST["task"])&& !empty($_POST['task'])){


        
    $task=$_POST["task"];
    $_SESSION["inc"]+=1;
    $index=$_SESSION["inc"];
    $_SESSION["incomplete"][$index]=$task;
    }
    
}
else{
    if(isset($_POST["task"])&& !empty($_POST['task'])){


        
        $task=$_POST["task"];
        $_SESSION["inc"]+=1;
        $index=$_SESSION["inc"];
        $_SESSION["incomplete"][$index]=$task;
        }

}



if(isset($_GET["del"])){
    $del=$_GET["del"];
    unset($_SESSION["incomplete"][$del]);

}
if(isset($_GET["del2"])){
    $del=$_GET["del2"];
    unset($_SESSION["complete"][$del]);

}

if(isset($_GET['name'])){
    $del=$_GET["name"];
    if (($key = array_search($del, $_SESSION["incomplete"])) !== false) {
        unset($_SESSION["incomplete"][$key]);
    }
}
if(isset($_GET['name2'])){
    $del=$_GET["name2"];
    if (($key = array_search($del, $_SESSION["complete"])) !== false) {
        unset($_SESSION["complete"][$key]);
    }
}

if(isset($_GET['check'])){
    $_SESSION["comp"]+=1;
    $index=$_SESSION["comp"];
    $shift=$_GET['check'];
    $_SESSION["complete"][$index]=$_SESSION["incomplete"][$shift];
    unset($_SESSION["incomplete"][$shift]);

}
if(isset($_GET['check2'])){
    $_SESSION["inc"]+=1;
    $index=$_SESSION["inc"];
    $shift=$_GET['check2'];
    $_SESSION["incomplete"][$index]=$_SESSION["complete"][$shift];
    unset($_SESSION["complete"][$shift]);

}

?>


<html>
    <head>
        <title>TODO List</title>
        <link href="style.css" type="text/css" rel="stylesheet">
         <script>
             function transfer(E){
                window.location.href="?check="+E;
                
             }
             function transfer2(E){
                window.location.href="?check2="+E;
                
             }
         </script>
    </head>
    <body>
        <div class="container">
            <h2>TODO LIST</h2>
            <h3>Add Item</h3>
            <form action="index.php" method="POST">
            <p>
                <input id="new-task" type="text" name="task" value = "<?php echo (isset($_GET['name']))?$_GET['name']:(isset($_GET['name2'])?$_GET['name2']:'');?>"> <input class="btn" type="submit" value = "<?php echo (isset($_GET['name']))?"Update":(isset($_GET['name2'])?"Update":"Add");?>"/>
            </p>
            </form>
            <h3>Todo</h3>
            <ul id="incomplete-tasks">
             <?php   if(isset($_POST['task'])||isset($_SESSION["incomplete"])){
                 foreach($_SESSION["incomplete"] as $key => $val){ ?>
                 <li><input type="checkbox" onclick="transfer(this.value)" value="<?php echo($key); ?>"><label><?php echo("$val"); ?></label><input type="text"> <a href="?name=<?php echo($val); ?>" class="edit" >Edit</a><a class="delete" href="?del=<?php echo($key); ?>">Delete</a></li>
                     
                 
            <?php
            }

             } ?>
                
                
            </ul>
    
            <h3>Completed</h3>
            <ul id="completed-tasks">
            <?php   if(isset($_SESSION["complete"])){
                 foreach($_SESSION["complete"] as $key => $val){ ?>
                 <li><input type="checkbox" checked value="<?php echo($key); ?>" onclick="transfer2(this.value)"><label><?php echo("$val"); ?></label><input type="text"> <a href="?name2=<?php echo($val); ?>" class="edit" >Edit</a><a class="delete" href="?del2=<?php echo($key); ?>">Delete</a></li>
                     
                 
            <?php
            }

             } ?>
               
            </ul>
        </div>
    
    </body>
</html>