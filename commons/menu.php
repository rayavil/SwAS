<div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="#">SAS</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="img/logotipo.png" alt="logo"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="img/logotipo.png" alt="logo"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $_SESSION['usuario'];?></div>
                                <div class="profile-data-title">Administrador</div>
                            </div>

                        </div>
                    </li>
                    <!-- <li class="xn-title">Bienvenid@</li> -->
                    <li class="xn-openable ">
                        <a href="#"><span class="fa fa-dashboard"></span> <span class="xn-text">INICIO</span></a>
                        <ul>
                             <li><a href="#"><span class="fa fa-desktop"></span> Escritorio</a><div class="informer informer-primary">2</div></li>

                        </ul>
                    </li>
                    <li class="xn-openable

                    <?php if($pagina == "Areas" || $pagina == "Auditorias" ||$pagina == "Carreras" || $pagina == "Servicios" || $pagina == "Items") { echo 'active'; } ?>">
                        <a href="#"><span class="fa fa-archive"></span> <span class="xn-text">   CATALOGOS</span></a>
                        <ul>

                            <li><a href="auditorias.php"><span class="fa fa-certificate"></span> Auditorias</a></li>
<!--                             <li><a href="#"><span class="fa fa-check-square"></span> Seguimiento</a></li>
 -->
                            <li><a href="items.php" ><span class="fa fa-question-circle"></span> Items</a></li>
                            <li><a href="servicios.php" ><span class="fa fa-tasks active"></span> Servicios</a></li>

                            <li><a href="carreras.php"><span class="fa fa-folder-open"></span> Carreras</a></li>

                        </ul>
                    </li>
                    <li class="xn-openable ">
                        <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">REPORTES</span></a>
                        <ul>

                            <li><a href="#"><span class="fa fa-building-o"></span>Auditorias </a></li>
                            <li><a href="#"><span class="fa fa-tasks"></span> Servicios</a></li>
                            <li><a href="#"><span class="fa fa-users"></span> Alumnos</a></li>


                        </ul>
                    </li>
                    <li class="xn-openable ">
                        <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">CONFIGURACIÓN</span></a>
                        <ul>


                            <li><a href="config.php"><span class="fa fa-wrench"></span> Sistema</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                            <li><a href="#" data-box="#mb-signout" class="mb-control"><span class="fa fa-sign-out"></span> Salir</a></li>

                        </ul>
                    </li>








                </ul>
                <!-- END X-NAVIGATION -->
            </div>
