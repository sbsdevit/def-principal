<div class="">
    <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
        <ul class="nav nav-list">
            <li class="hover">
                <a class="dropdown-toggle" href="#">
                    <i class="menu-icon fa fa-cart-arrow-down bigger-210"></i>
                    <span class="menu-text">
                        Nos commandes
                        <span class="badge badge-danger">0</span>
                    </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="hover">
                        <a href="#">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Bon de commande
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="#">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Carnet des commandes
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>

            <li class="hover">
                <a class="dropdown-toggle" href="#">
                    <i class="menu-icon fa fa-database bigger-210"></i>
                    <span class="menu-text">Gestion de stock</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="hover">
                        <a href="#">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Nos articles
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="http://localhost:8082/stock">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Gestion des stock
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="#" target="_blanc">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Entrées en stock
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="#http://localhost:8082/facturation">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Vente de marchandises
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>

            <li class="hover">
                <a class="dropdown-toggle" href="#">
                    <i class="menu-icon fa fa-shopping-basket bigger-210"></i>
                    <span class="menu-text">Nos ventes</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="hover">
                        <a href="#">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Nouveau ticket
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="#">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Ventes journalières
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>

            <li class="hover">
                <a class="dropdown-toggle" href="#">
                    <i class="menu-icon fa fa-credit-card bigger-210"></i>
                    <span class="menu-text">Caisse et comptabilité</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="hover">
                        <a href="#">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Clôturer la caisse
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>

            <li class="hover" style="position : absolute; right :1px">
                <a class="dropdown-toggle" href="#">
                    <i class="menu-icon fa fa-user bigger-210"></i>
                    <span class="menu-text">
                        Utilisateur en ligne : <?= $_SESSION['IDUSER']; ?>
                        <span class="badge badge-success">.</span>
                    </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="hover">
                        <a href="#">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Mon profil
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="../logout_assujetti.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            se déconnecter
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
        </ul><!-- /.nav-list -->
    </div><!-- .sidebar -->
</div>