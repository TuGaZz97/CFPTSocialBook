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
                    <fieldset>
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="inputFile" aria-describedby="fileHelp" accept="image/*" multiple>
                            <small>
                                Ce bouton permet de sélectionner des images et de les poster sur cette page.
                            </small>
                            <textarea class="form-control" id="textarea" rows="3"></textarea>
                            <button type="submit" class="btn btn-primary">Poster</button>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <!Containter-POST
        <div class="row">
            <div class="jumbotron">
            <h1>Posts</h1>
            </div>
        </div>
    </body>
    <footer class="footer">
        <div class="footer-container">
            ©CFPTSocialBook
        </div>
    </footer>
</html>