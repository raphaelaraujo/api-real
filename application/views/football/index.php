<!DOCTYPE html>
<html lang="en">
    <!-- datatables.html  21 Nov 2019 03:55:21 GMT -->
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">        
        <!-- General CSS Files -->
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/app.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/public/assets/bundles/datatables/datatables.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/public/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
        <!-- Template CSS -->
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/components.css'); ?>">
        <!-- Custom style CSS -->
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/custom.css'); ?>">          
    </head>

    <body>
        <div class="loader"></div>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>        
                <div class="main-sidebar sidebar-style-2">
                    <aside id="sidebar-wrapper">
                        <!--                        <div class="sidebar-brand">
                                                    <a href="index.html"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span
                                                            class="logo-name">Otika</span>
                                                    </a>
                                                </div>-->
                        <ul class="sidebar-menu">
                            <li class="menu-header">...</li>                          
                        </ul>
                    </aside>
                </div>
                <!-- Main Content -->
                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-body">
                            <!-- add content here -->
                            <h2>País</h2>
                            <a href="<?php echo base_url('api_football/api_acao/tela_competicao/BR') ?>" class="btn btn-primary">Brasil</a>
                            <a href="<?php echo base_url('api_football/api_acao/tela_competicao/IT') ?>" class="btn btn-primary">Itália</a>
                            <a href="<?php echo base_url('api_football/api_acao/tela_competicao/GB') ?>" class="btn btn-primary">Reino Unido</a>
                        </div>
                    </section>
                    <div class="settingSidebar">
                        <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                        </a>
                        <div class="settingSidebar-body ps-container ps-theme-default">
                            <div class=" fade show active">
                                <div class="setting-panel-header">Setting Panel
                                </div>
                                <div class="p-15 border-bottom">
                                    <h6 class="font-medium m-b-10">Select Layout</h6>
                                    <div class="selectgroup layout-color w-50">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                                            <span class="selectgroup-button">Light</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                                            <span class="selectgroup-button">Dark</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-15 border-bottom">
                                    <h6 class="font-medium m-b-10">Sidebar Color</h6>
                                    <div class="selectgroup selectgroup-pills sidebar-color">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                                  data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                                  data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-15 border-bottom">
                                    <h6 class="font-medium m-b-10">Color Theme</h6>
                                    <div class="theme-setting-options">
                                        <ul class="choose-theme list-unstyled mb-0">
                                            <li title="white" class="active">
                                                <div class="white"></div>
                                            </li>
                                            <li title="cyan">
                                                <div class="cyan"></div>
                                            </li>
                                            <li title="black">
                                                <div class="black"></div>
                                            </li>
                                            <li title="purple">
                                                <div class="purple"></div>
                                            </li>
                                            <li title="orange">
                                                <div class="orange"></div>
                                            </li>
                                            <li title="green">
                                                <div class="green"></div>
                                            </li>
                                            <li title="red">
                                                <div class="red"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="p-15 border-bottom">
                                    <div class="theme-setting-options">
                                        <label class="m-b-0">
                                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                                   id="mini_sidebar_setting">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="control-label p-l-10">Mini Sidebar</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="p-15 border-bottom">
                                    <div class="theme-setting-options">
                                        <label class="m-b-0">
                                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                                   id="sticky_header_setting">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="control-label p-l-10">Sticky Header</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                                    <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                                        <i class="fas fa-undo"></i> Restore Default
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="main-footer">
                    <div class="footer-left">
                        <a href="templateshub.net">Templateshub</a></a>
                    </div>
                    <div class="footer-right">
                    </div>
                </footer>
            </div>
        </div>

    </div>
</div>
<!--                <footer class="main-footer">
                    <div class="footer-left">                
                    </div>
                    <div class="footer-right">
                    </div>
                </footer>                    -->
<!-- General JS Scripts -->
<script src="<?php echo base_url('public/assets/js/app.min.js'); ?>"></script>
<!-- JS Libraies -->
<script src="<?php echo base_url('public/assets/bundles/datatables/datatables.min.js'); ?>"></script>
<script src="<?php echo base_url('public/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('public/assets/bundles/jquery-ui/jquery-ui.min.js'); ?>></script>
        <!-- Page Specific JS File -->
<script src="<?php echo base_url('public/assets/js/page/datatables.js'); ?>"></script>
<!-- Template JS File -->
<script src="<?php echo base_url('public/assets/js/scripts.js'); ?>"></script>
<!-- Custom JS File -->
<script src="<?php echo base_url('public/assets/js/custom.js'); ?>"></script>
</body>


<!-- datatables.html  21 Nov 2019 03:55:25 GMT -->
</html>