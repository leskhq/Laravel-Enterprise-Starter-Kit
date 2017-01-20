@foreach($node->getDescendants() as $descendant)
	<h4>{{ $descendant->name }}</h4>
	@foreach($descendant->products->take(4) as $product)
		@if($descendant->slug == 'detergent') active @endif
		<li>
			{{ $product->name }}
		</li>
	@endforeach
@endforeach