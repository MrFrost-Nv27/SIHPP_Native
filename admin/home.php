<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard <?= ucwords(strtolower($_SESSION['level'])) ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <?= day(date("N")) . ", " . date("d") . " " . month(date("n")) . " " . date("Y"); ?></a>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Bahan Baku</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $data_jumlah['bb'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-toolbox fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Bahan Penolong</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $data_jumlah['bp'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tools fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tenaga
                            Kerja
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $data_jumlah['tk'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Overhead Produksi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $data_jumlah['op'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bolt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>