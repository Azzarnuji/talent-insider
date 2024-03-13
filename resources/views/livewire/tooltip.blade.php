<div>
    <div class="transition-opacity duration-1000 ease-in-out opacity-100 toast toast-top toast-end" id="toast">
        @php
        $no = 1; @endphp
        @foreach ($errorsData[0]->all() as $error)
            <div class="alert {{ $tooltipColor }}" id="{{ $no++ }}">
                <span>{{ $error }}</span>
            </div>
        @endforeach
    </div>

    <script>
        const toastBody = document.querySelectorAll('alert')
        console.log(toastBody);
    </script>
</div>
