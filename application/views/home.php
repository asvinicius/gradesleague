<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Início</title>

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
                        <p class="navbar-brand">Início</p>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <?php if($round){ ?>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-<?php echo $type; ?> text-left">
                                                <i class="ti-<?php echo $icon; ?>"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Rodada</p>
                                                <?php echo $round; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-<?php echo $icon; ?>"></i> Mercado <?php echo $message; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-success text-left">
                                                <i class="ti-cup"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Campeão de <?php echo $avdata['description']; ?></p>
                                                <?php if($avdata){ 
                                                        echo $avdata['winner'];
                                                }?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-cup"></i> Campeão de <?php echo $avdata['description']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="icon-big icon-danger text-left">
                                                <i class="ti-trash"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-8">
                                            <div class="numbers">
                                                <p>Lanterna de <?php echo $avdata['description']; ?></p>
                                                <?php if($avdata){ 
                                                        echo $avdata['loser'];
                                                }?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-trash"></i> Lanterna de <?php echo $avdata['description']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Na rodada passada</h4>
                                    <p class="category">Pontuação ultima rodada</p>
                                </div>
                                <div class="content">
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover">
                                            <?php if($ranking){ ?>
                                                <thead>
                                                    <th title="Posição">#</th>
                                                    <th title="Nome do time">Time</th>
                                                    <th title="Nome do cartoleiro">Cartoleiro</th>
                                                    <th title="Pontuação total">Pontuação</th>
                                                    <th title="Patrimônio total">Patrimônio</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                            $cont = 1;
                                                            foreach ($ranking as $ranked){ ?>
                                                        <tr>
                                                                <td><?php echo $cont; ?></td>
                                                                <td><?php echo $ranked->name ?></td>
                                                                <td><?php echo $ranked->nickcoach ?></td>
                                                                <td><?php echo number_format($ranked->rating, 2) ?></td>
                                                                <td><?php echo "C$ ".number_format($ranked->patrimony, 2, ',', '.'); ?></td>
                                                            </tr>
                                                        <?php $cont++;

                                                            } ?>
                                                </tbody>
                                            <?php }else{
                                                echo "Nenhuma rodada realizada!";
                                            } ?>
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
