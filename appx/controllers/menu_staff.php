<nav class="navbar navbar-expand-lg navbar-light bg-gray-3">
    <a class="navbar-brand" href="#"><img src="img/logo.png" class="image-responsive" style="height: 4vh;"> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Master
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#!Customer"><i class="fas fa-chess-king"></i>&nbsp Customer</a>
                    <a class="dropdown-item" href="#!Others"><i class="fas fa-chess-king"></i>&nbsp Others</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>

            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" ng-model="searchItem" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" ng-click="getSearchItem(searchItem)" type="button">Search</button>
        </form>
    </div>
</nav>