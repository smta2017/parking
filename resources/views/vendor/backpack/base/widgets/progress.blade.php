@php
// defaults; backwards compatibility with Backpack 4.0 widgets
$widget['wrapper']['class'] = $widget['wrapper']['class'] ?? $widget['wrapperClass'] ?? 'col-sm-6 col-lg-3';
@endphp

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
<div class="card pull-up">
  <div class="card-content">
    <div class="card-body">
      <div class="media d-flex">
        <div class="media-body text-left">
          @if (isset($widget['value']))
          <h3 class="info">{!! $widget['value'] !!}</h3>
          @endif

          @if (isset($widget['description']))
          <h6>{!! $widget['description'] !!}</h6>
          @endif
        </div>
        <div>
          <i class="icon-basket-loaded info font-large-2 float-right"></i>
        </div>
      </div>
      @if (isset($widget['progress']))
      <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: {{ $widget['progress']  }}%" aria-valuenow="{{ $widget['progress']  }}" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      @endif

      @if (isset($widget['hint']))
      <small class="text-muted">{!! $widget['hint'] !!}</small>
      @endif

      @if (isset($widget['footer_link']))
      <div class="card-footer px-3 py-2">
        <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ $widget['footer_link'] ?? '#' }}"><span class="small font-weight-bold">{{ $widget['footer_text'] ?? 'View more' }}</span><i class="la la-angle-right"></i></a>
      </div>
      @endif

    </div>
  </div>
</div>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')