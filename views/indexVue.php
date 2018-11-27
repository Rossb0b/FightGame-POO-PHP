<?php
  include("template/header.php")
 ?>

<div class="container">


  <form class="form-control p-5" action="" method="post">
    <p>
      Name : <input type="text" name="name" maxlength="25" />
      <input type="submit" value="Create this personnage" name="create" />
      <input type="submit" value="Use this personnage" name="use" />
    </p>
  </form>

  <?php
    if (isset($message))
    {
      echo '<p>' . $message . '</p>';
    }
  ?>

  <?php
    if (isset($_SESSION['perso']))
    {
  ?>
    <div class="MyPersonnage" style="border:1px solid blue; margin-top:10vh;">
          <h2 class="text-center">My information</h2>
          <p class="ml-4">
            Name : <?= htmlspecialchars($_SESSION['perso']->get_name()); ?> <br />
            Damage : <?= $_SESSION['perso']->get_damage(); ?> <br />
          </p>
    </div>
  <?php    
    }
  ?>

  <div class="ListPersonnages pt-3 d-flex flex-row" style="border:1px solid red; margin-top:5vh;">
    <ul class="ml-2">
      Personnages names :
      <?php 
        foreach($persos as $onePerso)
        {
      ?>  
          <li class="ml-3"><a href="index.php?hitting=<?= $onePerso->get_name(); ?>"><?= $onePerso->get_name(); ?></a></li>
      <?php
        }  
      ?>
    </ul>  

    <ul class="ml-2">
        Personnages damages taken : 
      <?php
        foreach($persos as $onePerso)
        {
      ?>
          <li class="ml-3"><?= $onePerso->get_damage(); ?></li>
      <?php        
        }
      ?>  
    </ul>
  </div>

</div>

 <?php
   include("template/footer.php")
  ?>
