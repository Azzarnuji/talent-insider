@extends('layout')
@section('content')
    <div class="container w-full h-screen mx-auto">
        <div class="flex flex-col items-center justify-center w-full h-full gap-10 lg:flex-row">
            <div class="contentLeft">
                <img src="https://media.licdn.com/dms/image/C560BAQE1tUpFj8bT_Q/company-logo_200_200/0/1630662935364/talentinsider_logo?e=1718236800&v=beta&t=k9oy8PHLh2-sGybWKrbU8uq3my4X8UkoKOgJugKuHDY"
                    alt="" class="lg:w-[20vw] rounded-3xl">
            </div>
            <div class="contentRight">
                @livewire('login-user')
            </div>
        </div>
    </div>
@endsection
