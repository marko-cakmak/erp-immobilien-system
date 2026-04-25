<!--begin::Aufgabenstatus Chart-->
<div class="col-md-6">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Aufgabenstatus Übersicht</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                </button>
            </div>
        </div>
        <div class="card-body">

            <div class="d-flex justify-content-center mb-3">
                <canvas id="aufgabenstatusChart"
                        style="width: 180px; height: 180px;"
                        data-labels="{{ json_encode($aufgabenstatus->pluck('name')) }}"
                        data-counts="{{ json_encode($aufgabenstatus->pluck('count')) }}"
                        data-colors="{{ json_encode($aufgabenstatus->pluck('color')) }}"
                ></canvas>
            </div>

            <div id="aufgabenstatusLegend" class="d-flex flex-column gap-2"></div>

        </div>
    </div>
</div>
<!--end::Aufgabenstatus Chart-->
