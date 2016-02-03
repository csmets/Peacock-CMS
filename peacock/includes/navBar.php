<?php

class NavBar{

  public function display(){
    $string = '<nav>
      <img class="logo" src="Images/Icons/PeacockCMS_Logo_Icon.png"/>
      <span class="Peacock-Title">Peacock CMS</span><span class="version">v1.1.0</span>

      <ul>
        <li class="view-site"><a href="../index" target="_blank">VIEW SITE</a></li>
        <li>';

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $name = $peacock->getUserFirstName($username);
    if(!$name){
      $name = $username;
    }

    $userImage = $peacock->getUserAvatar($username);
    if ($userImage){
      $string .= " <img class='img-circle' src='../view/image/".$userImage."' style='height:36px;width:36px'>";
    }
    $string .= " <span class='username'>".$name."</span>";
    $string .= '</li>
                <li class="logout"><a href="logout.php"><i class="fa fa-power-off"></i> logout</a></li>
              </ul>
            </nav>';
    return $string;
  }

}
