<table class="table table-bordered dataTable" width="100%" cellspacing="1">
    <tbody>
        <?php foreach ($competicao as $c) : ?>
            <tr>                
                <td>
                    <?php echo ('Campeonato: ' . $c->nome) ?>
                    <table class="table table-bordered dataTable" width="100%" cellspacing="1">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
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
                                        <td>
                                            <table class="table table-bordered dataTable" width="100%" cellspacing="1">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($book as $b) : ?>
                                                        <?php if ($m->mercado_id == $b['book_id']) : ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo ($b['visitante']) ?>                                               
                                                                </td>
                                                                <td>
                                                                    <?php echo ($b['visitante']) ?>                                               
                                                                </td>
                                                                <td>
                                                                    <?php echo ($b['empate']) ?>                                               
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