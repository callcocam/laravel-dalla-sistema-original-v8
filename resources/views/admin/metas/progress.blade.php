@if( progressOut( $client_meta,$meta, 10) )
    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
         role="progressbar"
         style="width: {{ progress($client_meta,$meta) }}%"
         aria-valuenow="{{   progress($client_meta,$meta) }}"
         aria-valuemin="0" aria-valuemax="100">
        {{ progress($client_meta,$meta) }}%
    </div>
@elseif(progressIn( $client_meta,$meta, 10) && progressOut($client_meta , $meta, 25))
<div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
     role="progressbar"
     style="width: {{ progress($client_meta,$meta) }}%"
     aria-valuenow="{{   progress($client_meta,$meta) }}"
     aria-valuemin="0" aria-valuemax="100">
    {{ progress($client_meta,$meta) }}%
</div>
@elseif(progressIn( $client_meta,$meta, 25) && progressOut( $client_meta, $meta, 50))
<div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
     role="progressbar"
     style="width: {{ progress($client_meta,$meta) }}%"
     aria-valuenow="{{   progress($client_meta,$meta) }}"
     aria-valuemin="0" aria-valuemax="100">
    {{ progress($client_meta,$meta) }}%
</div>
@elseif(progressIn( $client_meta, $meta, 50) && progressOut( $client_meta, $meta, 75))
<div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
     role="progressbar"
     style="width: {{ progress($client_meta,$meta) }}%"
     aria-valuenow="{{   progress($client_meta,$meta) }}"
     aria-valuemin="0" aria-valuemax="100">
    {{ progress($client_meta,$meta) }}%
</div>
@elseif(progressIn( $client_meta, $meta, 75))
    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
         role="progressbar"
         style="width: {{ progress($client_meta,$meta) }}%"
         aria-valuenow="{{ progress($client_meta,$meta) }}"
         aria-valuemin="0" aria-valuemax="100">
        {{ progress($client_meta,$meta) }}%
    </div>
@endif
