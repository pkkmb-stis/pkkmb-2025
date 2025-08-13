<div class="w-[90%] sm:w-[60%] md:w-[27rem] mx-auto overflow-hidden">
    <div class="max-h-screen flex flex-col justify-center items-center">
        <div class="h-fit bg-base-white mb-4 w-full" style="border-radius: 0rem 0rem 1.875rem 1.875rem; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
            <div class="h-10 w-full flex">
                <h2  class="bg-[#771518] flex items-center  justify-center  text-gray-50 md:text-lg sm:text-base text-sm px-4 rounded-l-md float-left w-1/2 md:text-center text-right box-content font-semibold" x-text="keterangan"></h2>
                <div class="h-5 w-full" style="background: #D1494D;"></div>
            </div>
            <div class="w-full flex justify-center">
                <div class="w-[80%] flex justify-center flex-col">
                    <div class="lg:w-84 md:h-40 w-[95%] h-32 bg-merah-pattern mt-3 flex justify-center overflow-hidden" style="border-radius: 2.4375rem 1.875rem 1.75rem 2.125rem; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                        <img class="object-contain md:w-48 sm:h-36" src="img/logo/LOGO PKKMB-PKBN 2023-clear.png">
                    </div>
                    <div class="text-center font-poppins font-bold md:text-xl text-base" style="color: #464646; line-height: normal;">
                        {{ $tema }}
                    </div>
                    <div class="h-1" style="background: #D1494D;"></div>
                    <div class="my-2 flex  justify-between items-center font-bold md:text-xs text-[0.6rem]" style="color: #737373; text-align: center; font-family: Poppins; line-height: normal;">
                        <div class="flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                                <path d="M0 0H23V22H0V0Z" fill="white" fill-opacity="0.01"/>
                                <path d="M2.396 8.7085H20.6043V18.3335C20.6043 18.8398 20.1753 19.2502 19.646 19.2502H3.35433C2.82506 19.2502 2.396 18.8398 2.396 18.3335V8.7085Z" fill="#D1494D" stroke="black" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M2.396 4.12541C2.396 3.61915 2.82506 3.20874 3.35433 3.20874H19.646C20.1753 3.20874 20.6043 3.61915 20.6043 4.12541V8.70874H2.396V4.12541Z" stroke="black" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M7.6665 1.8335V5.50016" stroke="black" stroke-width="2.82272" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.3335 1.8335V5.50016" stroke="black" stroke-width="2.82272" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.4165 15.5835H16.2915" stroke="white" stroke-width="2.82272" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.7085 15.5835H9.5835" stroke="white" stroke-width="2.82272" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.4165 11.917H16.2915" stroke="white" stroke-width="2.82272" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.7085 11.917H9.5835" stroke="white" stroke-width="2.82272" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="ml-2 text-center" x-text="tanggal"></span>
                        </div>
                        <div class="flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="18" viewBox="0 0 21 18" fill="none">
                                <path d="M0 0H21V18H0V0Z" fill="white" fill-opacity="0.01"/>
                                <path d="M10.4999 16.625C14.9296 16.625 18.5207 13.547 18.5207 9.75001C18.5207 5.95303 14.9296 2.875 10.4999 2.875C6.07003 2.875 2.479 5.95303 2.479 9.75001C2.479 13.547 6.07003 16.625 10.4999 16.625Z" fill="#D1494D" stroke="black" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M10.3946 5.75757L10.394 9.88587L13.7944 12.8005" fill="#D1494D"/>
                                <path d="M10.3946 5.75757L10.394 9.88587L13.7944 12.8005" stroke="white" stroke-width="3.83536" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.75 3.375L4.8125 1.5L1.75 3.375Z" fill="#D1494D"/>
                                <path d="M1.75 3.375L4.8125 1.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19.25 3.375L16.1875 1.5L19.25 3.375Z" fill="#D1494D"/>
                                <path d="M19.25 3.375L16.1875 1.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="ml-2 text-center" x-text="waktu"></span>
                        </div>
                    </div>
                    <div class="pb-6 sm:text-sm text-xs" style="color: #737373; font-family: Poppins;">
                        <span class="text-justify break-words" x-text="konten"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
