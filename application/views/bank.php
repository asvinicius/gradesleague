<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Banco</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/css/animate.min.css'); ?>" rel="stylesheet"/>
        <link href="<?= base_url('assets/css/paper-dashboard.css'); ?>" rel="stylesheet"/>
        <link href="<?= base_url('assets/css/demo.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="<?= base_url('assets/css/themify-icons.css'); ?>" rel="stylesheet">

    </head>

        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <p class="navbar-brand">Banco</p>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Carteira da liga</h4>
                                    <p class="category">Situação das cotas de cada cartoleiro</p>
                                </div>
                                <div class="content">
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover">
                                            <?php if($teams){ ?>
                                                <thead>
                                                    <th title="Time">Time</th>
                                                    <th title="Cartoleiro">Cartoleiro</th>
                                                    <th title="Vitórias de mês">VM</th>
                                                    <th title="Vitórias de rodada">VR</th>
                                                    <th title="Lanternas de mês">LM</th>
                                                    <th title="Lanternas de rodada">LR</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($teams as $team){ ?>
                                                        <tr>
                                                            <td><?php echo $team->name; ?></td>
                                                            <td><?php echo $team->nickcoach; ?></td>
                                                            <td><?php echo $team->vm; ?></td>
                                                            <td><?php echo $team->vr; ?></td>
                                                            <td><?php echo $team->lm; ?></td>
                                                            <td><?php echo $team->lr; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <!--   Core JS Files   -->
    <script src="<?= base_url('assets/js/jquery-1.10.2.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/bootstrap-checkbox-radio.js'); ?>"></script>
    <script src="<?= base_url('assets/js/chartist.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-notify.js'); ?>"></script>
    <script src="<?= base_url('assets/js/paper-dashboard.js'); ?>"></script>
    <script src="<?= base_url('assets/js/demo.js'); ?>"></script>

</html>
