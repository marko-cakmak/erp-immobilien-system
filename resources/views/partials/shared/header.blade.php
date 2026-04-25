<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ $title }}</h3>
            </div>
            @if(isset($buttonText) && isset($buttonUrl))
                @if(!isset($managePermission) || auth()->user()->hasPermission($managePermission))
                    <div class="col-sm-6">
                        <div class="float-end">
                            <a href="{{ $buttonUrl }}" class="btn {{ $buttonClass ?? 'btn-primary' }}">
                                @if(isset($buttonIcon))
                                    <i class="bi bi-{{ $buttonIcon }}"></i>
                                @endif
                                {{ $buttonText }}
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
