<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('front.header')

<body>
    <div class="py-1 nav">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-3 px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md-4 d-flex topper align-items-center">
                            <div class="icon bg-fifth mr-2 d-flex justify-content-center align-items-center text-white">
                                <span class="icon-map"></span>
                            </div>
                            <span class="text text-white">@lang('BP.150 West Region, In Nzong-Foto Village')</span>
                        </div>
                        <div class="col-md-4 d-flex topper align-items-center">
                            <div
                                class="icon bg-secondary mr-2 d-flex justify-content-center align-items-center text-white">
                                <span class="icon-paper-plane"></span>
                            </div>
                            <span class="text text-white">contact@lesamisdenzong-fondationcandia.com</span>
                        </div>
                        <div class="col-md-3 d-flex topper align-items-center">
                            <div
                                class="icon bg-tertiary mr-2 d-flex justify-content-center align-items-center text-white">
                                <span class="icon-phone2"></span>
                            </div>
                            <span class="text text-white">+237 65 71 83 89 / 693 03 44 72</span>
                        </div>
                        <div class="class ml-4">
                            <div class="dropdown" style="display: inline-block;">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink78"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{config('app.locale')}}</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink78">
                                    @foreach(config('app.locales') as $locale)
                                    @if($locale != session('lang'))
                                    <a class="dropdown-item" href="{{ url('locale/'.$locale) }}" id="lang-link">
                                        {{ $locale }}
                                    </a>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('front.nav')
    <!-- start subscribe confirmation modal -->
        <x-front.modal :modal="session('modal')" />
        <x-front.unsubscribe-modal :unsubscribe="session('unsubscribe')" />
    <!-- end subscribe confirmation modal -->
    @yield('content')

    @include('front.footer')
    
    @if (Auth::check())
    <button class="open-button" onclick="openForm()">@lang('Leave an review')</button>

    <div class="chat-popup" id="myForm">
      <form action="/action_page.php" class="form-container">
        <h4>@lang('Add testimonial')</h4>
    
        <label for="msg"><b>@lang('Message (optional)')</b></label>
        <textarea placeholder="Type message.." name="msg" required></textarea>
    
        <button type="submit" class="btn">@lang('Send')</button>
        <button type="button" class="btn cancel" onclick="closeForm()">@lang('Close')</button>
      </form>
    </div> 
    @endif
    <script>
    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }
    
    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }
    </script>
</body>

</html>