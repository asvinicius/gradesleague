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
                        <p class="navbar-brand">Informações</p>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Visão geral</h4>
                                    <p class="category">Performance no campeonato</p>
                                </div>
                                <div class="content">
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover">
                                            <thead>
                                                <th title="Time">Time</th>
                                                <th title="Cartoleiro">Cartoleiro</th>
                                                <th title="Vitórias de rodada">VR</th>
                                                <th title="Lanternas de rodada">LR</th>
                                                <th title="Vitórias de mês">VM</th>
                                                <th title="Lanternas de mês">LM</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Dexolas Dexolas</td>
                                                    <td>Viníciu Anjos</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>Dexolas Dexolas</td>
                                                    <td>Viníciu Anjos</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>Dexolas Dexolas</td>
                                                    <td>Viníciu Anjos</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>Dexolas Dexolas</td>
                                                    <td>Viníciu Anjos</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>Dexolas Dexolas</td>
                                                    <td>Viníciu Anjos</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>Dexolas Dexolas</td>
                                                    <td>Viníciu Anjos</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>0</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Email Statistics</h4>
                                    <p class="category">Last Campaign Performance</p>
                                </div>
                                <div class="content">
                                    <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                    <div class="footer">
                                        <div class="chart-legend">
                                            <i class="fa fa-circle text-info"></i> Open
                                            <i class="fa fa-circle text-danger"></i> Bounce
                                            <i class="fa fa-circle text-warning"></i> Unsubscribe
                                        </div>
                                        <hr>
                                        <div class="stats">
                                            <i class="ti-timer"></i> Campaign sent 2 days ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card ">
                                <div class="header">
                                    <h4 class="title">2015 Sales</h4>
                                    <p class="category">All products including Taxes</p>
                                </div>
                                <div class="content">
                                    <div id="chartActivity" class="ct-chart"></div>

                                    <div class="footer">
                                        <div class="chart-legend">
                                            <i class="fa fa-circle text-info"></i> Tesla Model S
                                            <i class="fa fa-circle text-warning"></i> BMW 5 Series
                                        </div>
                                        <hr>
                                        <div class="stats">
                                            <i class="ti-check"></i> Data information certified
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
