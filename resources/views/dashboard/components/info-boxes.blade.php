<div class="row">

    <!--begin::Verfügbare Wohnungen-->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-primary shadow-sm">
                <i class="bi bi-building"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Verfügbare Wohnungen</span>
                <span class="info-box-number">{{ $verfuegbareWohnungen }}</span>
            </div>
        </div>
    </div>
    <!--end::Verfügbare Wohnungen-->

    <!--begin::Interessenten-->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-success shadow-sm">
                <i class="bi bi-people-fill"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Interessenten</span>
                <span class="info-box-number">{{ $interessenten }}</span>
            </div>
        </div>
    </div>
    <!--end::Interessenten-->

    <!--begin::Aufgaben Gesamt-->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-primary shadow-sm">
                <i class="bi bi-clipboard-check"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Aufgaben Gesamt</span>
                <span class="info-box-number">{{ $aufgabenGesamt }}</span>
            </div>
        </div>
    </div>
    <!--end::Aufgaben Gesamt-->

    <!--begin::Besichtigungen Heute-->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-warning shadow-sm">
                <i class="bi bi-calendar-event"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Besichtigungen Heute</span>
                <span class="info-box-number">{{ $besichtigungenHeute }}</span>
            </div>
        </div>
    </div>
    <!--end::Besichtigungen Heute-->

</div>
