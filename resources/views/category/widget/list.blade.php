<nav class="bd-links w-100 " id="bd-docs-nav" aria-label="Docs navigation">
    <ul class="bd-links-nav list-unstyled mb-0 pb-3 pb-md-2 pe-lg-2">

        @foreach ($rows as $item)
        <li class="bd-links-group py-2">
            <div class="d-flex w-100 gap-2 align-items-center">
                @if(isset($item['link']))
                <a href="javascript:void(0);"
                    class="bd-links-heading  align-items-center fw-semibold"
                    wire:click="goToPage($event.shiftKey,'{{$item['id']}}')">
                    @if(isset($item['name']))
                    {{$item['name']}}
                    @endif
                </a>
                @else
                <strong class="bd-links-heading align-items-center fw-semibold"
                    wire:click="goToPage($event.shiftKey,'{{$item['id']}}')">
                    @if(isset($item['name']))
                        {{$item['name']}}
                    @endif
                </strong>
                @endif


                {{-- <span wire:click="edit('{{$item['id']}}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                </span> --}}


            </div>

            @if(isset($item['items']))
                @include($viewListItem,['items' => $item['items']])
            @endif

        </li>

        @endforeach



        {{-- <li class="bd-links-group py-2">
            <strong class="bd-links-heading d-flex w-100 align-items-center fw-semibold">
                아두이노
            </strong>

            <ul class="list-unstyled fw-normal pb-2 small">
                <li>
                    <a href="/prologue" class="bd-links-link d-inline-block rounded">
                        전기전자
                    </a>
                </li>
                <li>
                    <a href="/coding" class="bd-links-link d-inline-block rounded">
                        프로그래밍
                    </a>
                </li>
                <li>
                    <a href="/output1" class="bd-links-link d-inline-block rounded">
                        출력실습1
                    </a>
                </li>
                <li>
                    <a href="/output2" class="bd-links-link d-inline-block rounded">
                        출력실습2
                    </a>
                </li>
                <li>
                    <a href="/display" class="bd-links-link d-inline-block rounded">
                        디스플레이
                    </a>
                </li>
                <li>
                    <a href="/input1" class="bd-links-link d-inline-block rounded">
                        입력실습
                    </a>
                </li>
                <li>
                    <a href="/motor/rc" class="bd-links-link d-inline-block rounded">
                        서보모터구동
                    </a>
                </li>
                <li>
                    <a href="/motor/step" class="bd-links-link d-inline-block rounded">
                        스텝모터
                    </a>
                </li>
                <li>
                    <a href="/motor/dc" class="bd-links-link d-inline-block rounded">
                        DC모터
                    </a>
                </li>
                <li>
                    <a href="/sensor" class="bd-links-link d-inline-block rounded">
                        센서
                    </a>
                </li>
                <li>
                    <a href="/slave" class="bd-links-link d-inline-block rounded">
                        연동
                    </a>
                </li>
                <li>
                    <a href="/bluetooth" class="bd-links-link d-inline-block rounded">
                        블루투스
                    </a>
                </li>
                <li>
                    <a href="/sensor/water" class="bd-links-link d-inline-block rounded">
                        물센서
                    </a>
                </li>
                <li>
                    <a href="/inventor" class="bd-links-link d-inline-block rounded">
                        앱인번터
                    </a>
                </li>
                <li>
                    <a href="/sensor/detection" class="bd-links-link d-inline-block rounded">
                        감지센서
                    </a>
                </li>
                <li>
                    <a href="/nano" class="bd-links-link d-inline-block rounded">
                        아두이노 나노
                    </a>
                </li>
                <li>
                    <a href="/17_외부확장" class="bd-links-link d-inline-block rounded">
                        외부확장
                    </a>
                </li>
                <li>
                    <a href="mega" class="bd-links-link d-inline-block rounded">
                        아두이노 메가
                    </a>
                </li>

            </ul>
        </li> --}}

        {{-- <li class="bd-links-group py-2">
            <strong class="bd-links-heading d-flex w-100 align-items-center fw-semibold">
                프로젝트
            </strong>
            <ul class="list-unstyled fw-normal pb-2 small">
                <li>
                    <a href="/exsample" class="bd-links-link d-inline-block rounded">
                        응용예제
                    </a>
                </li>
                <li>
                    <a href="/project" class="bd-links-link d-inline-block rounded">
                        프로젝트
                    </a>
                </li>

            </ul>
        </li> --}}

        {{-- <li class="bd-links-group py-2">
            <strong class="bd-links-heading d-flex w-100 align-items-center fw-semibold">
                공모전
            </strong>
            <ul class="list-unstyled fw-normal pb-2 small">
                <li>
                    <a href="/hanium" class="bd-links-link d-inline-block rounded">
                        한이음
                    </a>
                </li>
            </ul>
        </li> --}}



    </ul>
</nav>


