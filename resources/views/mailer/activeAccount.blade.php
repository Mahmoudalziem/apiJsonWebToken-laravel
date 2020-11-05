
<div class="container">
    <!------>
    <div class="image">
        {{-- <img src="{{ $message->embed(asset('images/logo/log.jpg')) }}"> --}}
    </div>
    <!----->
    <div class="content">
        <div class="header">
            <div class=""> Hello {{ $name }}</div>
        </div>
        <div class="footer">
            Thanks for registration please click to this link To complete Registration
        </div>
    </div>
    <!----->
    <div class="button">
        <div class="">{{ url('/verify',$verify) }}</div>
    </div>
    <!----->
    <div class="footer">
        <hr>
        Azima Team
    </div>
</div>
