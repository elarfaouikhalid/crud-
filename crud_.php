
<?php
$pdo=new PDO("mysql:dbname=crud;host=127.0.0.1","root","");
if(isset($_POST["insert"]))
{
$query="INSERT into(nclient,salaire) client values(:n,:p)";
$var=$pdo->prepare($query);
$var->execute([
    ":n"=>$_POST["txt1"],
    ":p"=>$_POST["txt2"]
]);
$var=null;
$pdo=null;
header('location:crud_.php');
}

if(isset($_GET["delete"]))
{
$sql="DELETE from client where id =:id";
$requete=$db_name->prepare($sql);

$requete->execute([
":id" =>(int)$_GET["delete"]
]);
$requete=null;
$db_name=null;
    header('location:crud_.php');
}
if(isset($_POST["update"]))
{
    
$sql="UPDATE client set nclient=:cl,salaire=:sa where id =:id";
$requete=$db_name->prepare($sql);
    $requete->execute([
        ":id" =>$_POST["code"],
        ":cl" =>$_POST["name"],
        ":sa" =>$_POST["salaire"]
        ]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>curd</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Action 1</a>
                        <a class="dropdown-item" href="#">Action 2</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <form action="crud_.php" method="POST">
    <?php
if(isset($_GET["edit"]))
{?>
<div class="card text-center" style="margin-top: 30px;">
  <div class="card-body">
   <?php $id=$_GET["edit"];
    $db_name=$create->connect($db);

    if($db==null)
    {
        return ;
    }
    $query=$db_name->query("SELECT * from $table where id =$id");
    $query->execute();
    $data=$query->fetchAll(PDO::FETCH_ASSOC);

    foreach($data as $row)
{ ?>
<input type="hidden" name ="code" value="<?php echo $row["id_client"] ;  ?>">
<input type="text" name ="name" value="<?php echo $row["nclient"] ;  ?>" placeholder="enter  name">
<input type="text" name ="salaire" value="<?php echo $row["salaire"] ;  ?>" placeholder="enter salary">
<input type="submit"  name="update" class="btn btn-sm mr-1 btn-success" value ="update">
  </div>
</div>
<?php }
}
?>
    <div class="container">
<div class="row mt-5">
        <div class="col-2">
        <table class="table table-striped">
<thead>
        <tr>
            <th>name</th>
            <th>salary</th>
            <th>action</th>
        </tr>
</thead>
<tbody>
<?php if($pdo==null)
{
    return;
}
        $db=$pdo->query("SELECT * from client");
        $db->execute();
        $data=$db->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $row)
        {
        ?>
        <tr>
        <td><?php echo  $row["nclient"]; ?></td>
        <td><?php echo  $row["salaire"]; ?></td>  
        <td><input type="" name="id" value="<?php $row["code"]; ?>"></td>
        <td><a type="submit" href="crud_.php?edit=<?php echo $row["id_client"]; ?>" class="btn btn-sm mr-1 btn-primary">edit</a></td>
          <td><a type="submit" href="crud_.php?delete=<?php echo $row["id_client"]; ?>" class="btn btn-sm mr-1 btn-danger">delete</a></td> 
        </tr>
        <?php }
       $db=null;
        $pdo=null;
        ?>
        <tr>
            <td><input type="text" name="txt1"  placeholder="enter your name"></td>
            <td><input type="text" name="txt2" placeholder="enter your prix" ></td>
            <td><button name="insert" class="btn btn-success btn-sm">insert</button></td>
        </tr>
</tbody>
    </table>
        </div>
</div>
    </div>
    </form>
</body>
</html>



 