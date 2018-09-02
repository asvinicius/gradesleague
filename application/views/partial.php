<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Parciais</title>

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
                        <p class="navbar-brand">Parciais</p>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Parciais</h4>
                                    <p class="category">Pontuação parcial na rodada, mês e campeonato</p>
                                </div>
                                <div class="content">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                                <li class="active"><a href="#round" data-toggle="tab">Rodada</a></li>
                                                <li><a href="#month" data-toggle="tab">Mês</a></li>
                                                <li><a href="#overall" data-toggle="tab">Campeonato</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="my-tab-content" class="tab-content">
                                        <div class="tab-pane active" id="round">
                                            <div class="content table-responsive table-full-width">
                                                <table class="table table-hover">
                                                    <?php if($partial){ ?>
                                                        <thead>
                                                            <th title="Posição">#</th>
                                                            <th title="Nome do time">Time</th>
                                                            <th title="Pontuação parcial">Pontuação</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $cont = 1;
                                                                $final = 0;
                                                                foreach ($partial as $pround) {
                                                                    $final = $final+1;
                                                                }
                                                                foreach ($partial as $pround){ ?>
                                                            <tr>
                                                                <td><?php echo $cont; ?></td>
                                                                <td><?php echo $pround['nome']; ?></td>
                                                                <td><?php echo number_format($pround['parcial'], 2) ?></td>
                                                            </tr>
                                                            <?php $cont++;

                                                                } ?>
                                                        </tbody>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="month">
                                            <div class="content table-responsive table-full-width">
                                                <table class="table table-hover">
                                                    <?php if($month){ ?>
                                                        <thead>
                                                            <th title="Posição">#</th>
                                                            <th title="Nome do time">Time</th>
                                                            <th title="Pontuação total">Pontuação</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $cont = 1;
                                                                $final = 0;
                                                                foreach ($month as $pmonth) {
                                                                    $final = $final+1;
                                                                }
                                                                foreach ($month as $pmonth){ ?>
                                                            <tr <?php switch ($cont) {
                                                                                case 1:
                                                                                    echo 'class="success"';
                                                                                    break;
                                                                                case $final:
                                                                                    echo 'class="danger"';
                                                                                    break;
                                                                            } ?>>
                                                                <td><?php echo $cont; ?></td>
                                                                <td><?php echo $pmonth['nome']; ?></td>
                                                                <td><?php echo number_format($pmonth['pontos']['mes'], 2) ?></td>
                                                            </tr>
                                                            <?php $cont++;

                                                                } ?>
                                                        </tbody>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="overall">
                                            <div class="content table-responsive table-full-width">
                                                <table class="table table-hover">
                                                    <?php if($overall){ ?>
                                                        <thead>
                                                            <th title="Posição">#</th>
                                                            <th title="Nome do time">Time</th>
                                                            <th title="Pontuação total">Pontuação</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $cont = 1;
                                                                $final = 0;
                                                                foreach ($overall as $poverall) {
                                                                    $final = $final+1;
                                                                }
                                                                foreach ($overall as $poverall){ ?>
                                                            <tr <?php switch ($cont) {
                                                                                case 1:
                                                                                    echo 'class="success"';
                                                                                    break;
                                                                            } ?>>
                                                                <td><?php echo $cont; ?></td>
                                                                <td><?php echo $poverall['nome']; ?></td>
                                                                <td><?php echo $poverall['pontos']['campeonato'] ?></td>
                                                            </tr>
                                                            <?php $cont++;

                                                                } ?>
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
