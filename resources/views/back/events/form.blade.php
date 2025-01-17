@extends('back.layout')

@section('css')
<style>
    #holder img {
        height: 100%;
        width: 100%;
    }
</style>
@endsection

@section('content')

<form method="post"
    action="{{ Route::currentRouteName() === 'events.edit' ? route('events.update', $event->id) : route('events.store') }}">

    @if(Route::currentRouteName() === 'events.edit')
    @method('PUT')
    @endif

    @csrf

    <div class="row">
        <div class="col-md-8">

            <x-back.validation-errors :errors="$errors" />

            @if(session('ok'))
            <x-back.alert type='success' title="{!! session('ok') !!}">
            </x-back.alert>
            @endif
           
            <x-back.card type='primary' title='Title of the event'>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @foreach(config('app.locales') as $locale)
                    <li class="nav-item">
                        <a class="nav-link {{ $locale == App::getLocale() ? 'active' :'' }}"
                            id="pills-{{ $locale }}-tab" data-toggle="pill" href="#pills-title-{{ $locale }}" role="tab"
                            aria-controls="pills-{{ $locale }}" aria-selected="false">{{ $locale }}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @foreach (config('app.locales') as $locale)
                    <div class="tab-pane fade {{ $locale == App::getLocale() ? 'show active' :'' }}"
                        id="pills-title-{{ $locale }}" role="tabpanel" aria-labelledby="pills-{{ $locale }}-tab">
                        <x-back.input name='title_{{ $locale }}'
                        :value="isset($event) ? $event->getTranslation('title',$locale) : ''" input='text'
                            :required="true">
                        </x-back.input>
                    </div>
                    @endforeach
                </div>
            </x-back.card>
           
            <x-back.card type='primary' title='Summary of the event'>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @foreach(config('app.locales') as $locale)
                    <li class="nav-item">
                        <a class="nav-link {{ $locale == App::getLocale() ? 'active' :'' }}"
                            id="pills-{{ $locale }}-tab" data-toggle="pill" href="#pills-summary-{{ $locale }}"
                            role="tab" aria-controls="pills-{{ $locale }}" aria-selected="false">{{ $locale }}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @foreach (config('app.locales') as $locale)
                    <div class="tab-pane fade {{ $locale == App::getLocale() ? 'show active' :'' }}"
                        id="pills-summary-{{ $locale }}" role="tabpanel" aria-labelledby="pills-{{ $locale }}-tab">
                        <x-back.input name='summary_{{ $locale }}'
                        :value="isset($event) ? $event->getTranslation('summary',$locale) : ''" input='textarea'
                            :required="true">
                        </x-back.input>
                    </div>
                    @endforeach
                </div>
            </x-back.card>
            
            <x-back.card type='primary' title='Content of the event'>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @foreach(config('app.locales') as $locale)
                    <li class="nav-item">
                        <a class="nav-link {{ $locale == App::getLocale() ? 'active' :'' }}"
                            id="pills-{{ $locale }}-tab" data-toggle="pill" href="#pills-content-{{ $locale }}"
                            role="tab" aria-controls="pills-{{ $locale }}" aria-selected="false">{{ $locale }}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @foreach (config('app.locales') as $locale)
                    <div class="tab-pane fade {{ $locale == App::getLocale() ? 'show active' :'' }}"
                        id="pills-content-{{ $locale }}" role="tabpanel" aria-labelledby="pills-{{ $locale }}-tab">
                        <x-back.input name='description_{{ $locale }}'
                        :value="isset($event) ? $event->getTranslation('description',$locale) : ''" input='textarea'
                            rows=10 :required="true">
                        </x-back.input>
                    </div>
                    @endforeach
                </div>
            </x-back.card>
            <button type="submit" class="btn btn-primary" id="submit">@lang('Submit')</button>

        </div>
        <div class="col-md-4">
            <x-back.card type='primary' title='Venue of the event'>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @foreach(config('app.locales') as $locale)
                    <li class="nav-item">
                        <a class="nav-link {{ $locale == App::getLocale() ? 'active' :'' }}"
                            id="pills-{{ $locale }}-tab" data-toggle="pill" href="#pills-venue-{{ $locale }}"
                            role="tab" aria-controls="pills-{{ $locale }}" aria-selected="false">{{ $locale }}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @foreach (config('app.locales') as $locale)
                    <div class="tab-pane fade {{ $locale == App::getLocale() ? 'show active' :'' }}"
                        id="pills-venue-{{ $locale }}" role="tabpanel" aria-labelledby="pills-{{ $locale }}-tab">
                        <x-back.input name='venue_{{ $locale }}'
                        :value="isset($event) ? $event->getTranslation('venue',$locale) : ''" input='text' :required="true">
                        </x-back.input>
                    </div>
                    @endforeach
                </div>
            </x-back.card>
            <x-back.card type='primary' title=''>
                <div class="form-group">
                    <label for="date">@lang('Date')</label>
                    <input title='Date' name='date' class="form-control"
                        value="{{ old('date', isset($event) ? $event->date : '') }}" type='date' required>
                </div>
                <div class="form-group">
                    <label for="start-time">@lang('Start time')</label>
                    <input title='Start Time' name='start_time' class="form-control"
                        value="{{ old('start_time', isset($event) ? $event->start_time : '') }}" type='time' required>
                </div>
                <div class="form-group">
                    <label for="end-time">@lang('End time')</label>
                    <input title='End Time' name='end_time' class="form-control"
                        value="{{ old('end_time', isset($event) ? $event->end_time : '') }}" type='time' required>
                </div>
                <div class="form-group">
                    <label for="contact">@lang('Contact')</label>
                    <input name='contact' class="form-control"
                        value="{{ old('contact', isset($event) ? $event->contact : '') }}" type='text' required>
                </div>
            </x-back.card>
            <x-back.card type='primary' :outline="false" title='Image'>

                <div id="holder" class="text-center" style="margin-bottom:15px;">
                    @isset($event)
                    <img style="width:100%;" src="{{ getImage($event) }}" alt="">
                    @endisset
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary text-white"
                            class="btn btn-outline-secondary" type="button"><i class="fa fa-upload"></i> @lang('Upload')</a>
                    </div>
                    <input id="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" type="text"
                        name="image" value="{{ old('image', isset($event) ? getImage($event) : '') }}" required hidden>
                    <input id="image" class=" {{ $errors->has('image') ? 'is-invalid' : '' }}" type="text"
                        name="imageId"
                        value="{{ old('image', isset($event) && !empty($event->image) ? $event->image->id : '') }}"
                        hidden>
                    @if ($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                    @endif
                </div>


            </x-back.card>
        </div>

    </div>


</form>
@endsection

@section('js')

@include('back.shared.editorScript')
@endsection