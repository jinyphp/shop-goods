<div>
    <x-loading-indicator/>

    <style>
        .jiny.tree ul {
            padding:0;
            margin-left:30px;
            /*
            padding:0 0 0 0;
            flex-grow: 1;
            */

            margin-top: -1px;
            margin-bottom: -1px;
        }

        .jiny.tree > ul {
            margin-left:0;
        }

        .jiny.tree li {
            /*display:flex;*/
            padding: 5px 0 5px 5px;

            border-left-color: gray;
            border-left-width: 1px;

            border-bottom-color: #cccccc;
            border-bottom-width: 1px;
            border-bottom-style: dashed;

            /*
            border-top-color: #cccccc;
            border-top-width: 1px;
            border-top-style: solid;
            */
        }

        .jiny.tree ul > li:first-child {
            /* border-bottom:0; */
        }

        .jiny.tree ul > li:last-child {
            /* border-bottom:0; */
        }

        .jiny.tree li > .title {
            padding: 5px;
            min-width:100px;
        }

        .jiny.tree .title-right {
            padding: 0 5px;
        }

        .jiny.tree li > div:hover {
            background: #def2fb;
        }

        .jiny.tree .title.target {
            background: #def2fb;
        }

        .jiny.tree .btn-create {
            padding: 10px;
        }



        /* 소스 드래깅 */
        .jiny.tree li.dragging {
            background: #eeeeee;
            border: 1px solid #cccccc;
            opacity: 0.7;
        }

        .draggable-mirror {
            background-color: yellow;
            width: 950px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
        }
    </style>


    <h2>{{ $code->code }}</h2>
    {{ $code->description }}
    <hr>

    <form>
        @csrf
        <div class="jiny tree">
            {!! xCateTree($tree) !!}
        </div>
    </form>



    {{-- tree drag move --}}
    <script>
        function findTagsParent(el, tag) {
            for(let i=0; i<tag.length;i++) {
                tag[i] = tag[i].toUpperCase();
            }
            let status = true;

            while(status) {
                for(i=0;i<tag.length;i++) {
                    if(el.tagName == tag[i]) status = false;
                }
                if(status == true) {
                    if(el) {
                        if(el.classList) {
                            //console.log(el);
                            if(el.classList.contains('root')) return null;
                        } else {
                            //console.log("class list가 없어요")
                        }
                    } else {
                        //console.log("el 이 없어요")
                    }

                    el = el.parentElement;
                }
            }
            return el;
        }

        const jinyTree = document.querySelector('.jiny.tree');

        let dragStart = null;
        let dragTarget = null;
        let dragOver = null;

        jinyTree.addEventListener('dragstart', (e) => {
            // node만 선택할 수 있음
            let target = findTagsParent(e.target, ['li']);
            if(target.classList.contains('drag-node')) {
                console.log("start=노드선택");
                dragStart = target;
                dragStart.classList.add('dragging'); // 드래깅 상태 클래스 표시
            } else {
                dragStart = null; // 초기화
            }
        });

        jinyTree.addEventListener('dragover', e => {
            e.preventDefault();
        });
        jinyTree.addEventListener('dragenter', e => {
            e.preventDefault();
        });
        jinyTree.addEventListener('dragleave', e => {
            e.preventDefault();
        });
        jinyTree.addEventListener('drop', (e) => {
            e.preventDefault();
            if(dragStart) {
                console.log("drop");
                let status = false;
                let target = findTagsParent(e.target, ['li','ul']);

                if(target.tagName == "UL") {
                    // 1. ul선택
                    console.log("ul은 대상이 될 수 없습니다.");
                }  else if(target.tagName == "LI") {
                    // 2. li선택
                    dragMoveToLi(dragStart, target);
                    status = true;
                }

                // 드래그 동작이 성공인 경우, ajax를 통하여 서버에 저장
                if(status) {
                    // 서버로 정보 전송
                    ajaxMenuDropSync();
                }

            } else {
                //console.log("drag가 선택되어 있지 않습니다.");
            }
        });

        jinyTree.addEventListener('dragend', (e) => {
            console.log("dragend");
            if(dragStart) {
                if(dragStart.classList.contains('dragging')) {
                    dragStart.classList.remove('dragging');
                    dragStart = null;
                }
            }
        });

        /* 이동하고자 하는 대상의 자기 자신의 자식들인지 체크함 */
        function checkDropChild(dragTarget) {
            // drag-node가 아닌 cteate노드는 level값이 없어 계층 확인이 어려움.
            let target;
            if(!dragTarget.classList.contains('drag-node')) {
                // 실제 drag-node 찾기
                target = findTagsParent(dragTarget.parentElement, ['li']);
            } else {
                target = dragTarget;
            }

            //console.log("동일계층 checking....")
            while(target.dataset['id'] != dragStart.dataset['id']) {
                if(parseInt(target.dataset['level']) == 1) return false;
                target = findTagsParent(target.parentElement, ['li']);
            }

            return true;
        }

        function dragMoveToLi(dragStart, dragTarget) {
            // 검사1.
            if(dragStart == dragTarget) {
                console.log("자기 자신은 이동할 수 없습니다.");
                return;
            }
            // 검사2,
            if(checkDropChild(dragTarget)) {
                console.log("동일계층 하위로 이동 할 수 없습니다.")
                return;
            }

            // 드래그 노드 (이동, 맞교환, 추가동작)
            if(dragTarget.classList.contains('drag-node')) {
                console.log("Li 노드에 드래그 되었습니다.");
                dragTargetToNode(dragStart, dragTarget);
            } else
            // 추가버튼 drop (추가동작)
            if(dragTarget.classList.contains('create')) {
                console.log("추가 버튼에 드래그 되었습니다.");
                dragTargetToCreate(dragStart, dragTarget);
            }
        }

        function dragTargetToNode(dragStart, dragTarget) {

            // 부모노드 검사
            // 부모가 같으면 노간 순서를 교환합니다.
            if(dragTarget.parentElement == dragStart.parentElement) {
                console.log("노드 순서 맞교환");
                targetNext = dragTarget.nextElementSibling;
                srcNext = dragStart.nextElementSibling;
                dragTarget.parentElement.insertBefore(dragStart, targetNext);
                dragStart.parentElement.insertBefore(dragTarget, srcNext);
            }

            // 부모 노드가 다름
            else {
                console.log("다른 노드로 이동합니다.");
                targetNext = dragTarget.nextElementSibling; // 대상 삽입위치 지정

                // 상위 노드값을 통하여
                // 이동노드의 ref, level 갑을 변경합니다.
                let parent = findTagsParent(dragTarget.parentElement, ['li']); //dragTarget.parentElement;
                if(parent) {
                    dragStart.dataset.ref = parent.dataset['id']; //부모 참조값 변경
                    dragStart.dataset.level = parseInt(parent.dataset['level']) + 1; // data 속성변경
                } else {
                    // root 노드로 이동
                    console.log("root 노드");
                    dragStart.dataset.ref = 0;
                    dragStart.dataset.level = 1;
                }

                // 기존 노드를 새로운 노드로 이동합니다.
                dragTarget.parentElement.insertBefore(dragStart, targetNext);
            }

        }

        /* 생성 버튼 노트로 drop한 경우 처리*/
        function dragTargetToCreate(dragStart, dragTarget) {
            // 동일 노드 검사
            // 예) 같은노드에서 +버튼으로 드래그하는 경
            let parentTarget = findTagsParent(dragTarget.parentElement, ['li']);
            let parentStart = findTagsParent(dragStart.parentElement, ['li']);
            if(parentTarget == parentStart) {
                console.log("동일한 부모노드 입니다. 서브등록을 취소합니다.");
            } else
            // 서브등록
            {
                //console.log("선택한 노드를 새로운 노드에 이동합니다.");
                dragStart.dataset.ref = parentTarget.dataset['id'];
                dragStart.dataset.level = parseInt(parentTarget.dataset['level']) + 1;  // data 속성변경

                // ul에 자식 추가
                dragTarget.parentElement.appendChild(dragStart);
            }
        }




        function ajaxMenuDropSync() {
            // 변경된 노드를 다시 확인
            let node = jinyTree.querySelectorAll('.jiny.tree > ul > li.drag-node');

            let aaa=[];
            function __treepos(node) {
                node.forEach(el => {

                    aaa.push({
                        'id':el.dataset['id'],
                        'level':el.dataset['level'],
                        'ref':el.dataset['ref'],
                        'pos':el.dataset['pos']
                    });

                    if(sub = el.querySelectorAll('[data-ref="'+el.dataset['id']+'"].drag-node')) {
                        __treepos(sub);
                    }

                });
            }

            __treepos(node);


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "/api/cate/pos");

            let data = new FormData();
            let token = document.querySelector('input[name=_token]').value;
            data.append('_token', token);

            for(let i=0; i < aaa.length; i++) {
                data.append("cate[" + aaa[i].id + "][ref]", aaa[i].ref);
                data.append("cate[" + aaa[i].id + "][level]", aaa[i].level);
                data.append("cate[" + aaa[i].id + "][pos]", i+1);
            }

            xhr.onload = function() {
                var data = JSON.parse(this.responseText);
                console.log(data);
            }

            xhr.send(data);
        }

    </script>


</div>
