<?php 
if (USER_INFO[0]["groupID"]=='1'){
// navbar admin
echo '
<nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a href="index.php"><img src="../images/logo.png" class="logo" alt="Logo" srcset=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto  mb-lg-0">
        <li class="nav-item">
          <a class="nav-link  white-color" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown  ">
          <a class="nav-link dropdown-toggle white-color " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item black-color" href="?was=Add_Categorie">Add Category</a></li>
              <li><a class="dropdown-item black-color" href="?was=show_cat">My Categories</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown  ">
          <a class="nav-link dropdown-toggle white-color " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Items</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item black-color" href="?was=add">Add Item</a></li>
              <li><a class="dropdown-item black-color" href="?was=ShowTab">My Items</a></li>
            </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link white-color" href="?was=MangeUser">MangeUsers</a>
        </li>
        <li class="nav-item dropdown ">
            <a class="white-color nav-link dropdown-toggle mygreencolor" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Currency</a>
            <ul class=" dropdown-menu" aria-labelledby="navbarDropdown">
              <li data-wahrnug="TND" class="dropdown-item black-color <?php if (isset($_COOKIE["currency"])&&($_COOKIE["currency"]=="TND")){echo " active";}?><a class="text-decoration-none black_a_tag" href="index.php?was=add&currency=TND">TND</a></li>
              <li data-wahrnug="EURO" class="dropdown-item black-color  <?php if (isset($_COOKIE["currency"])&&($_COOKIE["currency"]=="EURO")){echo " active";}?> <a class="text-decoration-none black_a_tag " href="index.php?was=add&currency=EURO">EURO</a></li>
              <li data-wahrnug="usa" class="dropdown-item black-color <?php if (isset($_COOKIE["currency"])&&($_COOKIE["currency"]=="USA")){echo " active";}?> <a class="text-decoration-none black_a_tag" href="index.php?was=add&currency=USA">USA</a></li>
            </ul>
      </li>
      </ul>
      <li class="nav-item dropdown mymargin-log_out">
          <a class="nav-link dropdown-toggle mygreencolor" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            '. USER_INFO[0]["username"].'
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item black-color" href="?was=modify_account">Modify Account</a></li>
            <li><a class="dropdown-item black-color" href="?was=log_out">Log Out</a></li>
          </ul>
      </li>
    </div>
  </div>
</nav>
';
// navbar user
}else{
  echo '
  <nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a href="index.php"><img src="../images/logo.png" class="logo" alt="Logo" srcset=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto  mb-lg-0">
        <li class="nav-item">
          <a class="nav-link  white-color" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  white-color" aria-current="page" href="?was=show_cat">Categories</a>
        </li>
        <li class="nav-item dropdown  ">
          <a class="nav-link dropdown-toggle white-color " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Items</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item black-color" href="?was=add">Add Item</a></li>
              <li><a class="dropdown-item black-color" href="?was=ShowTab">My Items</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown ">
            <a class="white-color nav-link dropdown-toggle mygreencolor" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Currency</a>
            <ul class=" dropdown-menu" aria-labelledby="navbarDropdown">
              <li data-wahrnug="TND" class="dropdown-item black-color <?php if (isset($_COOKIE["currency"])&&($_COOKIE["currency"]=="TND")){echo " active";}?><a class="text-decoration-none black_a_tag" href="index.php?was=add&currency=TND">TND</a></li>
              <li data-wahrnug="EURO" class="dropdown-item black-color  <?php if (isset($_COOKIE["currency"])&&($_COOKIE["currency"]=="EURO")){echo " active";}?> <a class="text-decoration-none black_a_tag " href="index.php?was=add&currency=EURO">EURO</a></li>
              <li data-wahrnug="usa" class="dropdown-item black-color <?php if (isset($_COOKIE["currency"])&&($_COOKIE["currency"]=="USA")){echo " active";}?> <a class="text-decoration-none black_a_tag" href="index.php?was=add&currency=USA">USA</a></li>
            </ul>
      </li>
      </ul>
      <li class="nav-item dropdown mymargin-log_out">
          <a class="nav-link dropdown-toggle mygreencolor" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            '. USER_INFO[0]["username"].'
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item black-color" href="?was=modify_account">Modify Account</a></li>
            <li><a class="dropdown-item black-color" href="?was=log_out">Log Out</a></li>
          </ul>
      </li>
    </div>
  </div>
</nav>
';
// navbar user
}