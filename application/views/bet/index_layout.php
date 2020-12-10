<!DOCTYPE html>
<html lang="en">


    <!-- datatables.html  21 Nov 2019 03:55:21 GMT -->
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">        
        <!-- General CSS Files -->
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/app.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/public/assets/bundles/datatables/datatables.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/prublic/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
        <!-- Template CSS -->
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/components.css'); ?>">
        <!-- Custom style CSS -->
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/custom.css'); ?>">  
        <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('public/assets/img/favicon.ico'); ?>" />
    </head>

    <body>
        <div class="loader"></div>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">      
                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Basic DataTables</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped">                                                                                                                                                           
                                                    <tbody>
                                                        <?php foreach ($competicao as $c) : ?> 
                                                            <tr>                
                                                                <td>
                                                                    <?php echo ('Campeonato: ' . $c->nome) ?>
                                                                    <table class="table table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Jogo</th>
                                                                                <th>Data</th>
                                                                                <th>Mandante</th>
                                                                                <th>Visitante</th>
                                                                                <th>Empate</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($mercado as $m) : ?>                                
                                                                                <?php if ($m['competicao'] == $c->id) : ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <?php echo ($m['evento_nome']) ?>                                                    
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo ($m['evento_data']) ?>                                        
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo ($m['mandante']) ?>                                        
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo ($m['visitante']) ?>                                               
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo ($m['empate']) ?>                                               
                                                                                        </td>

                                                                                    </tr>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>       
                        </div>
                    </section>        
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