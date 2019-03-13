<nav class="navbar navbar-expand-lg navbar-warning bg-warning mb-3">
   <div class="container ml-3">
    <a class="navbar-brand font-weight-bold text-dark" href="<?php echo URL_ROOT;?>"><?php echo SITE_NAME;?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars fa-lg py-1 text-dark"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <?php if(isset($_SESSION['user_id']) and isset($_SESSION['user_type'])): ?>

                <?php if($_SESSION['user_type']!=2): ?>
            <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo URL_ROOT;?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo URL_ROOT;?>/users/controlpanel">My Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo URL_ROOT;?>/cats">My Cat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo URL_ROOT;?>/cats/search">Search</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo URL_ROOT;?>/cats/ceremony">Ceremony</a>
            </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?php echo URL_ROOT;?>/adminusers/index">Users</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="<?php echo URL_ROOT;?>/admincats/index">Cats</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?php echo URL_ROOT;?>/admins">General Info</a>
                </li>
               <?php endif; ?>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo URL_ROOT;?>/pages/about">About</a>
            </li>

        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Welcome <?php echo $_SESSION['user_name']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?php echo URL_ROOT;?>/users/logout">Logout</a>
                </li>
            <?php else :?>
            <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo URL_ROOT;?>/users/register">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo URL_ROOT;?>/users/login">Login</a>
            </li>
            <?php endif; ?>
        </ul>

    </div>
   </div>
</nav>