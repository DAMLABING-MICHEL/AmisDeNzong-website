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
    action="{{ Route::currentRouteName() === 'news.edit' ? route('news.update', $news->id) : route('news.store') }}">

    @if(Route::currentRouteName() === 'news.edit')
    @method('PUT')
    @endif

    @csrf

    <div class="row">
        <div class="col-md-12">

            <x-back.validation-errors :errors="$errors" />

            @if(session('ok'))
            <x-back.alert type='success' title="{!! session('ok') !!}">
            </x-back.alert>
            @endif
           
           
            <x-back.card type='primary' title='Title of the news'>
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
                        :value="isset($news) ? $news->getTranslation('title',$locale) : ''" input='text'
                            :required="true">
                        </x-back.input>
                    </div>
                    @endforeach
                </div>
            </x-back.card>
           
            <x-back.card type='primary' title='Summary of the news'>
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
                        :value="isset($news) ? $news->getTranslation('summary',$locale) : ''" input='textarea'
                            :required="true">
                        </x-back.input>
                    </div>
                    @endforeach
                </div>
            </x-back.card>
            
            <x-back.card type='primary' title='Content of the news'>
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
                        <x-back.input name='content_{{ $locale }}'
                        :value="isset($news) ? $news->getTranslation('content',$locale) : ''" input='textarea'
                            rows=10 :required="true">
                        </x-back.input>
                    </div>
                    @endforeach
                </div>
            </x-back.card>
            <x-back.card type='primary' :outline="false" title='Image'>

                <div id="holder" class="text-center" style="margin-bottom:15px;">
                    @isset($news)
                    <img style="width:100%;" src="{{ getImage($news) }}" alt="">
                    @endisset
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary text-white"
                            class="btn btn-outline-secondary" type="button"><i class="fa fa-upload"></i> @lang('Upload')</a>
                    </div>
                    <input id="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" type="text"
                        name="image" value="{{ old('image', isset($news) ? getImage($news) : '') }}" required hidden>
                    <input id="image" class=" {{ $errors->has('image') ? 'is-invalid' : '' }}" type="text"
                        name="imageId" value="{{ old('image', isset($news) && !empty($news->image) ? $news->image->id : '') }}" hidden>
                    @if ($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                    @endif
                </div>


            </x-back.card>
            <button type="submit" class="btn btn-primary" id="submit">@lang('Submit')</button>

        </div>

    </div>


</form>
@endsection

@section('js')

@include('back.shared.editorScript')
@endsection