<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CFPTSocialBook</title>
        <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
        <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.css">
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" type='image/png' href="img/Logo.png">
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
            <div class="col-md-10"><img src="img/Couverture.jpg" class="ImgCouverture" alt="Responsive image"></div>
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

                foreach ($ShowPosts as $Posts) {
                ?>
                <div class="card mb-4">
                    <img class="card-img-top" src="img/uploads/<?php $ShowPicture['NameImage'] ?>">
                    <div class="card-body">
                        <h2 class="card-title">Post</h2>
                        <p class="card-text"><?php $Posts['Commentaire'] ?></p>
                        <a href="#" class="btn btn-info">Modifier &rarr;</a>
                        <a href="#" class="btn btn-danger">Supprimer</a>
                    </div>
                    <div class="card-footer text-muted">
                        <?php $Posts['DatePublication'] ?>
                    </div>
                    <?php
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
</html>