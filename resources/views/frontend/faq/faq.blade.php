@extends('frontend.layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title">{{ __('frontend/main.faq') }}</h3>
        </div>
    </div>
</div>


<div id="faqAccordion" class="mb-15 accordion-with-icon">
    <div class="container">
        <div class="row justify-content-center">
            @foreach($faqs as $faq)
            <div class="col-md-12 mb-15">
                <div class="card">
                    <div class="card-header" id="faqHeading-{{ $loop->iteration }}">
                        <h5 class="mb-0">
                            <button class=" btn-link btn-block text-left text-decoration-none btn-faq" data-toggle="collapse" data-target="#faqCollapse-{{ $loop->iteration }}" aria-expanded="@if($loop->iteration == 1) true @else false @endif" aria-controls="faqCollapse-{{ $loop->iteration }}">
                                {{ \App\Classes\LangHelper::translate(app()->getLocale(), 'faq', 'question', 'question', $faq) }}
                            </button>
                        </h5>
                    </div>

                    <div id="faqCollapse-{{ $loop->iteration }}" class="collapse @if($loop->iteration == 1) show @endif" aria-labelledby="faqHeading-{{ $loop->iteration }}" data-parent="#faqAccordion">
                        <div class="card-body">
                            {!! \App\Classes\LangHelper::translate(app()->getLocale(), 'faq', 'answer', 'answer', $faq, true) !!}
                            
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
            
@endsection
