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
        <!-- Main Content -->
        <div class="main-content" width="100%" cellspacing="0">            
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">  
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">                                                                                                                                                           
                                        <tbody>
                                            <?php foreach ($competicao as $c) : ?> 
                                                <tr>                
                                                    <td>
                                                        <b>Campeonato:  </b><?php echo ($c->nome) ?>
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Jogo</th>
                                                                    <th>Data</th> 
                                                                    <th style="text-align:center">Odds (A favor)</th>
                                                                    <th style="text-align:center">Odds (Contra)</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($mercado as $m) : ?>                                
                                                                    <?php if ($m->competicao_id == $c->id) : ?>
                                                                        <tr>
                                                                            <td>
                                                                                <?php echo ($m->evento_nome) ?>                                                    
                                                                            </td>
                                                                            <td>
                                                                                <?php echo ($m->evento_data) ?>                                        
                                                                            </td>

                                                                            <!-------------------------------------------------------------------ODDS A FAVOR------------------------------------------------------------->                                                                                                                                                        
                                                                            <td>
                                                                                <table class="table table-striped">
                                                                                    <thead>
                                                                                        <tr style="text-align:center">
                                                                                            <th>mandante</th>
                                                                                            <th>visitante</th>
                                                                                            <th>empate</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php foreach ($book as $b) : ?>
                                                                                            <?php if ($m->mercado_id == $b['book_id']) : ?>
                                                                                                <tr style="text-align:center">
                                                                                                    <td>
                                                                                                        <?php echo ($b['mandante_afavor']) ?>                                               
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php echo ($b['visitante_afavor']) ?>                                               
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php echo ($b['empate_afavor']) ?>                                               
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <?php endif; ?>
                                                                                        <?php endforeach; ?>
                                                                                    </tbody>
                                                                                </table>                                                                     
                                                                            </td>   

                                                                            <!-------------------------------------------------------------------ODDS CONTRA-------------------------------------------------------------->                                                                                                                                                        
                                                                            <td>
                                                                                <table class="table table-striped">
                                                                                    <thead>
                                                                                        <tr style="text-align:center">
                                                                                            <th>mandante</th>
                                                                                            <th>visitante</th>
                                                                                            <th>empate</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php foreach ($book as $b) : ?>
                                                                                            <?php if ($m->mercado_id == $b['book_id']) : ?>
                                                                                                <tr style="text-align:center">
                                                                                                    <td>
                                                                                                        <?php echo ($b['mandante_contra']) ?>                                               
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php echo ($b['visitante_contra']) ?>                                               
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php echo ($b['empate_contra']) ?>                                               
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <?php endif; ?>
                                                                                        <?php endforeach; ?>
                                                                                    </tbody>
                                                                                </table>                                                                     
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
        </div>
        <footer class="main-footer">
            <div class="footer-left">                
            </div>
            <div class="footer-right">
            </div>
        </footer>                    
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