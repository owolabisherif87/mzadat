<div class=" w-full h-screen absolute right-0 left-0 bottom-0 hidden" id="modal">
    <div class="w-full h-full  flex justify-center items-center bg-black bg-opacity-50">
        <div class="w-[40rem] h-auto rounded-md bg-white overflow-hidden">
            <div class="h-auto w-full bg-green-50 p-5">
                @yield('modal-header', 'Modal Header')
            </div>

            <div class="p-5">
                @yield('modal-body', 'Enter modal body')
            </div>

            <div class="h-auto w-full bg-green-50 p-5">
                @yield('modal-footer', 'Modal Footer')
            </div>
        </div>
    </div>
</div>
