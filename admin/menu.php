<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
    <link href='https://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../admin/tableaudebord.css">

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                            <span data-feather="home"></span>
                            Tableau de bord de la boutique
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=affichage">

                            Liste des articles
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="?action=membre">
                            <span data-feather="membre"></span>
                            Membres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=achats">
                            <span data-feather="bar-chart-2"></span>
                            Achats
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>
</body>
</html>
