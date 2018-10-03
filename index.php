<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CFPTSocialBook</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
  <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.css">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" type='image/png' href="img/Logo.png">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
  <!-NAVBAR->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Social CFPT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <!-Couverture->
  <div class="row">
    <div class="col-md-2"><img src="img/Logo.png" class="ImgLogo" alt="Responsive image"></div>
    <div class="col-md-10"><img src="img/Couverture.png" class="ImgCouverture" alt="Responsive image"></div>
  </div>
  <!-Container-ADD_POST->
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-10">
      <div class="form-group">
        <form method="POST" action="addContent.php" enctype="multipart/form-data">
          <fieldset>
            <div class="form-group">
              <input type="file" class="form-control-file" id="inputFile" name="inputFile[]" aria-describedby="fileHelp" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|images/*" multiple>
              <small>
                Ce bouton permet de sélectionner des images et de les poster sur cette page.
              </small>
              <textarea class="form-control" id="textarea" name="textArea" rows="3"></textarea>
              <button type="submit" name="submitContent" class="btn btn-primary">Poster</button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <!Containter-POST
  <div class="row">
  <div class="jumbotron">
    <h1>Posts</h1>
    <?php
    /**
    * Micael Rodrigues
    * T.IS-E2B
    * 12.09.2018
    */
    require_once 'showContent.php';
    require_once 'library.php';

    //var_dump($ShowPosts);
    foreach ($ShowPosts as $Posts)
    {
      $listImgs = GetPostsImagebyId($Posts['idPost']);
      //  echo $Posts['idPost'];
      ?>

      <div class="card mb-4">
        <div class="row">
          <?php

          foreach($listImgs as $ShowPicture)
          {
            ?>

            <div class="col-xs-6 col-md-6">
              <img class="img-thumbnail img-responsive" src="img/uploads/<?php echo $ShowPicture['NameImage']; ?>">
            </div>

            <html>
            <?php
          }
          ?>
        </div>
        <div class="card-body">
          <p class="card-text"><?php echo $Posts['Commentaire']; ?></p>
          <i class="fas fa-edit" data-toggle="modal" data-target="#updateModal<?php echo $Posts['idPost'];?>"></i>
          <i class="fas fa-trash" data-toggle="modal" data-target="#deleteModal<?php echo $Posts['idPost'];?>"></i>
        </div>
        <div class="card-footer text-muted">
          <?php echo $Posts['DatePublication']; ?>
        </div>

        <!-- delete modal box-->
        <div class="modal" id="deleteModal<?php echo $Posts['idPost'];?>" tabindex="-1" role="dialog" aria-labelledby="deleteModal<?php echo $Posts['idPost'];?>" aria-hidden="true">
          <form action="deletePost.php" method="post">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Suppression Post N°<?php echo $Posts['idPost'];?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input name="idPostModal" id="idPostModal" type="hidden" value="<?php echo $Posts['idPost'];?>">
                  Etes-vous sur de vouloir supprimer le post <?php echo $Posts['idPost'];?> ?
                </div>
                <div class="modal-footer">
                  <button type="submit" name="deletePost" class="btn btn-primary">Supprimer</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Update modal box-->
        <div class="modal" id="updateModal<?php echo $Posts['idPost'];?>" tabindex="-1" role="dialog" aria-labelledby="updateModal<?php echo $Posts['idPost'];?>" aria-hidden="true">
          <form action="updatePost.php" method="post">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edition du Post N° <?php echo $Posts['idPost'];?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <input name="idPostModal" id="idPostModal" type="hidden" value="<?php echo $Posts['idPost'];?>">
                  <p><?php echo $Posts['Commentaire'];?></p>
                  <textarea rows="4" cols="50" name="CommentModification" form="usrform"></textarea>
                  <?php
                  $ImageSelect = GetPostsImagebyId($Posts['idPost']);
                  foreach ($ImageSelect as $Image) {
                    ?>
                    <form>
                      <INPUT type="checkbox" name="ImageSelect" value="1"> <?php echo $Image['NameImage'] ?>
                      </form>
                      <?php
                    }
                    ?>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" name="updatePost" class="btn btn-primary">Editer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


          <?php
          //echo "Salut". " " . $Posts['idPost'];
        }
        ?>

      </div>
    </div>
  </div>
</body>
<footer class="footer">
  <div class="footer-container">
    ©CFPTSocialBook
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
