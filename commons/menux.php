<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    
                    <!-- POWER OFF -->
                    <li class="xn-icon-button pull-right last">
                        <a href="#"><span class="fa fa-power-off"></span></a>
                        <ul class="xn-drop-left animated zoomIn">
                            <li><a href="pages-lock-screen.html"><span class="fa fa-user"></span> Perfil</a></li>
                            <li><a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Salir</a></li>
                        </ul>                        
                    </li> 
                    <!-- END POWER OFF -->
                    <!-- MESSAGES -->
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-bullhorn"></span></a>
                        <div class="informer informer-info">4</div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-bullhorn"></span> Notificaciones</h3>                                
                                <div class="pull-right">
                                    <span class="label label-info">4 </span>
                                </div>
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-online"></div>
                                    <span class="contacts-title">Notificacion 1</span>
                                    <p>Texto de la notificacion.</p>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <div class="list-group-status status-online"></div>
                                    <span class="contacts-title">Notificacion 2</span>
                                    <p>Texto de la notificacion.</p>
                                </a>
                                 <a href="#" class="list-group-item">
                                    <div class="list-group-status status-online"></div>
                                    <span class="contacts-title">Notificacion 3</span>
                                    <p>Texto de la notificacion.</p>
                                </a>
                            </div>     
                            <div class="panel-footer text-center">
                                <a href="#">Ver todas las notificaiones</a>
                            </div>                            
                        </div>                        
                    </li>
                    <!-- END MESSAGES -->
                    
                    <!-- LANG BAR -->
                    <li class="xn-icon-button pull-right">
                       <!--  <a href="#"><span class="flag flag-gb"></span></a> -->
                        <!-- Esto es configurable -->                    
                    </li> 
                    <!-- END LANG BAR -->
                </ul>


                <!-- MESSAGE DE SALIDA-->
                        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
                            <div class="mb-container">
                                <div class="mb-middle">
                                    <div class="mb-title"><span class="fa fa-sign-out"></span> Cerrar <strong>Sesión</strong> ?</div>
                                    <div class="mb-content">
                                        <p>Esta segur@ de querer cerrar sesión?</p>                    
                                        <p>Presiona No, si quieres seguir trabajando. Presiona Si, si desea cerrar esta sesión de usuario.</p>
                                    </div>
                                    <div class="mb-footer">
                                        <div class="pull-right">
                                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                                            <a href="commons/logout.php" class="btn btn-success btn-lg">Si</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        <!-- END DE SALIDA-->