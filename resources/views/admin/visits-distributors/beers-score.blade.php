@isset($title)
    <hr>
    <h3>{{ $title  }}</h3>
    <hr>
@endisset
@if($questions)

    @foreach($questions as $question)
        @if($rows->beers_score(sprintf("question-%s",$question)))
        <div class="ul-widget__item">
            <div class="ul-widget__info">

                <h3 class="ul-widget1__title">{{ sprintf("%s.%s",$index,(int)$question) }} - {{ __($rows->beers_score(sprintf("question-%s",$question))->name) }}</h3>

                @if($rows->beers_score(sprintf("question-%s",$question))->selected)
                    <span class="ul-widget__desc text-mute">{{ $rows->beers_score(sprintf("question-%s",$question))->selected }}</span>
                @endif
                @if($rows->beers_score(sprintf("question-%s",$question))->date_option)
                    <span class="ul-widget__desc text-mute">{{ date_carbom_format($rows->beers_score(sprintf("question-%s",$question))->date_option)->format('d/m/Y') }}</span>
                @endif
                <span class="ul-widget__desc text-mute">{{ $rows->beers_score(sprintf("question-%s",$question))->description }}</span>
            </div>
        </div>
        @endif
    @endforeach
@endif
