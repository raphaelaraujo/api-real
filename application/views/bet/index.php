<table class="table table-bordered dataTable" width="100%" cellspacing="1">
    <thead>
        <tr>
            <th>Jogo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($competicao as $c) : ?>
            <tr>
                <td>
                    <?php echo $c->nome ?>
                    <table class="table table-bordered dataTable" width="100%" cellspacing="1">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jogo as $j) : ?>
                                <?php if($j->id_competicao == $c->id) : ?>
                                <tr>
                                    <td>
                                        <?php echo ($j->nome_evento) ?>
                                        <?php echo ($j->data_evento) ?>
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