<div class="col-md-6">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Wohnungsstatus Übersicht</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                </button>
            </div>
        </div>
        <div class="card-body">

            <div class="d-flex justify-content-center mb-3">
                <canvas id="wohnungsstatusChart"
                        style="width: 180px; height: 180px;"
                        data-labels="{{ json_encode($wohnungsstatus->pluck('label')) }}"
                        data-counts="{{ json_encode($wohnungsstatus->pluck('count')) }}"
                        data-colors="{{ json_encode($wohnungsstatus->pluck('color')) }}"
                ></canvas>
            </div>

            <div id="wohnungsstatusLegend" class="d-flex flex-column gap-2"></div>

        </div>
    </div>
</div>
