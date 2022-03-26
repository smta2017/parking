@if (config('backpack.base.breadcrumbs') && isset($breadcrumbs) && is_array($breadcrumbs) && count($breadcrumbs))
@foreach ($breadcrumbs as $label => $link)
@endforeach
@if ($label!= trans('backpack::base.dashboard'))
	
<div class="content-header row">
	<div class="content-header-left col-md-6 col-12 mb-1">
		<h2 class="content-header-title text-capitalize"> {{ $crud->entity_name_plural}} </h2>
	</div>
	<div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
		<div class="breadcrumb-wrapper col-12">
			<ol class="breadcrumb">
				@foreach ($breadcrumbs as $label => $link)
				@if ($link)
				<li class="breadcrumb-item text-capitalize"><a href="{{ $link }}">{{ $label }}</a></li>
				@else
				<li class="breadcrumb-item text-capitalize active" aria-current="page">{{ $label }}</li>
				@endif
				@endforeach
			</ol>
		</div>
	</div>
</div>
@endif
@endif
