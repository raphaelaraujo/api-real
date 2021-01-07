<?php $this->load->view('layout/navbar');?>

<div class="page-wrap">

    <?php $this->load->view('layout/sidebar');?>

    <div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-users bg-blue"></i>
                                        <div class="d-inline">
                                            <h5><?php echo $titulo ?></h5>
                                            <span><?php echo $subtitulo ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a title="Home" href="<?php echo base_url('/') ?>"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal" id="editEvent" tabindex="-1" role="dialog" aria-labelledby="editEventLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form class="editEventForm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editEventLabel">Edit Event</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="editEname">Event Title</label>
                                                <input type="text" class="form-control" id="editEname" name="editEname" placeholder="Please enter event title">
                                            </div>
                                            <div class="form-group">
                                                <label for="editStarts">Start</label>
                                                <input type="text" class="form-control datetimepicker-input" id="editStarts" name="editStarts" data-toggle="datetimepicker" data-target="#editStarts">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button class="btn btn-danger delete-event" type="submit">Delete</button>
                                            <button class="btn btn-success save-event" type="submit">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> 

                    </div>
    </div>
                


    <footer class="footer">
        <div class="w-100 clearfix">
            <span class="text-center text-sm-left d-md-inline-block">Copyright © <?php echo date('Y')?> ThemeKit v2.0. Todos os direitos reservados.</span>
            <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Criado com <i class="fa fa-heart text-danger"></i> por <a href="https://softbean.com.br" class="text-dark" target="_blank">Softbean</a></span>
        </div>
    </footer>
    
</div>



        