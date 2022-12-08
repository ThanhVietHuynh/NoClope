@if(session()->has('message'))
<div>
    {{ session()->get('message') }}
</div>
@endif

@foreach ($responseBody as $stripe)
                            
                            {{ $stripe->id }}
                            
                        @endforeach
    
@endforeach