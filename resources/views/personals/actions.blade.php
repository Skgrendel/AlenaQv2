<div class="d-flex">
    <div class="btn-group" role="group" aria-label="Basic example">
        {{-- <a href="{{route('personals.show',$value)}}" class="btn text-success btn-sm "><i class="far fa-eye"></i></a> --}}
        <a href="{{ route('personals.edit', $value) }}" class="btn text-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" id="Pencil-Square--Streamline-Flex" height="14" width="14"><desc>Pencil Square Streamline Icon: https://streamlinehq.com</desc><g id="pencil-square--change-document-edit-modify-paper-pencil-write-writing"><path id="Union" fill="#000000" fill-rule="evenodd" d="M13.3538 0.636811c-0.7796 -0.779685 -2.051 -0.755563 -2.8006 0.053136L7.23975 4.26493c-0.14524 0.15671 -0.25533 0.34263 -0.32289 0.54533l-0.49931 1.49793c-0.26059 0.78175 0.48315 1.52549 1.26491 1.26491l1.49793 -0.49931c0.20269 -0.06757 0.38862 -0.17766 0.54532 -0.3229L13.3007 3.4374c0.8087 -0.74955 0.8328 -2.0209 0.0531 -2.800589ZM6.32294 3.41522c-0.26627 0.28729 -0.4681 0.62814 -0.59197 0.99975L5.23166 5.9129c-0.58632 1.75896 1.08709 3.43237 2.84605 2.84605l1.49793 -0.49931c0.3716 -0.12386 0.71246 -0.32569 0.99976 -0.59197l1.8541 -1.71847c0.1528 -0.1416 0.4009 -0.04516 0.4148 0.16268 0.031 0.46432 0.0505 0.93774 0.0505 1.41713 0 0.24591 -0.0051 0.49026 -0.0143 0.73262 -0.0007 0.01793 0.0007 0.03586 0.0033 0.0536 0.0097 0.06479 0.0132 0.13149 0.0098 0.19943 -0.0423 0.84309 -0.13 1.66474 -0.2168 2.44154 -0.0983 0.8803 -0.5686 1.6453 -1.2409 2.1401 -0.4258 0.32 -0.9389 0.5342 -1.49714 0.5988 -0.83005 0.096 -1.7147 0.1951 -2.62326 0.2361 -0.05819 0.0026 -0.11543 0.0002 -0.17132 -0.0069 -0.01512 -0.0019 -0.03035 -0.0028 -0.04558 -0.0023 -0.19898 0.0066 -0.39925 0.0102 -0.60057 0.0102 -1.21129 0 -2.38493 -0.1307 -3.46576 -0.2558 -1.42003 -0.1642 -2.55383 -1.2952 -2.713017 -2.7203C0.198834 9.87812 0.0762195 8.71301 0.0762195 7.51038c0 -0.24592 0.0051268 -0.49027 0.0143133 -0.73262 0.0006796 -0.01793 -0.0006639 -0.03587 -0.0033237 -0.05361 -0.0097113 -0.06478 -0.0131669 -0.13148 -0.0097583 -0.19943C0.119747 5.68163 0.207458 4.85995 0.294223 4.08321c0.098343 -0.88039 0.568654 -1.64539 1.240957 -2.14018 0.42579 -0.32 0.93884 -0.53413 1.49709 -0.5987 0.83005 -0.09602 1.7147 -0.1952 2.62327 -0.23612 0.05818 -0.00262 0.11543 -0.00022 0.17131 0.00683 0.01512 0.00191 0.03036 0.00286 0.04559 0.00236 0.19898 -0.0066 0.39925 -0.01021 0.60056 -0.01021 0.47188 0 0.93805 0.01984 1.39525 0.05146 0.20746 0.01434 0.30332 0.26205 0.16196 0.41457l-1.70727 1.842Z" clip-rule="evenodd" stroke-width="1"></path></g></svg></a>
        <form action="{{ route('personals.destroy', $value) }}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn text-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14" id="Recycle-Bin-2--Streamline-Core" height="14" width="14">
                    <desc>Recycle Bin 2 Streamline Icon: https://streamlinehq.com</desc>
                    <g id="recycle-bin-2--remove-delete-empty-bin-trash-garbage">
                        <path id="Subtract" fill="#000000" fill-rule="evenodd"
                            d="M5.76256 2.01256C6.09075 1.68437 6.53587 1.5 7 1.5c0.46413 0 0.90925 0.18437 1.23744 0.51256 0.20736 0.20737 0.35731 0.46141 0.43961 0.73744h-3.3541c0.0823 -0.27603 0.23225 -0.53007 0.43961 -0.73744ZM3.78868 2.75c0.10537 -0.67679 0.42285 -1.30773 0.91322 -1.798097C5.3114 0.34241 6.13805 0 7 0c0.86195 0 1.6886 0.34241 2.2981 0.951903 0.49037 0.490367 0.8079 1.121307 0.9132 1.798097H13c0.4142 0 0.75 0.33579 0.75 0.75 0 0.41422 -0.3358 0.75 -0.75 0.75h-1v8.25c0 0.3978 -0.158 0.7794 -0.4393 1.0607S10.8978 14 10.5 14h-7c-0.39783 0 -0.77936 -0.158 -1.06066 -0.4393C2.15804 13.2794 2 12.8978 2 12.5V4.25H1c-0.414214 0 -0.75 -0.33578 -0.75 -0.75 0 -0.41421 0.335786 -0.75 0.75 -0.75h2.78868ZM5 5.87646c0.34518 0 0.625 0.27983 0.625 0.625V10.503c0 0.3451 -0.27982 0.625 -0.625 0.625s-0.625 -0.2799 -0.625 -0.625V6.50146c0 -0.34517 0.27982 -0.625 0.625 -0.625Zm4.625 0.625c0 -0.34517 -0.27982 -0.625 -0.625 -0.625s-0.625 0.27983 -0.625 0.625V10.503c0 0.3451 0.27982 0.625 0.625 0.625s0.625 -0.2799 0.625 -0.625V6.50146Z"
                            clip-rule="evenodd" stroke-width="1"></path>
                    </g>
                </svg></button>
        </form>
    </div>
</div>