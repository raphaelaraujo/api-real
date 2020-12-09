<table class="table table-bordered dataTable" width="100%" cellspacing="1">
    <tbody>
        <?php foreach ($competicao as $c) : ?>
            <tr>                
                <td>
                    <?php echo ('Campeonato: '.$c->nome) ?>
                    <table class="table table-bordered dataTable" width="100%" cellspacing="1">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
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